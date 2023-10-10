<?php

namespace App\Model\Engine;

use Carbon\Carbon;
use Hyperf\Database\Schema\Schema;
use Hyperf\DbConnection\Model\Model;
use App\Model\Alarm\SensorAlarmTrait;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Model\Events\Updated;

class KasimLog extends Model
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

    /**
     * engine group sensor
     */
    public array $sensor_group = ['engine'];

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
                // 
                $table->float('rpm_propeller', 10, 3)->default(0);
                $table->float('eng_htcw_pressure', 10, 3)->default(0);
                $table->float('eng_htcw_pressure', 10, 3)->default(0);

                $table->float('speed_lever_sig_factor_dep_idle_rpm', 10, 3)->default(0);
                $table->float('speed_lever_sig_factor_dep_idle_rpmcal', 10, 3)->default(0);
                $table->float('sld_command_rpm', 10, 3)->default(0);
                $table->float('sld_command_rpmcal', 10, 3)->default(0);
                $table->float('sld_command_rpm_hysl', 10, 3)->default(0);
                $table->float('sld_command_rpm_hysh', 10, 3)->default(0);
                $table->float('sensor_SE1704B', 10, 3)->default(0);

                $table->float('eng_exh_gas_temp_cyl1_te1601', 10, 3)->default(0);
                $table->float('eng_exh_gas_temp_cyl2_te1602', 10, 3)->default(0);
                $table->float('eng_exh_gas_temp_cyl3_te1603', 10, 3)->default(0);
                $table->float('eng_exh_gas_temp_cyl4_te1604', 10, 3)->default(0);
                $table->float('eng_exh_gas_temp_cyl5_te1605', 10, 3)->default(0);
                $table->float('eng_exh_gas_temp_cyl6_te1606', 10, 3)->default(0);
                $table->float('eng_exh_gas_temp_cyl7_te1607', 10, 3)->default(0);
                $table->float('eng_exh_gas_temp_cyl8_te1608', 10, 3)->default(0);
                $table->timestamps();
            });
        }
        
        return $model->setTable($tableName);
    }
}