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
namespace Smartship\Taurus\Model;

use Carbon\Carbon;
use Hyperf\Database\Schema\Schema;
use App\Model\Traits\HasColumnTrait;
use Hyperf\DbConnection\Model\Model;
use App\Model\Alarm\SensorAlarmTrait;
use Hyperf\Database\Schema\Blueprint;

class CargoLog extends Model
{
    use SensorAlarmTrait;
    use HasColumnTrait;

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
    public static function table($fleetId, $date = null, $payload=[])
    {
        $date = is_null($date) ? date('Ym') : Carbon::parse($date)->format('Ym');
        $model = new self();
        $tableName = $model->getTable() . "_{$fleetId}_{$date}";

        if (! Schema::hasTable($tableName)) {
            Schema::create($tableName, function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('fleet_id')->index();
                $table->datetime('terminal_time')->unique();
                
                // hanla
                $table->float('level_cot_1p')->default(0);
                $table->float('temp_cot_1p')->default(0);
                $table->float('level_cot_1p_mt')->nullable();
                $table->float('level_cot_1s')->default(0);
                $table->float('temp_cot_1s')->default(0);
                $table->float('level_cot_1s_mt')->default(0);
                $table->float('level_cot_2p')->default(0);
                $table->float('temp_cot_2p')->default(0);
                $table->float('level_cot_2p_mt')->default(0);
                $table->float('level_cot_2s')->default(0);
                $table->float('temp_cot_2s')->default(0);
                $table->float('level_cot_2s_mt')->default(0);
                $table->float('level_cot_3p')->default(0);
                $table->float('temp_cot_3p')->default(0);
                $table->float('level_cot_3p_mt')->default(0);
                $table->float('level_cot_3s')->default(0);
                $table->float('temp_cot_3s')->default(0);
                $table->float('level_cot_3s_mt')->default(0);
                $table->float('level_cot_4p')->default(0);
                $table->float('temp_cot_4p')->default(0);
                $table->float('level_cot_4p_mt')->default(0);
                $table->float('level_cot_4s')->default(0);
                $table->float('temp_cot_4s')->default(0);
                $table->float('level_cot_4s_mt')->default(0);
                $table->float('level_cot_5p')->default(0);
                $table->float('temp_cot_5p')->default(0);
                $table->float('level_cot_5p_mt')->default(0);
                $table->float('level_cot_5s')->default(0);
                $table->float('temp_cot_5s')->default(0);
                $table->float('level_cot_5s_mt')->default(0);
                $table->float('level_slop_p')->default(0);
                $table->float('temp_slop_p')->default(0);
                $table->float('level_slop_s')->default(0);
                $table->float('temp_slop_s')->default(0);
                $table->float('fore_peak_tank')->default(0);
                $table->float('level_wbt_1p')->default(0);
                $table->float('level_wbt_1s')->default(0);
                $table->float('level_wbt_2p')->default(0);
                $table->float('level_wbt_2s')->default(0);
                $table->float('level_wbt_3p')->default(0);
                $table->float('level_wbt_3s')->default(0);
                $table->float('level_wbt_4p')->default(0);
                $table->float('level_wbt_4s')->default(0);
                $table->float('level_wbt_5p')->default(0);
                $table->float('level_wbt_5s')->default(0);
                $table->float('level_draft_fore')->default(0);
                $table->float('level_draft_after')->default(0);
                $table->float('after_peak_tank')->default(0);
                $table->float('mdo_mgo_tank_p')->default(0);
                $table->float('mdo_tank_s')->default(0);
                $table->float('fore_fw_tank_p')->default(0);
                $table->float('fore_fw_tank_s')->default(0);
                $table->float('fw_tank_p')->default(0);
                $table->float('fw_tank_s')->default(0);
                $table->float('fo_overflow_tank')->default(0);

                // pump
                $table->datetime('cargo_pump_timestamp')->nullable();
                $table->float('cargo_pump1_run')->default(0);
                $table->float('cargo_pump2_run')->default(0);
                $table->float('cargo_pump3_run')->default(0);
                $table->float('wballast_pump1_run')->default(0);
                $table->float('wballast_pump2_run')->default(0);
                $table->float('tank_cleaning_pump1_run')->default(0);
                $table->float('tank_cleaning_pump2_run')->default(0);
                
                $table->timestamps();
            });
        }
        if(count($payload) > 0) {
            $model->addColumn($tableName, $payload);
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
            if(! isset($sensors[$c])) continue;
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

        // save
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
