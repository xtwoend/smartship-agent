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

use Carbon\Carbon;
use Hyperf\Database\Schema\Schema;
use App\Model\Traits\HasColumnTrait;
use Hyperf\DbConnection\Model\Model;
use App\Model\Alarm\SensorAlarmTrait;
use Hyperf\Database\Schema\Blueprint;

class PatriotLog extends Model
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
                $table->float('level_cot_1p')->defalt(0);
                $table->float('temp_cot_1p')->defalt(0);
                $table->float('level_cot_1s')->defalt(0);
                $table->float('temp_cot_1s')->defalt(0);
                $table->float('level_cot_2p')->defalt(0);
                $table->float('temp_cot_2p')->defalt(0);
                $table->float('level_cot_2s')->defalt(0);
                $table->float('temp_cot_2s')->defalt(0);
                $table->float('level_cot_3p')->defalt(0);
                $table->float('temp_cot_3p')->defalt(0);
                $table->float('level_cot_3s')->defalt(0);
                $table->float('temp_cot_3s')->defalt(0);
                $table->float('level_cot_4p')->defalt(0);
                $table->float('temp_cot_4p')->defalt(0);
                $table->float('level_cot_4s')->defalt(0);
                $table->float('temp_cot_4s')->defalt(0);
                $table->float('level_cot_5p')->defalt(0);
                $table->float('temp_cot_5p')->defalt(0);
                $table->float('level_cot_5s')->defalt(0);
                $table->float('temp_cot_5s')->defalt(0);
                $table->float('level_slop_p')->defalt(0);
                $table->float('temp_slop_p')->defalt(0);
                $table->float('level_slop_s')->defalt(0);
                $table->float('temp_slop_s')->defalt(0);
                $table->float('fore_peak_tank')->defalt(0);
                $table->float('level_wbt_1p')->defalt(0);
                $table->float('level_wbt_1s')->defalt(0);
                $table->float('level_wbt_2p')->defalt(0);
                $table->float('level_wbt_2s')->defalt(0);
                $table->float('level_wbt_3p')->defalt(0);
                $table->float('level_wbt_3s')->defalt(0);
                $table->float('level_wbt_4p')->defalt(0);
                $table->float('level_wbt_4s')->defalt(0);
                $table->float('level_wbt_5p')->defalt(0);
                $table->float('level_wbt_5s')->defalt(0);
                $table->float('level_draft_fore')->defalt(0);
                $table->float('level_draft_mid_p')->defalt(0);
                $table->float('level_draft_mid_s')->defalt(0);
                $table->float('level_draft_after')->defalt(0);

                $table->timestamps();
            });
        }

        if(count($payload) > 0) {
            $model->addColumn($tableName, $payload);
        }
        // $model->addColumn($tableName, [
        //     [
        //         'type' => 'float',
        //         'name' => 'level_cot_1p_mt',
        //         'after' => 'level_cot_1p',
        //     ],
        //     [
        //         'type' => 'float',
        //         'name' => 'level_cot_1s_mt',
        //         'after' => 'level_cot_1s',
        //     ],
        //     [
        //         'type' => 'float',
        //         'name' => 'level_cot_2p_mt',
        //         'after' => 'level_cot_2p',
        //     ],
        //     [
        //         'type' => 'float',
        //         'name' => 'level_cot_2s_mt',
        //         'after' => 'level_cot_2s',
        //     ],
        //     [
        //         'type' => 'float',
        //         'name' => 'level_cot_3p_mt',
        //         'after' => 'level_cot_3p',
        //     ],
        //     [
        //         'type' => 'float',
        //         'name' => 'level_cot_3s_mt',
        //         'after' => 'level_cot_3s',
        //     ],
        //     [
        //         'type' => 'float',
        //         'name' => 'level_cot_4p_mt',
        //         'after' => 'level_cot_4p',
        //     ],
        //     [
        //         'type' => 'float',
        //         'name' => 'level_cot_4s_mt',
        //         'after' => 'level_cot_4s',
        //     ],
        //     [
        //         'type' => 'float',
        //         'name' => 'level_cot_5p_mt',
        //         'after' => 'level_cot_5p',
        //     ],
        //     [
        //         'type' => 'float',
        //         'name' => 'level_cot_5s_mt',
        //         'after' => 'level_cot_5s',
        //     ],
            
        // ]);
        return $model->setTable($tableName);
    }

    // Calculate percentage cargo capacity
    public function cargoCapacity($model): void
    {
        $cargoArray = [
            'no_1_cargo_tank_p',
            'no_1_cargo_tank_s',
            'no_2_cargo_tank_p',
            'no_2_cargo_tank_s',
            'no_3_cargo_tank_p',
            'no_3_cargo_tank_s',
            'no_4_cargo_tank_p',
            'no_4_cargo_tank_s',
            'no_5_cargo_tank_p',
            'no_5_cargo_tank_s',
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
