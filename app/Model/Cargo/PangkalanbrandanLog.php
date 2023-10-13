<?php

declare(strict_types=1);

namespace App\Model\Cargo;

use Carbon\Carbon;
use Hyperf\Database\Schema\Schema;
use Hyperf\DbConnection\Model\Model;
use App\Model\Alarm\SensorAlarmTrait;
use Hyperf\Database\Schema\Blueprint;

class PangkalanbrandanLog extends Model
{
    use SensorAlarmTrait;

    /**
     * engine group sensor
     */
    public array $sensor_group = ['cargo'];
    
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'cargo_log';

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
                
                $table->float('pump_non_drvend_c1', 10, 3)->default(0);
                $table->float('pump_casing_c1', 10, 3)->default(0);
                $table->float('bulk_head_c1', 10, 3)->default(0);
                $table->float('transmission_sealing_c1', 10, 3)->default(0);
                $table->float('pump_non_drvend_c2', 10, 3)->default(0);
                $table->float('pump_casing_c2', 10, 3)->default(0);
                $table->float('bulk_head_c2', 10, 3)->default(0);
                $table->float('transmission_sealing_c2', 10, 3)->default(0);
                $table->float('pump_non_drvend_c3', 10, 3)->default(0);
                $table->float('pump_casing_c3', 10, 3)->default(0);
                $table->float('bulk_head_c3', 10, 3)->default(0);
                $table->float('transmission_sealing_c3', 10, 3)->default(0);
                $table->float('pump_non_drvend_bp1', 10, 3)->default(0);
                $table->float('pump_casing_bp1', 10, 3)->default(0);
                $table->float('bulk_head_bp1', 10, 3)->default(0);
                $table->float('tansmission_sealing_bp1', 10, 3)->default(0);
                $table->float('pump_non_drvend_bp2', 10, 3)->default(0);
                $table->float('pump_casing_bp2', 10, 3)->default(0);
                $table->float('bulk_head_bp2', 10, 3)->default(0);
                $table->float('transmission_sealing_bp2', 10, 3)->default(0);
                $table->float('pump_non_drvend_sp1', 10, 3)->default(0);
                $table->float('pump_casing_sp1', 10, 3)->default(0);
                $table->float('bulk_head_sp1', 10, 3)->default(0);
                $table->float('transmission_sealing_sp1', 10, 3)->default(0);
                $table->float('pump_non_drvend_tcp', 10, 3)->default(0);
                $table->float('pump_casing_tcp', 10, 3)->default(0);
                $table->float('bulk_head_tcp', 10, 3)->default(0);
                $table->float('transmission_sealing_tcp', 10, 3)->default(0);

                $table->datetime('bunker_timestamp')->nullable();
                $table->float('hfo_storage_tank_1p', 10, 3)->default(0);
                $table->float('hfo_storage_tank_1s', 10, 3)->default(0);
                $table->float('hfo_storage_tank_2p', 10, 3)->default(0);
                $table->float('hfo_storage_tank_2s', 10, 3)->default(0);
                $table->float('hfo_setting_tank', 10, 3)->default(0);
                $table->float('hfo_service_tank_1', 10, 3)->default(0);
                $table->float('hfo_service_tank_2', 10, 3)->default(0);
                $table->float('mdo_storage_tank_p', 10, 3)->default(0);
                $table->float('mdo_storage_tank_s', 10, 3)->default(0);
                $table->float('mdo_setting_tank', 10, 3)->default(0);
                $table->float('mdo_service_tank_1', 10, 3)->default(0);
                $table->float('mdo_service_tank_2', 10, 3)->default(0);

                $table->datetime('pump_latest_update_at', 10, 3)->nullable();
                $table->boolean('cargo_pump1_run', 10, 3)->nullable();
                $table->boolean('cargo_pump1_alarm', 10, 3)->nullable();
                $table->boolean('cargo_pump2_run', 10, 3)->nullable();
                $table->boolean('cargo_pump2_alarm', 10, 3)->nullable();
                $table->boolean('cargo_pump3_run', 10, 3)->nullable();
                $table->boolean('cargo_pump3_alarm', 10, 3)->nullable();
                $table->boolean('ballast_pump1_run', 10, 3)->nullable();
                $table->boolean('ballast_pump1_alarm', 10, 3)->nullable();
                $table->boolean('ballast_pump2_run', 10, 3)->nullable();
                $table->boolean('ballast_pump2_alarm', 10, 3)->nullable();
                $table->boolean('stripping_pump_run', 10, 3)->nullable();
                $table->boolean('stripping_pump_alarm', 10, 3)->nullable();
                $table->boolean('cleaningtank_pump_run', 10, 3)->nullable();
                $table->boolean('cleaningtank_pump_alarm', 10, 3)->nullable();
                
                $table->timestamps();
            });
        }
        
        return $model->setTable($tableName);
    }
}
