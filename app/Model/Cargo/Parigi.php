<?php

declare(strict_types=1);

namespace App\Model\Cargo;

use Carbon\Carbon;
use Hyperf\Database\Schema\Schema;
use Hyperf\DbConnection\Model\Model;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Model\Events\Updated;

class Parigi extends Model
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

                $table->float('no1_cargo_tank_p_level', 10, 3)->default(0);
                $table->float('no1_cargo_tank_p_temp', 10, 3)->default(0);
                $table->float('no1_cargo_tank_s_level', 10, 3)->default(0);
                $table->float('no1_cargo_tank_s_temp', 10, 3)->default(0);

                $table->float('no2_cargo_tank_p_level', 10, 3)->default(0);
                $table->float('no2_cargo_tank_p_temp', 10, 3)->default(0);
                $table->float('no2_cargo_tank_s_level', 10, 3)->default(0);
                $table->float('no2_cargo_tank_s_temp', 10, 3)->default(0);

                $table->float('no3_cargo_tank_p_level', 10, 3)->default(0);
                $table->float('no3_cargo_tank_p_temp', 10, 3)->default(0);
                $table->float('no3_cargo_tank_s_level', 10, 3)->default(0);
                $table->float('no3_cargo_tank_s_temp', 10, 3)->default(0);

                $table->float('no4_cargo_tank_p_level', 10, 3)->default(0);
                $table->float('no4_cargo_tank_p_temp', 10, 3)->default(0);
                $table->float('no4_cargo_tank_s_level', 10, 3)->default(0);
                $table->float('no4_cargo_tank_s_temp', 10, 3)->default(0);

                $table->float('no5_cargo_tank_p_level', 10, 3)->default(0);
                $table->float('no5_cargo_tank_p_temp', 10, 3)->default(0);
                $table->float('no5_cargo_tank_s_level', 10, 3)->default(0);
                $table->float('no5_cargo_tank_s_temp', 10, 3)->default(0);

                $table->float('slop_tank_p_level', 10, 3)->default(0);
                $table->float('slop_tank_p_temp', 10, 3)->default(0);

                $table->float('slop_tank_s_level', 10, 3)->default(0);
                $table->float('slop_tank_s_temp', 10, 3)->default(0);


                // cargo 
                $table->datetime('cargo_timestamp')->nullable();
                $table->float('bottom_gear_cp1', 10, 3)->default(0);
                $table->float('pump_casing_c1', 10, 3)->default(0);
                $table->float('upper_gear_cp1', 10, 3)->default(0);
                $table->float('transmission_seal_c1', 10, 3)->default(0);
                $table->float('trans_v_bearing_c1', 10, 3)->default(0);
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
                $table->float('tansmission_seal_cp3', 10, 3)->default(0);
                $table->float('throtle_position_cp3', 10, 3)->default(0);
                $table->float('pump_casing_bp1', 10, 3)->default(0);
                $table->float('upper_gear_bp1', 10, 3)->default(0);
                $table->float('transmission_sealing_bp1', 10, 3)->default(0);
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
                $table->float('transmission_v_bearing_sp', 10, 3)->default(0);
                $table->float('bottom_gear_tcp', 10, 3)->default(0);
                $table->float('pump_casing_tcp', 10, 3)->default(0);
                $table->float('upper_gear_tcp', 10, 3)->default(0);
                $table->float('transmission_seal_tcp', 10, 3)->default(0);
                $table->float('transmission_v_bearing_tcp', 10, 3)->default(0);
                $table->float('suction_cp1', 10, 3)->default(0);
                $table->float('suction_cp2', 10, 3)->default(0);
                $table->float('suction_cp3', 10, 3)->default(0);
                $table->float('suction_sp', 10, 3)->default(0);
                $table->float('suction_tcp', 10, 3)->default(0);
                $table->float('suction_bp1', 10, 3)->default(0);
                $table->float('suction_bp2', 10, 3)->default(0);
                $table->float('vibration_cp1', 10, 3)->default(0);
                $table->float('vibration_cp2', 10, 3)->default(0);
                $table->float('vibration_cp3', 10, 3)->default(0);
                $table->float('discharge_cp1', 10, 3)->default(0);
                $table->float('discharge_cp2', 10, 3)->default(0);
                $table->float('discharge_cp3', 10, 3)->default(0);
                $table->float('dicharge_press_sp', 10, 3)->default(0);
                $table->float('discharge_press_tcp', 10, 3)->default(0);
                $table->float('discharge_press_bp1', 10, 3)->default(0);
                $table->float('discharge_press_bp2', 10, 3)->default(0);
                $table->float('vacuum_manifold_pressure', 10, 3)->default(0);

                // pump status
                $table->datetime('cargo_pump_timestamp')->nullable();
                $table->boolean('cargo_pump1_run')->default(0);
                $table->boolean('cargo_pump2_run')->default(0);
                $table->boolean('cargo_pump3_run')->default(0);
                $table->boolean('ballast_pump1_run')->default(0);
                $table->boolean('ballast_pump2_run')->default(0);
                $table->boolean('stripping_pump_run')->default(0);
                $table->boolean('vacuum_pump1_run')->default(0);
                $table->boolean('vacuum_pump2_run')->default(0);
                $table->boolean('tank_cleaning_pump_run')->default(0);

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
        $last = ParigiLog::table($model->fleet_id, $date)->orderBy('terminal_time', 'desc')->first();
     
        $now = Carbon::parse($date);

       

        // save interval 60 detik
        if($last && $now->diffInSeconds($last->terminal_time) < config('mqtt.interval_save', 60) ) {   
            return;
        }
        
        return ParigiLog::table($model->fleet_id, $date)->updateOrCreate([
            'fleet_id' => $model->fleet_id,
            'terminal_time' => $date,
        ], (array) $model->makeHidden(['id', 'fleet_id', 'created_at', 'updated_at'])->toArray());
    }
}
