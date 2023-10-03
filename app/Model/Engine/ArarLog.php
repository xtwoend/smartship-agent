<?php

namespace App\Model\Engine;

use Carbon\Carbon;
use Hyperf\Database\Schema\Schema;
use Hyperf\DbConnection\Model\Model;
use App\Model\Alarm\SensorAlarmTrait;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Model\Events\Updated;

class ArarLog extends Model
{
    use SensorAlarmTrait;

    /**
     * engine group sensor
     */
    public array $sensor_group = ['engine'];
     
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
}