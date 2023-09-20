<?php

namespace App\Model\Engine;

use Carbon\Carbon;
use Hyperf\Database\Schema\Schema;
use Hyperf\DbConnection\Model\Model;
use App\Model\Alarm\SensorAlarmTrait;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Model\Events\Updated;

class ArimbiLog extends Model
{
    use SensorAlarmTrait;
     
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'engine_log';

    /**
     * The connection name for the model.
     */
    protected ?string $connection = 'default';

    /**
     * all 
     */
    protected array $guarded = ['id']; 

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = [
        'terminal_time' => 'datetime'
    ];

    // create table cargo if not found table
    public static function table($fleetId, $date = null)
    {
        $date = is_null($date) ? date('Ym'): Carbon::parse($date)->format('Ym');
        $model = new self;
        $tableName = $model->getTable() . "_{$fleetId}_{$date}";
        
        if(! Schema::hasTable($tableName)) {
            Schema::create($tableName, function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('fleet_id')->index();
                $table->datetime('terminal_time')->index();
                $table->float('dg1_u_phase_temp', 10, 2)->nullable();
                $table->float('dg1_v_phase_temp', 10, 2)->nullable();
                $table->float('dg1_w_phase_temp', 10, 2)->nullable();
                $table->float('dg1_htfw_cool_temp', 10, 2)->nullable();
                $table->float('me_rpm', 10, 2)->nullable();
                $table->float('dg1_cyl1_3_temp', 10, 2)->nullable();
                $table->float('exh_gas_tc_aft_tc', 10, 2)->nullable();
                $table->float('dg1_charge_air_out_temp', 10, 2)->nullable();
                $table->float('dg2_u_winding_temp', 10, 2)->nullable();
                $table->float('dg2_v_winding_temp', 10, 2)->nullable();
                $table->float('dg2_w_winding_temp', 10, 2)->nullable();
                $table->float('dg2_htcfw_temp', 10, 2)->nullable();
                $table->float('me_shaft_rpm', 10, 2)->nullable();
                $table->float('tc_lo_temp', 10, 2)->nullable();
                $table->float('htcw_temp_eng_out', 10, 2)->nullable();
                $table->float('dg2_charge_air_out_temp', 10, 2)->nullable();
                $table->float('dg3_u_winding_temp', 10, 2)->nullable();
                $table->float('dg3_v_winding_temp', 10, 2)->nullable();
                $table->float('dg3_w_winding_temp', 10, 2)->nullable();
                $table->float('dg3_htcdw_temp', 10, 2)->nullable();
                $table->float('dg3_lo_temp', 10, 2)->nullable();
                $table->float('me_lo_temp', 10, 2)->nullable();
                $table->float('me_lo_pressure', 10, 2)->nullable();
                $table->float('dg3_charge_air_out_temp', 10, 2)->nullable();
                $table->float('dg1_htfw_pressure', 10, 2)->nullable();
                $table->float('dg1_lo_in_pressure', 10, 2)->nullable();
                $table->float('dg2_htfw_in_pressure', 10, 2)->nullable();
                $table->float('dg2_lo_in_pressure', 10, 2)->nullable();
                $table->float('dg3_htfw_in_pressure', 10, 2)->nullable();
                $table->float('dg3_lo_in_pressure', 10, 2)->nullable();
                $table->float('nozzle_cw_temp_before_engine', 10, 2)->nullable();
                $table->float('intake_air_temp_before_compressor', 10, 2)->nullable();
                $table->float('change_air_temp_inlet_engine_temp', 10, 2)->nullable();
                $table->float('htcw_temp_before_intercooler', 10, 2)->nullable();
                $table->float('ltc_water_temp_before_intercooler', 10, 2)->nullable();
                $table->float('fuel_temp_before_engine', 10, 2)->nullable();
                $table->float('charge_air_temp_after_compresor_tc', 10, 2)->nullable();
                $table->float('me_htcw_temp_before_engine', 10, 2)->nullable();
                $table->float('nzzle_cool_water_pressure', 10, 2)->nullable();
                $table->float('ltc_water_before_intercooler_pressure', 10, 2)->nullable();
                $table->float('fuel_pressure_before_engine', 10, 2)->nullable();
                $table->float('emergency_cut_off_air_pressure', 10, 2)->nullable();
                $table->float('control_air_pressure', 10, 2)->nullable();
                $table->float('me_cyl_temp_1', 10, 2)->nullable();
                $table->float('me_exh_temp_cyl_2', 10, 2)->nullable();
                $table->float('me_exh_temp_cyl_3', 10, 2)->nullable();
                $table->float('me_exh_cyl_4', 10, 2)->nullable();
                $table->float('me_exh_cyl_5', 10, 2)->nullable();
                $table->float('me_exh_cyl_6', 10, 2)->nullable();
                $table->float('me_exh_before_tc', 10, 2)->nullable();
                $table->float('me_exh_after_tc', 10, 2)->nullable();
                $table->float('exh_gas_temp_dg2', 10, 2)->nullable();
                $table->float('exh_gas_temp_dg3', 10, 2)->nullable();
                $table->float('air_low_press_dg0_16_bar', 10, 2)->nullable();
                $table->float('winding_temp_r_shaft_tg', 10, 2)->nullable();
                $table->float('winding_temp_s_shaft_tg', 10, 2)->nullable();
                $table->float('winding_temp_t_shaft_tg', 10, 2)->nullable();
                $table->float('winding_temp_r_syncro', 10, 2)->nullable();
                $table->float('winding_temp_s_syncro', 10, 2)->nullable();
                $table->float('winding_temp_t_syncro', 10, 2)->nullable();
                $table->float('dg_1_bearing_temp', 10, 2)->nullable();
                $table->float('dg_2_bearing_temp', 10, 2)->nullable();
                $table->float('dg_3_bearing_temp', 10, 2)->nullable();
                $table->float('temp_below_piston1_80', 10, 2)->nullable();
                $table->float('temp_below_piston1_120', 10, 2)->nullable();
                $table->float('temp_below_pist2_80', 10, 2)->nullable();
                $table->float('temp_below_piston2_120', 10, 2)->nullable();
                $table->float('temp_below_piston3_80', 10, 2)->nullable();
                $table->float('temp_below_piston3_120_sub', 10, 2)->nullable();
                $table->float('temp_below_piston4_80', 10, 2)->nullable();
                $table->float('temp_below_piston4_120', 10, 2)->nullable();
                $table->timestamps();
            });
        }
        
        return $model->setTable($tableName);
    }
}