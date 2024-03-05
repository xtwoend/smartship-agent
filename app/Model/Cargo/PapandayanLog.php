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

class PapandayanLog extends Model
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

                // hanla
                $table->float('no_1_cargo_tank_p', 10, 3)->default(0);
                $table->float('temp_1ctp', 10, 3)->default(0);
                $table->float('no_1_cargo_tank_s', 10, 3)->default(0);
                $table->float('temp_1cts', 10, 3)->default(0);
                $table->float('no_2_cargo_tank_p', 10, 3)->default(0);
                $table->float('temp_2ctp', 10, 3)->default(0);
                $table->float('no_2_cargo_tank_s', 10, 3)->default(0);
                $table->float('temp_2cts', 10, 3)->default(0);
                $table->float('no_3_cargo_tank_p', 10, 3)->default(0);
                $table->float('temp_3ctp', 10, 3)->default(0);
                $table->float('no_3_cargo_tank_s', 10, 3)->default(0);
                $table->float('temp_3cts', 10, 3)->default(0);
                $table->float('no_4_cargo_tank_p', 10, 3)->default(0);
                $table->float('temp_4ctp', 10, 3)->default(0);
                $table->float('no_4_cargo_tank_s', 10, 3)->default(0);
                $table->float('temp_4cts', 10, 3)->default(0);
                $table->float('no_5_cargo_tank_p', 10, 3)->default(0);
                $table->float('temp_5ctp', 10, 3)->default(0);
                $table->float('no_5_cargo_tank_s', 10, 3)->default(0);
                $table->float('temp_5cts', 10, 3)->default(0);
                $table->float('slop_cargo_tank_p', 10, 3)->default(0);
                $table->float('temp_sctp', 10, 3)->default(0);
                $table->float('slop_cargo_tank_s', 10, 3)->default(0);
                $table->float('temp_scts', 10, 3)->default(0);
                $table->float('f_p_t_c', 10, 3)->default(0);
                $table->float('no_1_wbt_p', 10, 3)->default(0);
                $table->float('no_1_wbt_s', 10, 3)->default(0);
                $table->float('no_2_wbt_p', 10, 3)->default(0);
                $table->float('no_2_wbt_s', 10, 3)->default(0);
                $table->float('no_3_wbt_p', 10, 3)->default(0);
                $table->float('no_3_wbt_s', 10, 3)->default(0);
                $table->float('no_4_wbt_p', 10, 3)->default(0);
                $table->float('no_4_wbt_s', 10, 3)->default(0);
                $table->float('no_5_wbt_p', 10, 3)->default(0);
                $table->float('no_5_wbt_s', 10, 3)->default(0);
                $table->float('no_6_wbt_p', 10, 3)->default(0);
                $table->float('no_6_wbt_s', 10, 3)->default(0);
                $table->float('no_7_wbt_p', 10, 3)->default(0);
                $table->float('no_7_wbt_s', 10, 3)->default(0);
                $table->float('aftk_p', 10, 3)->default(0);
                $table->float('aftk_s', 10, 3)->default(0);
                $table->float('no1_mdo_tank_p', 10, 3)->default(0);
                $table->float('no2_mdo_tank_s', 10, 3)->default(0);
                $table->float('mdo_sett_tank_s', 10, 3)->default(0);
                $table->float('no1_mdo_day_tank_p', 10, 3)->default(0);
                $table->float('no2_mdo_day_tank_s', 10, 3)->default(0);
                $table->float('no1_hfo_tank_p', 10, 3)->default(0);
                $table->float('no2_hfo_tank_s', 10, 3)->default(0);
                $table->float('hfo_sett_tank_p', 10, 3)->default(0);
                $table->float('no1_hfo_day_tank_p', 10, 3)->default(0);
                $table->float('no2_hfo_day_tank_s', 10, 3)->default(0);
                $table->float('draft_fore', 10, 3)->default(0);
                $table->float('draft_mid_p', 10, 3)->default(0);
                $table->float('draft_mid_s', 10, 3)->default(0);
                $table->float('draft_after', 10, 3)->default(0);

                // Cargo Operation
                $table->datetime('cargo_timestamp')->nullable();
                $table->float('temp_casing_wbp1', 10, 3)->default(0);
                $table->float('temp_bearing_wbp1', 10, 3)->default(0);
                $table->float('temp_stuffingbox_wbp1', 10, 3)->default(0);
                $table->float('temp_casing_wbp2', 10, 3)->default(0);
                $table->float('temp_bearing_wbp2', 10, 3)->default(0);
                $table->float('temp_stuffingbox_wbp2', 10, 3)->default(0);
                $table->float('temp_casing_sp', 10, 3)->default(0);
                $table->float('temp_bearing_sp', 10, 3)->default(0);
                $table->float('temp_stuffingbox_sp', 10, 3)->default(0);
                $table->float('temp_casing_tcp', 10, 3)->default(0);
                $table->float('temp_bearing_tcp', 10, 3)->default(0);
                $table->float('temp_stuffingbox_tcp', 10, 3)->default(0);
                $table->float('temp_casing_cp1', 10, 3)->default(0);
                $table->float('temp_bearing_cp1', 10, 3)->default(0);
                $table->float('temp_stuffingbox_cp1', 10, 3)->default(0);
                $table->float('temp_casing_cp2', 10, 3)->default(0);
                $table->float('temp_bearing_cp2', 10, 3)->default(0);
                $table->float('temp_stuffingbox_cp2', 10, 3)->default(0);
                $table->float('temp_casing_cp3', 10, 3)->default(0);
                $table->float('temp_bearing_cp3', 10, 3)->default(0);
                $table->float('temp_stuffingbox_cp3', 10, 3)->default(0);
                $table->float('press_discharge_wbp1', 10, 3)->default(0);
                $table->float('press_suction_wbp1', 10, 3)->default(0);
                $table->float('press_discharge_wbp2', 10, 3)->default(0);
                $table->float('press_suction_wbp2', 10, 3)->default(0);
                $table->float('press_discharge_tcp', 10, 3)->default(0);
                $table->float('press_suction_tcp', 10, 3)->default(0);
                $table->float('press_discharge_sp', 10, 3)->default(0);
                $table->float('press_suction_sp', 10, 3)->default(0);
                $table->float('press_discharge_cp1', 10, 3)->default(0);
                $table->float('press_suction_cp1', 10, 3)->default(0);
                $table->float('press_discharge_cp2', 10, 3)->default(0);
                $table->float('press_suction_cp2', 10, 3)->default(0);
                $table->float('press_discharge_cp3', 10, 3)->default(0);
                $table->float('press_suction_cp3', 10, 3)->default(0);

                // pump status
                $table->datetime('cargo_pump_timestamp')->nullable();
                $table->boolean('cargo_pump1_run')->default(false);
                $table->boolean('cargo_pump2_run')->default(false);
                $table->boolean('cargo_pump3_run')->default(false);
                $table->boolean('wballast_pump1_run')->default(false);
                $table->boolean('wballast_pump2_run')->default(false);
                $table->boolean('tank_cleaning_pump_run')->default(false);
                $table->boolean('stripping_pump_run')->default(false);

                $table->timestamps();
            });
        }

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
