<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace App\Model\Cargo;

use App\Model\Alarm\SensorAlarmTrait;
use App\Model\Sensor;
use Carbon\Carbon;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Schema\Schema;
use Hyperf\DbConnection\Model\Model;

class MahakamLog extends Model
{
    use SensorAlarmTrait;

    /**
     * engine group sensor.
     */
    public array $sensor_group = ['cargo'];

    /**
     * The table associated with the model.
     */
    protected ?string $table = 'cargo_log';

    /**
     * The connection name for the model.
     */
    protected ?string $connection = 'default';

    /**
     * all.
     */
    protected array $guarded = ['id'];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = [
        'terminal_time' => 'datetime',
    ];

    // create table cargo if not found table
    public static function table($fleetId, $date = null)
    {
        $date = is_null($date) ? date('Ym') : Carbon::parse($date)->format('Ym');
        $model = new self();
        $tableName = $model->getTable() . "_{$fleetId}_{$date}";

        if (! Schema::hasTable($tableName)) {
            Schema::create($tableName, function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('fleet_id')->index();
                $table->datetime('terminal_time')->unique();

                $table->float('level_cot_1p', 16, 2)->default(0);
                $table->float('temp_cot_1p', 16, 2)->default(0);
                $table->float('level_cot_1s', 16, 2)->default(0);
                $table->float('temp_cot_1s', 16, 2)->default(0);
                $table->float('level_cot_2p', 16, 2)->default(0);
                $table->float('temp_cot_2p', 16, 2)->default(0);
                $table->float('level_cot_2s', 16, 2)->default(0);
                $table->float('temp_cot_2s', 16, 2)->default(0);
                $table->float('level_cot_3p', 16, 2)->default(0);
                $table->float('temp_cot_3p', 16, 2)->default(0);
                $table->float('level_cot_3s', 16, 2)->default(0);
                $table->float('temp_cot_3s', 16, 2)->default(0);
                $table->float('level_cot_4p', 16, 2)->default(0);
                $table->float('temp_cot_4p', 16, 2)->default(0);
                $table->float('level_cot_4s', 16, 2)->default(0);
                $table->float('temp_cot_4s', 16, 2)->default(0);
                $table->float('level_cot_5p', 16, 2)->default(0);
                $table->float('temp_cot_5p', 16, 2)->default(0);
                $table->float('level_cot_5s', 16, 2)->default(0);
                $table->float('temp_cot_5s', 16, 2)->default(0);
                $table->float('level_slop_p', 16, 2)->default(0);
                $table->float('temp_slop_p', 16, 2)->default(0);
                $table->float('level_slop_s', 16, 2)->default(0);
                $table->float('temp_slop_s', 16, 2)->default(0);
                $table->float('fore_peak_tank', 16, 2)->default(0);
                $table->float('level_wbt_1p', 16, 2)->default(0);
                $table->float('level_wbt_1s', 16, 2)->default(0);
                $table->float('level_wbt_2p', 16, 2)->default(0);
                $table->float('level_wbt_2s', 16, 2)->default(0);
                $table->float('level_wbt_3p', 16, 2)->default(0);
                $table->float('level_wbt_3s', 16, 2)->default(0);
                $table->float('level_wbt_4p', 16, 2)->default(0);
                $table->float('level_wbt_4s', 16, 2)->default(0);
                $table->float('level_wbt_5p', 16, 2)->default(0);
                $table->float('level_wbt_5s', 16, 2)->default(0);
                $table->float('level_draft_fore', 16, 2)->default(0);
                $table->float('level_draft_mid_p', 16, 2)->default(0);
                $table->float('level_draft_mid_s', 16, 2)->default(0);
                $table->float('level_draft_after', 16, 2)->default(0);

                $table->timestamps();
            });
        }

        return $model->setTable($tableName);
    }

    // Calculate percentage cargo capacity
    public function cargoCapacity($model): void
    {
        $cargoArray = [
            'level_cot_1p',
            'level_cot_1s',
            'level_cot_2p',
            'level_cot_2s',
            'level_cot_3p',
            'level_cot_3s',
            'level_cot_4p',
            'level_cot_4s',
            'level_cot_5p',
            'level_cot_5s',
        ];

        $sensors = \App\Model\Sensor::where('fleet_id', $model->fleet_id)->where('group', 'cargo')->pluck('danger', 'sensor_name')->toArray();
        $data = [];
        foreach ($cargoArray as $c) {
            $max = $sensors[$c];
            $value = $model->{$c};

            $percentage = ($value <= $max) ? ($value / $max) : 0;
            $data[$c] = (1 - $percentage);
        }

        $totalPercentage = 0;
        foreach ($data as $d) {
            $totalPercentage += $d;
        }

        $percentageCargo = $totalPercentage / count($cargoArray);

        $now = \Carbon\Carbon::now();
        $fsr = \App\Model\FleetDailyReport::table($model->fleet_id)->where([
            'fleet_id' => $model->fleet_id,
            'date' => $now->format('Y-m-d'),
            'sensor' => 'cargo_percentage',
        ])->first();

        if (! $fsr) {
            $fsr = \App\Model\FleetDailyReport::table($model->fleet_id);
            $fsr->fleet_id = $model->fleet_id;
            $fsr->date = $now->format('Y-m-d');
            $fsr->sensor = 'cargo_percentage';
            $fsr->before = $percentageCargo;
        }

        $fsr->after = $percentageCargo;
        $fsr->value = ($fsr->after - $fsr->before);
        $fsr->save();
    }
}
