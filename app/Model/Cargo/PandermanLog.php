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
use Carbon\Carbon;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Schema\Schema;
use Hyperf\DbConnection\Model\Model;

class PandermanLog extends Model
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
                $table->datetime('terminal_time')->index();
                $table->float('no_1_cot_p', 10, 3)->default(0);
                $table->float('no_1_p_a_temp', 10, 3)->default(0);
                $table->float('no_1_p_u_temp', 10, 3)->default(0);
                $table->float('no_1_p_m_temp', 10, 3)->default(0);
                $table->float('no_1_p_l_temp', 10, 3)->default(0);
                $table->float('no_1_p_pressure', 10, 3)->default(0);
                $table->float('no_1_cot_s', 10, 3)->default(0);
                $table->float('no_1_s_a_temp', 10, 3)->default(0);
                $table->float('no_1_s_u_temp', 10, 3)->default(0);
                $table->float('no_1_s_m_temp', 10, 3)->default(0);
                $table->float('no_1_s_l_temp', 10, 3)->default(0);
                $table->float('no_1_s_pressure', 10, 3)->default(0);
                $table->float('no_2_cot_p', 10, 3)->default(0);
                $table->float('no_2_p_a_temp', 10, 3)->default(0);
                $table->float('no_2_p_u_temp', 10, 3)->default(0);
                $table->float('no_2_p_m_temp', 10, 3)->default(0);
                $table->float('no_2_p_l_temp', 10, 3)->default(0);
                $table->float('no_2_p_pressure', 10, 3)->default(0);
                $table->float('no_2_cot_s', 10, 3)->default(0);
                $table->float('no_2_s_a_temp', 10, 3)->default(0);
                $table->float('no_2_s_u_temp', 10, 3)->default(0);
                $table->float('no_2_s_m_temp', 10, 3)->default(0);
                $table->float('no_2_s_l_temp', 10, 3)->default(0);
                $table->float('no_2_s_pressure', 10, 3)->default(0);
                $table->float('no_3_cot_p', 10, 3)->default(0);
                $table->float('no_3_p_a_temp', 10, 3)->default(0);
                $table->float('no_3_p_u_temp', 10, 3)->default(0);
                $table->float('no_3_p_m_temp', 10, 3)->default(0);
                $table->float('no_3_p_l_temp', 10, 3)->default(0);
                $table->float('no_3_p_pressure', 10, 3)->default(0);
                $table->float('no_3_cot_s', 10, 3)->default(0);
                $table->float('no_3_s_a_temp', 10, 3)->default(0);
                $table->float('no_3_s_u_temp', 10, 3)->default(0);
                $table->float('no_3_s_m_temp', 10, 3)->default(0);
                $table->float('no_3_s_l_temp', 10, 3)->default(0);
                $table->float('no_3_s_pressure', 10, 3)->default(0);
                $table->float('no_4_cot_p', 10, 3)->default(0);
                $table->float('no_4_p_a_temp', 10, 3)->default(0);
                $table->float('no_4_p_u_temp', 10, 3)->default(0);
                $table->float('no_4_p_m_temp', 10, 3)->default(0);
                $table->float('no_4_p_l_temp', 10, 3)->default(0);
                $table->float('no_4_p_pressure', 10, 3)->default(0);
                $table->float('no_4_cot_s', 10, 3)->default(0);
                $table->float('no_4_s_a_temp', 10, 3)->default(0);
                $table->float('no_4_s_u_temp', 10, 3)->default(0);
                $table->float('no_4_s_m_temp', 10, 3)->default(0);
                $table->float('no_4_s_l_temp', 10, 3)->default(0);
                $table->float('no_4_s_pressure', 10, 3)->default(0);
                $table->float('no_5_cot_p', 10, 3)->default(0);
                $table->float('no_5_p_a_temp', 10, 3)->default(0);
                $table->float('no_5_p_u_temp', 10, 3)->default(0);
                $table->float('no_5_p_m_temp', 10, 3)->default(0);
                $table->float('no_5_p_l_temp', 10, 3)->default(0);
                $table->float('no_5_p_pressure', 10, 3)->default(0);
                $table->float('no_5_cot_s', 10, 3)->default(0);
                $table->float('no_5_s_a_temp', 10, 3)->default(0);
                $table->float('no_5_s_u_temp', 10, 3)->default(0);
                $table->float('no_5_s_m_temp', 10, 3)->default(0);
                $table->float('no_5_s_l_temp', 10, 3)->default(0);
                $table->float('no_5_s_pressure', 10, 3)->default(0);
                $table->float('slop_tk_p', 10, 3)->default(0);
                $table->float('slop_p_a_temp', 10, 3)->default(0);
                $table->float('slop_p_u_temp', 10, 3)->default(0);
                $table->float('slop_p_m_temp', 10, 3)->default(0);
                $table->float('slop_p_l_temp', 10, 3)->default(0);
                $table->float('slop_p_pressure', 10, 3)->default(0);
                $table->float('slop_tk_s', 10, 3)->default(0);
                $table->float('slop_s_a_temp', 10, 3)->default(0);
                $table->float('slop_s_u_temp', 10, 3)->default(0);
                $table->float('slop_s_m_temp', 10, 3)->default(0);
                $table->float('slop_s_l_temp', 10, 3)->default(0);
                $table->float('slop_s_pressure', 10, 3)->default(0);
                $table->float('cargo_pump1_run', 10, 3)->default(0);
                $table->float('cargo_pump2_run', 10, 3)->default(0);
                $table->float('cargo_pump3_run', 10, 3)->default(0);
                $table->float('stripping_pump_run', 10, 3)->default(0);
                $table->float('tk_cleanning_pump_run', 10, 3)->default(0);
                $table->float('ballast_pump1_run', 10, 3)->default(0);
                $table->float('ballast_pump2_run', 10, 3)->default(0);

                // cargo sensor
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

                $table->timestamps();
            });
        }

        return $model->setTable($tableName);
    }

    // Calculate percentage cargo capacity
    public function cargoCapacity($model): void
    {
        $cargoArray = [
            'no_1_cot_p',
            'no_1_cot_s',
            'no_2_cot_p',
            'no_2_cot_2',
            'no_3_cot_p',
            'no_3_cot_s',
            'no_4_cot_p',
            'no_4_cot_2',
            'no_5_cot_p',
            'no_5_cot_s',
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
