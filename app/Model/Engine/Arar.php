<?php

namespace App\Model\Engine;

use Carbon\Carbon;
use Hyperf\Database\Schema\Schema;
use Hyperf\DbConnection\Model\Model;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Model\Events\Updated;

class Arar extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'engines';

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
    public static function table($fleetId)
    {
        $model = new self;
        $tableName = $model->getTable() . "_{$fleetId}";
       
        if(! Schema::hasTable($tableName)) {
            
            Schema::create($tableName, function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('fleet_id')->index();
                $table->datetime('terminal_time')->index();
                $table->float('no_1_generator_winding_u_phase_value', 10, 3)->default(0);
                $table->float('no_1_generator_winding_v_phase_value', 10, 3)->default(0);
                $table->float('no_1_generator_winding_w_phase_value', 10, 3)->default(0);
                $table->float('stern_shaft_aft_bearing_temp_value', 10, 3)->default(0);
                $table->float('no_2_generator_winding_v_phase_value', 10, 3)->default(0);
                $table->float('no_2_generator_winding_w_phase_value', 10, 3)->default(0);
                $table->float('no_2_generator_winding_u_phase_value', 10, 3)->default(0);
                $table->float('no_3_generator_winding_u_phase_value', 10, 3)->default(0);
                $table->float('no_3_generator_winding_v_phase_value', 10, 3)->default(0);
                $table->float('no_3_generator_winding_w_phase_value', 10, 3)->default(0);
                $table->float('no_1_generator_ht_fw_outlet_temp_value', 10, 3)->default(0);
                $table->float('no_2_generator_ht_fw_outlet_temp_value', 10, 3)->default(0);
                $table->float('no_3_generator_ht_fw_outlet_temp_value', 10, 3)->default(0);
                $table->float('stern_shaft_intermediat_bearing_temp_value', 10, 3)->default(0);
                $table->float('no_1_generator_exh_gas_tc_outlet_temp_value', 10, 3)->default(0);
                $table->float('no_2_generator_exh_gas_tc_outlet_temp_value', 10, 3)->default(0);
                $table->float('no_3_generator_exh_gas_tc_outlet_temp_value', 10, 3)->default(0);
                $table->float('generator_ht_fw_pressure_value', 10, 3)->default(0);
                $table->float('no_1_generator_lo_press_value', 10, 3)->default(0);
                $table->float('no_2_generator_ht_fw_press_value', 10, 3)->default(0);
                $table->float('no_2_generator_lo_press_value', 10, 3)->default(0);
                $table->float('no_3_generator_ht_fw_press_value', 10, 3)->default(0);
                $table->float('no_3_generator_lo_press_value', 10, 3)->default(0);
                $table->float('hsd_stor_tank_p_level_value', 10, 3)->default(0);
                $table->float('hsd_stor_tank_s_level_value', 10, 3)->default(0);
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
        $last = ArarLog::table($model->fleet_id, $date)->orderBy('terminal_time', 'desc')->first();
        $now = Carbon::parse($date);

        // save interval 60 detik
        if($last && $now->diffInSeconds($last->terminal_time) < config('mqtt.interval_save', 60) ) {   
            return;
        }

        return ArarLog::table($model->fleet_id, $date)->updateOrCreate([
            'fleet_id' => $model->fleet_id,
            'terminal_time' => $date,
        ], (array) $model->makeHidden(['id', 'fleet_id', 'created_at', 'updated_at'])->toArray());
    }
}