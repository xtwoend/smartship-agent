<?php

declare(strict_types=1);

namespace App\Model\CargoPump;

use Carbon\Carbon;
use Hyperf\Database\Schema\Schema;
use Hyperf\DbConnection\Model\Model;
use App\Model\Alarm\SensorAlarmTrait;
use Hyperf\Database\Schema\Blueprint;

class TypeSLog extends Model
{
    use SensorAlarmTrait;

    /**
     * engine group sensor
     */
    public array $sensor_group = ['cargo_pump'];
    
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'cargo_pump_log';

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
    public static function table($fleetId, $date = null)
    {
        $date = is_null($date) ? date('Ym'): Carbon::parse($date)->format('Ym');
        $model = new self;
        $tableName = $model->getTable() . "_{$fleetId}_{$date}";
        
        if(! Schema::hasTable($tableName)) {
            Schema::create($tableName, function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('fleet_id')->index();
                $table->datetime('terminal_time')->unique();
                $table->float('pump_non_drvend_c1', 10, 5)->default(0);
                $table->float('pump_casing_c1', 10, 5)->default(0);
                $table->float('pump_drvend_c1', 10, 5)->default(0);
                $table->float('transmission_sealing_c1', 10, 5)->default(0);
                $table->float('pump_non_drvend_c2', 10, 5)->default(0);
                $table->float('pump_casing_c2', 10, 5)->default(0);
                $table->float('pump_drvend_c2', 10, 5)->default(0);
                $table->float('transmission_sealing_c2', 10, 5)->default(0);
                $table->float('pump_non_drvend_c3', 10, 5)->default(0);
                $table->float('pump_casing_c3', 10, 5)->default(0);
                $table->float('pump_drvend_c3', 10, 5)->default(0);
                $table->float('transmission_sealing_c3', 10, 5)->default(0);
                $table->float('pump_non_drvend_bp1', 10, 5)->default(0);
                $table->float('pump_casing_bp1', 10, 5)->default(0);
                $table->float('pump_drvend_bp1', 10, 5)->default(0);
                $table->float('transmission_sealing_bp1', 10, 5)->default(0);
                $table->float('pump_non_drvend_bp2', 10, 5)->default(0);
                $table->float('pump_casing_bp2', 10, 5)->default(0);
                $table->float('pump_drvend_bp2', 10, 5)->default(0);
                $table->float('transmission_sealing_bp2', 10, 5)->default(0);
                $table->float('pump_non_drvend_sp1', 10, 5)->default(0);
                $table->float('pump_casing_sp1', 10, 5)->default(0);
                $table->float('pump_drvend_sp1', 10, 5)->default(0);
                $table->float('transmission_sealing_sp1', 10, 5)->default(0);
                $table->float('pump_non_drvend_tcp', 10, 5)->default(0);
                $table->float('pump_casing_tcp', 10, 5)->default(0);
                $table->float('pump_drvend_tcp', 10, 5)->default(0);
                $table->float('transmission_sealing_tcp', 10, 5)->default(0);
                $table->float('vacuum_pump1', 10, 5)->default(0);
                $table->float('vacuum_pump2', 10, 5)->default(0);
                $table->float('dsch_press_c1', 10, 5)->default(0);
                $table->float('dsch_press_c2', 10, 5)->default(0);
                $table->float('dsch_press_c3', 10, 5)->default(0);
                $table->float('vibration_c1', 10, 5)->default(0);
                $table->float('vibration_c2', 10, 5)->default(0);
                $table->float('vibration_c3', 10, 5)->default(0);
                $table->float('tcm_sw_temp', 10, 5)->default(0);
                $table->float('tcm_sw_press', 10, 5)->default(0);
                $table->timestamps();
            });
        }
        
        return $model->setTable($tableName);
    }
}
