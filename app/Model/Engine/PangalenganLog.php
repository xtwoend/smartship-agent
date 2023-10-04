<?php

namespace App\Model\Engine;

use Carbon\Carbon;
use Hyperf\Database\Schema\Schema;
use Hyperf\DbConnection\Model\Model;
use App\Model\Alarm\SensorAlarmTrait;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Model\Events\Updated;

class PengalenganLog extends Model
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
                $table->float('control_air_inlet_pressure', 10, 3)->default(0);
                $table->float('me_fo_inlet_pressure', 10, 3)->default(0);
                $table->float('tc_lo_inlet_pressure', 10, 3)->default(0);
                $table->float('me_air_cooler_cw_inlet_pressure', 10, 3)->default(0);
                $table->float('main_lo_pco_inlet_pressure', 10, 3)->default(0);
                $table->float('jcw_inlet_pressure', 10, 3)->default(0);
                $table->float('me_starting_air_pressure', 10, 3)->default(0);
                $table->float('me_scavenging_air_pressure', 10, 3)->default(0);
                $table->float('no1_dg_lo_inlet_pressure', 10, 3)->default(0);
                $table->float('no2_dg_lo_inlet_pressure', 10, 3)->default(0);
                $table->float('no3_dg_lo_inlet_pressure', 10, 3)->default(0);
                $table->float('tc_tacho_rpm', 10, 3)->default(0);
                $table->timestamps();
            });
        }
        
        return $model->setTable($tableName);
    }
}