<?php

namespace App\Model\Engine;

use Carbon\Carbon;
use Hyperf\Database\Schema\Schema;
use Hyperf\DbConnection\Model\Model;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Model\Events\Updated;

class Arar extends Model
{
    use \App\Model\Traits\LoggerTrait;

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

    // update & insert
    public function updated(Updated $event)
    {
        $model = $event->getModel();
        $date = $model->terminal_time;
        $last = ArarLog::table($model->fleet_id, $date)->orderBy('terminal_time', 'desc')->first();
        $now = Carbon::parse($date);

        $this->logger('engine', $model);

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