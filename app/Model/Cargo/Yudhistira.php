<?php

declare(strict_types=1);

namespace App\Model\Cargo;

use Carbon\Carbon;
use Hyperf\Database\Schema\Schema;
use Hyperf\DbConnection\Model\Model;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Model\Events\Updated;

class Yudhistira extends Model
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
                // cargo
                $table->datetime('cargo_timestamp')->nullable();
                $table->float('pump_casing_temp_cop1', 10, 3)->nullable();
                $table->float('pump_de_bearing_temp_cop1', 10, 3)->nullable();
                $table->float('trans_bearing_temp_cop1', 10, 3)->nullable();
                $table->float('trans_sealing_temp_cop1', 10, 3)->nullable();
                $table->float('pump_casing_temp_cop2', 10, 3)->nullable();
                $table->float('pump_de_bearing_temp_cop2', 10, 3)->nullable();
                $table->float('trans_bearing_temp_cop2', 10, 3)->nullable();
                $table->float('trans_sealing_temp_cop2', 10, 3)->nullable();
                $table->float('pump_casing_temp_cop3', 10, 3)->nullable();
                $table->float('pump_de_bearing_temp_cop3', 10, 3)->nullable();
                $table->float('trans_bearing_temp_cop3', 10, 3)->nullable();
                $table->float('trans_sealing_temp_cop3', 10, 3)->nullable();
                $table->float('pump_nde_bearing_temp_sp1', 10, 3)->nullable();
                $table->float('pump_casing_temp_sp1', 10, 3)->nullable();
                $table->float('pump_de_bearing_temp_sp1', 10, 3)->nullable();
                $table->float('trans_bearing_sp1', 10, 3)->nullable();
                $table->float('trans_sealing_sp1', 10, 3)->nullable();
                $table->float('pump_nde_bearing_temp_sp2', 10, 3)->nullable();
                $table->float('pump_casing_temp_sp2', 10, 3)->nullable();
                $table->float('pump_de_bearing_temp_sp2', 10, 3)->nullable();
                $table->float('trans_bearing_sp2', 10, 3)->nullable();
                $table->float('trans_sealing_sp2', 10, 3)->nullable();
                $table->float('pump_casing_bp1', 10, 3)->nullable();
                $table->float('pump_de_bearing_bp1', 10, 3)->nullable();
                $table->float('trans_bearing_bp1', 10, 3)->nullable();
                $table->float('trans_sealing_bp1', 10, 3)->nullable();
                $table->float('pump_casing_bp2', 10, 3)->nullable();
                $table->float('pump_de_bearing_bp2', 10, 3)->nullable();
                $table->float('trans_bearing_bp2', 10, 3)->nullable();
                $table->float('trans_sealing_bp2', 10, 3)->nullable();
                $table->float('pump_nde_bearing_tcp', 10, 3)->nullable();
                $table->float('pump_casing_tcp', 10, 3)->nullable();
                $table->float('pump_de_bearing_tcp', 10, 3)->nullable();
                $table->float('trans_bearing_tcp', 10, 3)->nullable();
                $table->float('trans_sealing_tcp', 10, 3)->nullable();
                $table->float('bearing_temp_vp1', 10, 3)->nullable();
                $table->float('bearing_temp_vp2', 10, 3)->nullable();
                $table->float('throttle_valve_cop1', 10, 3)->nullable();
                $table->float('throttle_valve_cop2', 10, 3)->nullable();
                $table->float('throttle_valve_cop3', 10, 3)->nullable();
                $table->float('discharge_pressure_cop1', 10, 3)->nullable();
                $table->float('discharge_pressure_cop2', 10, 3)->nullable();
                $table->float('discharge_pressure_cop3', 10, 3)->nullable();
                $table->float('vibration_cop1', 10, 3)->nullable();
                $table->float('vibration_cop2', 10, 3)->nullable();
                $table->float('vibration_cop3', 10, 3)->nullable();

                // hanla
                $table->float('level_cot_1p', 10, 3)->nullable();
                $table->float('temp_cot_1p', 10, 3)->nullable();
                $table->float('level_cot_1s', 10, 3)->nullable();
                $table->float('temp_cot_1s', 10, 3)->nullable();
                $table->float('level_cot_2p', 10, 3)->nullable();
                $table->float('temp_cot_2p', 10, 3)->nullable();
                $table->float('level_cot_2s', 10, 3)->nullable();
                $table->float('temp_cot_2s', 10, 3)->nullable();
                $table->float('level_cot_3p', 10, 3)->nullable();
                $table->float('temp_cot_3p', 10, 3)->nullable();
                $table->float('level_cot_3s', 10, 3)->nullable();
                $table->float('temp_cot_3s', 10, 3)->nullable();
                $table->float('level_cot_4p', 10, 3)->nullable();
                $table->float('temp_cot_4p', 10, 3)->nullable();
                $table->float('level_cot_4s', 10, 3)->nullable();
                $table->float('temp_cot_4s', 10, 3)->nullable();
                $table->float('level_cot_5p', 10, 3)->nullable();
                $table->float('temp_cot_5p', 10, 3)->nullable();
                $table->float('level_cot_5s', 10, 3)->nullable();
                $table->float('temp_cot_5s', 10, 3)->nullable();
                $table->float('level_slop_p', 10, 3)->nullable();
                $table->float('temp_slop_p', 10, 3)->nullable();
                $table->float('level_slop_s', 10, 3)->nullable();
                $table->float('temp_slop_s', 10, 3)->nullable();
                $table->float('fore_peak_tank', 10, 3)->nullable();
                $table->float('level_wbt_1p', 10, 3)->nullable();
                $table->float('level_wbt_1s', 10, 3)->nullable();
                $table->float('level_wbt_2p', 10, 3)->nullable();
                $table->float('level_wbt_2s', 10, 3)->nullable();
                $table->float('level_wbt_3p', 10, 3)->nullable();
                $table->float('level_wbt_3s', 10, 3)->nullable();
                $table->float('level_wbt_4p', 10, 3)->nullable();
                $table->float('level_wbt_4s', 10, 3)->nullable();
                $table->float('level_wbt_5p', 10, 3)->nullable();
                $table->float('level_wbt_5s', 10, 3)->nullable();
                $table->float('level_draft_fore', 10, 3)->nullable();
                $table->float('level_draft_after', 10, 3)->nullable();
                $table->float('after_peak_tank', 10, 3)->nullable();
                $table->float('mdo_mgo_tank_p', 10, 3)->nullable();
                $table->float('mdo_tank_s', 10, 3)->nullable();
                $table->float('fore_fw_tank_p', 10, 3)->nullable();
                $table->float('fore_fw_tank_s', 10, 3)->nullable();
                $table->float('fw_tank_p', 10, 3)->nullable();
                $table->float('fw_tank_s', 10, 3)->nullable();
                $table->float('fo_overflow_tank', 10, 3)->nullable();

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
        $last = YudhistiraLog::table($model->fleet_id, $date)->orderBy('terminal_time', 'desc')->first();
     
        $now = Carbon::parse($date);

        // save interval 60 detik
        if($last && $now->diffInSeconds($last->terminal_time) < config('mqtt.interval_save', 60) ) {   
            return;
        }
        
        return YudhistiraLog::table($model->fleet_id, $date)->updateOrCreate([
            'fleet_id' => $model->fleet_id,
            'terminal_time' => $date,
        ], (array) $model->makeHidden(['id', 'fleet_id', 'created_at', 'updated_at'])->toArray());
    }
}
