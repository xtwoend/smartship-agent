<?php

declare(strict_types=1);

namespace App\Model\Cargo;

use Carbon\Carbon;
use Hyperf\Database\Schema\Schema;
use Hyperf\DbConnection\Model\Model;
use App\Model\Alarm\SensorAlarmTrait;
use Hyperf\Database\Schema\Blueprint;

class PasamanLog extends Model
{
    use SensorAlarmTrait;

    /**
     * engine group sensor
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
     * all 
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
        $date = is_null($date) ? date('Ym'): Carbon::parse($date)->format('Ym');
        $model = new self;
        $tableName = $model->getTable() . "_{$fleetId}_{$date}";
        
        if(! Schema::hasTable($tableName)) {
            Schema::create($tableName, function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('fleet_id')->index();
                $table->datetime('terminal_time')->unique();
                
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
                $table->boolean('cargo_pump1_run')->default(false);
                $table->boolean('cargo_pump2_run')->default(false);
                $table->boolean('cargo_pump3_run')->default(false);
                $table->boolean('stripping_pump_run')->default(false);
                $table->boolean('tk_cleanning_pump_run')->default(false);
                $table->boolean('ballast_pump1_run')->default(false);
                $table->boolean('ballast_pump2_run')->default(false);

                // Cargo
                $table->datetime('cargo_timestamp')->nullable();
                $table->float('bottom_gear_cp1', 10, 3)->default(0);
                $table->float('pump_casing_cp1', 10, 3)->default(0);
                $table->float('upper_gear_cp1', 10, 3)->default(0);
                $table->float('transmission_seal_cp1', 10, 3)->default(0);
                $table->float('trans_v_bearin_cp1', 10, 3)->default(0);
                $table->float('throtle_position_cp1', 10, 3)->default(0);
                $table->float('bottom_gear_cp2', 10, 3)->default(0);
                $table->float('pump_casing_cp2', 10, 3)->default(0);
                $table->float('upper_gear_cp2', 10, 3)->default(0);
                $table->float('transmission_seal_cp2', 10, 3)->default(0);
                $table->float('trans_v_bearing_cp2', 10, 3)->default(0);
                $table->float('throtle_position_cp2', 10, 3)->default(0);
                $table->float('bottom_gear_cp3', 10, 3)->default(0);
                $table->float('pump_casing_cp3', 10, 3)->default(0);
                $table->float('upper_gear_cp3', 10, 3)->default(0);
                $table->float('transmission_seal_cp3', 10, 3)->default(0);
                $table->float('trans_v_bearing_cp3', 10, 3)->default(0);
                $table->float('throtle_position_cp3', 10, 3)->default(0);
                $table->float('pump_casing_bp1', 10, 3)->default(0);
                $table->float('upper_gear_bp1', 10, 3)->default(0);
                $table->float('transmission_seal_bp1', 10, 3)->default(0);
                $table->float('transmission_v_bearing_bp1', 10, 3)->default(0);
                $table->float('pump_casing_bp2', 10, 3)->default(0);
                $table->float('upper_gear_bp2', 10, 3)->default(0);
                $table->float('transmission_seal_bp2', 10, 3)->default(0);
                $table->float('transmission_v_bearing_bp2', 10, 3)->default(0);
                $table->float('bearing_temp_vp1', 10, 3)->default(0);
                $table->float('bearing_temp_vp2', 10, 3)->default(0);
                $table->float('bottom_gear_sp', 10, 3)->default(0);
                $table->float('pump_casing_sp', 10, 3)->default(0);
                $table->float('upper_gear_sp', 10, 3)->default(0);
                $table->float('transmission_seal_sp', 10, 3)->default(0);
                $table->float('trans_v_bearing_sp', 10, 3)->default(0);
                $table->float('not_used', 10, 3)->default(0);
                $table->float('bottom_gear_tcp', 10, 3)->default(0);
                $table->float('pump_casing_tcp', 10, 3)->default(0);
                $table->float('upper_gear_tcp', 10, 3)->default(0);
                $table->float('transmission_seal_tcp', 10, 3)->default(0);
                $table->float('trans_v_bearing_tcp', 10, 3)->default(0);
                $table->float('not_used_1', 10, 3)->default(0);
                $table->float('suction_cp1', 10, 3)->default(0);
                $table->float('suction_cp2', 10, 3)->default(0);
                $table->float('suction_cp3', 10, 3)->default(0);
                $table->float('suction_sp', 10, 3)->default(0);
                $table->float('suction_tcp', 10, 3)->default(0);
                $table->float('airgas_separatorcp1', 10, 3)->default(0);
                $table->float('airgas_separator_cp2', 10, 3)->default(0);
                $table->float('airgas_separator_cp3', 10, 3)->default(0);
                $table->float('vibration_cp1', 10, 3)->default(0);
                $table->float('vibration_cp2', 10, 3)->default(0);
                $table->float('vibration_cp3', 10, 3)->default(0);
                $table->float('vacuum_manifold_pressure', 10, 3)->default(0);
                $table->float('suction_bp1', 10, 3)->default(0);
                $table->float('discharge_press_bp1', 10, 3)->default(0);
                $table->float('suction_bp2', 10, 3)->default(0);
                $table->float('discharge_press_bp2', 10, 3)->default(0);
                $table->float('discharge_press_cp1', 10, 3)->default(0);
                $table->float('discharge_press_cp2', 10, 3)->default(0);
                $table->float('discharge_press_cp3', 10, 3)->default(0);
                $table->float('discharge_press_sp', 10, 3)->default(0);
                $table->float('discharge_press_tcp', 10, 3)->default(0);
                
                // pump status
                $table->datetime('pump_latest_update_at')->nullable()->default(null);
                $table->boolean('cargo_pump1_run')->nullable()->default(null);
                $table->boolean('cargo_pump2_run')->nullable()->default(null);
                $table->boolean('cargo_pump3_run')->nullable()->default(null);
                $table->boolean('wballast_pump1_run')->nullable()->default(null);
                $table->boolean('wballast_pump2_run')->nullable()->default(null);
                $table->boolean('tank_cleaning_pump_run')->nullable()->default(null);
                $table->boolean('stripping_pump_run')->nullable()->default(null);
                
                $table->timestamps();
            });
        }
        
        return $model->setTable($tableName);
    }
}
