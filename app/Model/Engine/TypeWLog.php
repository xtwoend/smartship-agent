<?php

namespace App\Model\Engine;

use Carbon\Carbon;
use Hyperf\Database\Schema\Schema;
use Hyperf\DbConnection\Model\Model;
use App\Model\Alarm\SensorAlarmTrait;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Model\Events\Updated;

class TypeWLog extends Model
{
    use SensorAlarmTrait;
    
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
                $table->float('me_tc_rpm_indicator', 12, 4)->default(0);
                $table->float('ai_hfo_bunker', 12, 4)->default(0);
                $table->float('ai_fwd_hfo_bunker', 12, 4)->default(0);
                $table->float('ai_ls_hfo_bunker', 12, 4)->default(0);
                $table->float('ai_hfo_service', 12, 4)->default(0);
                $table->float('ai_hfo_settling', 12, 4)->default(0);
                $table->float('ai_ls_hfo_settling', 12, 4)->default(0);
                $table->float('ai_mdo_storage', 12, 4)->default(0);
                $table->float('ai_mdo_service', 12, 4)->default(0);
                $table->float('ai_igg_fuel', 12, 4)->default(0);
                $table->float('me_fo_inlet_engine', 12, 4)->default(0);
                $table->float('me_lo_inlet_press', 12, 4)->default(0);
                $table->float('me_scav_air_inlet_press', 12, 4)->default(0);
                $table->float('me_jcfw_inlet_press', 12, 4)->default(0);
                $table->float('me_starting_air_inlet_press', 12, 4)->default(0);
                $table->float('me_cont_air_inlet_press', 12, 4)->default(0);
                $table->float('hfo_bunker_tank', 12, 4)->default(0);
                $table->float('fwd_hfo_bunker_tank', 12, 4)->default(0);
                $table->float('ls_hfo_bunker_tank', 12, 4)->default(0);
                $table->float('hfo_service_tank', 12, 4)->default(0);
                $table->float('ls_hfo_service_tank', 12, 4)->default(0);
                $table->float('hfo_settling_tank', 12, 4)->default(0);
                $table->float('ls_hfo_settling_tank', 12, 4)->default(0);
                $table->float('mdo_storage_tank', 12, 4)->default(0);
                $table->float('mdo_service_tank', 12, 4)->default(0);
                $table->float('igg_fuel_tank', 12, 4)->default(0);
                $table->float('rpm_me', 12, 4)->default(0);
                $table->timestamps();
            });
        }
        
        return $model->setTable($tableName);
    }
}