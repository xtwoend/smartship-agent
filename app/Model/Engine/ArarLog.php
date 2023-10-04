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
                // D0
                $table->float('me_rev_speed_con_value', 10, 3)->default(0);
                $table->float('tc_rev_speed_con_value', 10, 3)->default(0);
                $table->float('me_fo_rack_con_value', 10, 3)->default(0);
                $table->float('propeller_rev_con_value', 10, 3)->default(0);
                $table->float('me_lo_press_con_value', 10, 3)->default(0);
                $table->float('me_fo_press_con_value', 10, 3)->default(0);
                $table->float('me_h_temp_fw_press_con_value', 10, 3)->default(0);
                $table->float('booster_air_pressure_con_value', 10, 3)->default(0);
                $table->float('control_air_pressure_con_value', 10, 3)->default(0);
                $table->float('me_lo_inlet_temp_con_value', 10, 3)->default(0);
                $table->float('me_fw_high_temp_outlet_temp_con_value', 10, 3)->default(0);
                $table->float('me_booster_air_emp_con_value', 10, 3)->default(0);
                $table->float('me_exh_no1_cyl_temp_con_value', 10, 3)->default(0);
                $table->float('me_exh_no2_cyl_temp_con_value', 10, 3)->default(0);
                $table->float('me_exh_no3_cyl_temp_con_value', 10, 3)->default(0);
                $table->float('me_exh_no4_cyl_temp_con_value', 10, 3)->default(0);
                $table->float('me_exh_no5_cyl_temp_con_value', 10, 3)->default(0);
                $table->float('me_exh_no6_cyl_temp_con_value', 10, 3)->default(0);
                $table->float('me_exh_no7_cyl_temp_con_value', 10, 3)->default(0);
                $table->float('me_exh_no8_cyl_temp_con_value', 10, 3)->default(0);
                $table->float('tc_exh_in_temp1_con_value', 10, 3)->default(0);
                $table->float('tc_exh_in_temp2_con_value', 10, 3)->default(0);
                $table->float('tc_exh_out_temp_con_value', 10, 3)->default(0);

                // d55
                $table->float('exh_temp_set', 10, 3)->default(0);
                $table->float('deviation_high_set', 10, 3)->default(0);
                $table->float('deviation_low_set', 10, 3)->default(0);

                // d400
                $table->float('me_rev_speed_set_high', 10, 3)->default(0);
                $table->float('tc_rev_speed_set_high', 10, 3)->default(0);
                $table->float('me_fo_rack_set_high', 10, 3)->default(0);
                $table->float('propeller_rev_set_high', 10, 3)->default(0);
                $table->float('me_lo_press_set_high', 10, 3)->default(0);
                $table->float('me_fo_press_set_high', 10, 3)->default(0);
                $table->float('me_h_temp_fw_press_set_high', 10, 3)->default(0);
                $table->float('booster_air_pressure_set_high', 10, 3)->default(0);
                $table->float('control_air_pressure_set_high', 10, 3)->default(0);
                $table->float('me_lo_inlet_temp_set_high', 10, 3)->default(0);
                $table->float('me_fw_high_temp_outlet_temp_set_high', 10, 3)->default(0);
                $table->float('me_booster_air_emp_set_high', 10, 3)->default(0);
                $table->float('me_exh_no1_cyl_temp_set_high', 10, 3)->default(0);
                $table->float('me_exh_no2_cyl_temp_set_high', 10, 3)->default(0);
                $table->float('me_exh_no3_cyl_temp_set_high', 10, 3)->default(0);
                $table->float('me_exh_no4_cyl_temp_set_high', 10, 3)->default(0);
                $table->float('me_exh_no5_cyl_temp_set_high', 10, 3)->default(0);
                $table->float('me_exh_no6_cyl_temp_set_high', 10, 3)->default(0);
                $table->float('me_exh_no7_cyl_temp_set_high', 10, 3)->default(0);
                $table->float('me_exh_no8_cyl_temp_set_high', 10, 3)->default(0);
                $table->float('tc_exh_in_temp1_set_high', 10, 3)->default(0);
                $table->float('tc_exh_in_temp2_set_high', 10, 3)->default(0);
                $table->float('tc_exh_out_temp_set_high', 10, 3)->default(0);

                // d500
                $table->float('me_rev_speed_set_low', 10, 3)->default(0);
                $table->float('tc_rev_speed_set_low', 10, 3)->default(0);
                $table->float('me_fo_rack_set_low', 10, 3)->default(0);
                $table->float('propeller_rev_set_low', 10, 3)->default(0);
                $table->float('me_lo_press_set_low', 10, 3)->default(0);
                $table->float('me_fo_press_set_low', 10, 3)->default(0);
                $table->float('me_h_temp_fw_press_set_low', 10, 3)->default(0);
                $table->float('booster_air_pressure_set_low', 10, 3)->default(0);
                $table->float('control_air_pressure_set_low', 10, 3)->default(0);
                $table->float('me_lo_inlet_temp_set_low', 10, 3)->default(0);
                $table->float('me_fw_high_temp_outlet_temp_set_low', 10, 3)->default(0);
                $table->float('me_booster_air_emp_set_low', 10, 3)->default(0);
                $table->float('me_exh_no1_cyl_temp_set_low', 10, 3)->default(0);
                $table->float('me_exh_no2_cyl_temp_set_low', 10, 3)->default(0);
                $table->float('me_exh_no3_cyl_temp_set_low', 10, 3)->default(0);
                $table->float('me_exh_no4_cyl_temp_set_low', 10, 3)->default(0);
                $table->float('me_exh_no5_cyl_temp_set_low', 10, 3)->default(0);
                $table->float('me_exh_no6_cyl_temp_set_low', 10, 3)->default(0);
                $table->float('me_exh_no7_cyl_temp_set_low', 10, 3)->default(0);
                $table->float('me_exh_no8_cyl_temp_set_low', 10, 3)->default(0);
                $table->float('tc_exh_in_temp1_set_low', 10, 3)->default(0);
                $table->float('tc_exh_in_temp2_set_low', 10, 3)->default(0);
                $table->float('tc_exh_out_temp_set_low', 10, 3)->default(0);
                
                $table->timestamps();
            });
        }
        
        return $model->setTable($tableName);
    }
}