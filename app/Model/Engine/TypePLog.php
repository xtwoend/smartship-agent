<?php

namespace App\Model\Engine;

use Carbon\Carbon;
use Hyperf\Database\Schema\Schema;
use Hyperf\DbConnection\Model\Model;
use App\Model\Alarm\SensorAlarmTrait;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Model\Events\Updated;

class TypePLog extends Model
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
                $table->float('lo_inlet_pressure_ge1', 12, 5)->default(0);
                $table->float('cfw_inlet_pressure_ge1', 12, 5)->default(0);
                $table->float('fo_inlet_pressure_ge1', 12, 5)->default(0);
                $table->float('lo_inlet_pressure_ge2', 12, 5)->default(0);
                $table->float('cfw_inlet_pressure_ge2', 12, 5)->default(0);
                $table->float('fo_inlet_pressure_ge2', 12, 5)->default(0);
                $table->float('lo_inlet_pressure_ge3', 12, 5)->default(0);
                $table->float('cfw_inlet_pressure_ge3', 12, 5)->default(0);
                $table->float('fo_inlet_pressure_ge3', 12, 5)->default(0);
                $table->float('exgas_tc_inlet_temp_ge1', 12, 5)->default(0);
                $table->float('lo_inlet_temp_ge1', 12, 5)->default(0);
                $table->float('cfw_outlet_temp_ge1', 12, 5)->default(0);
                $table->float('exgas_tc_inlet_temp_ge2', 12, 5)->default(0);
                $table->float('lo_inlet_temp_ge2', 12, 5)->default(0);
                $table->float('cfw_outlet_temp_ge2', 12, 5)->default(0);
                $table->float('exgas_tc_inlet_temp_ge3', 12, 5)->default(0);
                $table->float('lo_inlet_temp_ge3', 12, 5)->default(0);
                $table->float('cfw_outlet_temp_ge3', 12, 5)->default(0);
                $table->float('sea_water_temp_ecr', 12, 5)->default(0);
                $table->float('stern_tube_fwd_bearing_temp', 12, 5)->default(0);
                $table->float('stern_tube_aft_bearing_temp', 12, 5)->default(0);
                $table->float('intermediate_shaft_bearing_temp', 12, 5)->default(0);
                $table->float('fo_service_tank1_temp', 12, 5)->default(0);
                $table->float('fo_service_tank2_temp', 12, 5)->default(0);
                $table->float('fo_service_tank3_temp', 12, 5)->default(0);
                $table->float('me_fo_inlet_pressure', 12, 5)->default(0);
                $table->float('tc_lo_inlet_pressure', 12, 5)->default(0);
                $table->float('me_main_low_pco_inlet_pressure', 12, 5)->default(0);
                $table->float('me_jacket_cw_inlet_pressure', 12, 5)->default(0);
                $table->float('me_air_cooler_cw_inlet_pressure', 12, 5)->default(0);
                $table->float('me_start_air_inlet_pressure', 12, 5)->default(0);
                $table->float('me_scavenge_air_pressure', 12, 5)->default(0);
                $table->float('me_control_air_inlet_pressure', 12, 5)->default(0);
                $table->float('main_air_reservoir_1_pressure', 12, 5)->default(0);
                $table->float('main_air_reservoir_2_pressure', 12, 5)->default(0);
                $table->float('me_cyl1_jcw_outlet_temp', 12, 5)->default(0);
                $table->float('me_cyl2_jcw_outlet_temp', 12, 5)->default(0);
                $table->float('me_cyl3_jcw_outlet_temp', 12, 5)->default(0);
                $table->float('me_cyl4_jcw_outlet_temp', 12, 5)->default(0);
                $table->float('me_cyl5_jcw_outlet_temp', 12, 5)->default(0);
                $table->float('me_cyl6_jcw_outlet_temp', 12, 5)->default(0);
                $table->float('me_jacket_cw_inlet_temp', 12, 5)->default(0);
                $table->float('me_fo_inlet_temp', 12, 5)->default(0);
                $table->float('me_thruster_bearing_temp', 12, 5)->default(0);
                $table->float('me_tc_lo_outlet_temp', 12, 5)->default(0);
                $table->float('me_scav_air_receiver_temp', 12, 5)->default(0);
                $table->float('me_air_cooler_cw_inlet_temp', 12, 5)->default(0);
                $table->float('me_cyl1_exhgas_outlet_temp', 12, 5)->default(0);
                $table->float('me_cyl2_exhgas_outlet_temp', 12, 5)->default(0);
                $table->float('me_cyl3_exhgas_outlet_temp', 12, 5)->default(0);
                $table->float('me_cyl4_exhgas_outlet_temp', 12, 5)->default(0);
                $table->float('me_cyl5_exhgas_outlet_temp', 12, 5)->default(0);
                $table->float('me_cyl6_exhgas_outlet_temp', 12, 5)->default(0);
                $table->float('me_tc_exhgas_inlet_temp', 12, 5)->default(0);
                $table->float('me_tc_exhgas_outlet_temp', 12, 5)->default(0);
                $table->float('me_cyl1_scav_air_fire_temp', 12, 5)->default(0);
                $table->float('me_cyl2_scav_air_fire_temp', 12, 5)->default(0);
                $table->float('me_cyl3_scav_air_fire_temp', 12, 5)->default(0);
                $table->float('me_cyl4_scav_air_fire_temp', 12, 5)->default(0);
                $table->float('me_cyl5_scav_air_fire_temp', 12, 5)->default(0);
                $table->float('me_cyl6_scav_air_fire_temp', 12, 5)->default(0);
                $table->float('me_main_lo_pco_inlet_temp', 12, 5)->default(0);
                $table->float('me_cyl1_pco_outlet_temp', 12, 5)->default(0);
                $table->float('me_cyl2_pco_outlet_temp', 12, 5)->default(0);
                $table->float('me_cyl3_pco_outlet_temp', 12, 5)->default(0);
                $table->float('me_cyl4_pco_outlet_temp', 12, 5)->default(0);
                $table->float('me_cyl5_pco_outlet_temp', 12, 5)->default(0);
                $table->float('me_cyl6_pco_outlet_temp', 12, 5)->default(0);
                $table->float('me_cyl1_fore_main_bear_temp', 12, 5)->default(0);
                $table->float('me_cyl1_main__bearing_temp', 12, 5)->default(0);
                $table->float('me_cyl2_main__bearing_temp', 12, 5)->default(0);
                $table->float('me_cyl3_main__bearing_temp', 12, 5)->default(0);
                $table->float('me_cyl4_main__bearing_temp', 12, 5)->default(0);
                $table->float('me_cyl5_main__bearing_temp', 12, 5)->default(0);
                $table->float('me_cyl6_main__bearing_temp', 12, 5)->default(0);
                $table->float('me_thrust_radial_bearing_temp', 12, 5)->default(0);
                $table->float('control_air_inlet_pressure', 12, 5)->default(0);
                $table->timestamps();
            });
        }
        
        return $model->setTable($tableName);
    }
}