<?php

declare(strict_types=1);

namespace App\Model\Cargo;

use Carbon\Carbon;
use Hyperf\Database\Schema\Schema;
use Hyperf\DbConnection\Model\Model;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Model\Events\Updated;

class Pasaman extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'cargo';

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
    public static function table($fleetId)
    {
        $model = new self;
        $tableName = $model->getTable() . "_{$fleetId}";
        
        if(! Schema::hasTable($tableName)) {
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


    // update & insert
    public function updated(Updated $event)
    {
        $model = $event->getModel();
       
        $date = $model->terminal_time;
        $last = PasamanLog::table($model->fleet_id, $date)->orderBy('terminal_time', 'desc')->first();
     
        $now = Carbon::parse($date);

        // save interval 60 detik
        if($last && $now->diffInSeconds($last->terminal_time) < config('mqtt.interval_save', 60) ) {   
            return;
        }
        
        return PasamanLog::table($model->fleet_id, $date)->updateOrCreate([
            'fleet_id' => $model->fleet_id,
            'terminal_time' => $date,
        ], (array) $model->makeHidden(['id', 'fleet_id', 'created_at', 'updated_at'])->toArray());
    }
}
