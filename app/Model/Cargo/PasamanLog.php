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
                $table->float('volume_cot_1p', 10, 3)->default(0);
                $table->float('volume_cot_1s', 10, 3)->default(0);
                $table->float('volume_cot_2p', 10, 3)->default(0);
                $table->float('volume_cot_2s', 10, 3)->default(0);
                $table->float('volume_cot_3p', 10, 3)->default(0);
                $table->float('volume_cot_3s', 10, 3)->default(0);
                $table->float('volume_cot_4p', 10, 3)->default(0);
                $table->float('volume_cot_4s', 10, 3)->default(0);
                $table->float('volume_cot_5p', 10, 3)->default(0);
                $table->float('volume_cot_5s', 10, 3)->default(0);
                $table->float('volume_fpt', 10, 3)->default(0);
                $table->float('volume_wbt_1p', 10, 3)->default(0);
                $table->float('volume_wbt_1s', 10, 3)->default(0);
                $table->float('volume_wbt_2p', 10, 3)->default(0);
                $table->float('volume_wbt_2s', 10, 3)->default(0);
                $table->float('volume_wbt_3p', 10, 3)->default(0);
                $table->float('volume_wbt_3s', 10, 3)->default(0);
                $table->float('volume_wbt_4p', 10, 3)->default(0);
                $table->float('volume_wbt_4s', 10, 3)->default(0);
                $table->float('volume_wbt_5p', 10, 3)->default(0);
                $table->float('volume_wbt_5s', 10, 3)->default(0);
                $table->float('volume_wbt_6p', 10, 3)->default(0);
                $table->float('volume_wbt_6s', 10, 3)->default(0);
                $table->float('volume_wbt_7p', 10, 3)->default(0);
                $table->float('volume_wbt_7s', 10, 3)->default(0);
                $table->float('volume_aft_1p', 10, 3)->default(0);
                $table->float('volume_aft_1s', 10, 3)->default(0);
                $table->float('volume_no1_mdo_tank_p', 10, 3)->default(0);
                $table->float('volume_no2_mdo_tank_s', 10, 3)->default(0);
                $table->float('volume_mdo_sett_tank_s', 10, 3)->default(0);
                $table->float('volume_no1_mdo_day_tank_p', 10, 3)->default(0);
                $table->float('volume_no2_mdo_day_tank_s', 10, 3)->default(0);
                $table->float('volume_no1_hfo_tank_p', 10, 3)->default(0);
                $table->float('volume_no2_hfo_tank_s', 10, 3)->default(0);
                $table->float('volume_hfo_sett_tank_p', 10, 3)->default(0);
                $table->float('volume_no1_hfo_day_tank_p', 10, 3)->default(0);
                $table->float('volume_no2_hfo_day_tank_s', 10, 3)->default(0);
                $table->float('draft_fore', 10, 3)->default(0);
                $table->float('draft_mid_p', 10, 3)->default(0);
                $table->float('draft_mid_s', 10, 3)->default(0);
                $table->float('draft_after', 10, 3)->default(0);
                $table->float('volume_slop_p', 10, 3)->default(0);
                $table->float('volume_slop_s', 10, 3)->default(0);

                // cargo pump status
                $table->datetime('pump_latest_update_at')->nullable()->default(null);
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

                $table->timestamps();
            });
        }
        
        return $model->setTable($tableName);
    }
}
