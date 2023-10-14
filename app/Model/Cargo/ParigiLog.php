<?php

declare(strict_types=1);

namespace App\Model\Cargo;

use Carbon\Carbon;
use Hyperf\Database\Schema\Schema;
use Hyperf\DbConnection\Model\Model;
use App\Model\Alarm\SensorAlarmTrait;
use Hyperf\Database\Schema\Blueprint;

class ParigiLog extends Model
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
                
                $table->float('no1_cargo_tank_p_level', 10, 3)->default(0);
                $table->float('no1_cargo_tank_p_temp', 10, 3)->default(0);
                $table->float('no1_cargo_tank_s_level', 10, 3)->default(0);
                $table->float('no1_cargo_tank_s_temp', 10, 3)->default(0);

                $table->float('no2_cargo_tank_p_level', 10, 3)->default(0);
                $table->float('no2_cargo_tank_p_temp', 10, 3)->default(0);
                $table->float('no2_cargo_tank_s_level', 10, 3)->default(0);
                $table->float('no2_cargo_tank_s_temp', 10, 3)->default(0);

                $table->float('no3_cargo_tank_p_level', 10, 3)->default(0);
                $table->float('no3_cargo_tank_p_temp', 10, 3)->default(0);
                $table->float('no3_cargo_tank_s_level', 10, 3)->default(0);
                $table->float('no3_cargo_tank_s_temp', 10, 3)->default(0);

                $table->float('no4_cargo_tank_p_level', 10, 3)->default(0);
                $table->float('no4_cargo_tank_p_temp', 10, 3)->default(0);
                $table->float('no4_cargo_tank_s_level', 10, 3)->default(0);
                $table->float('no4_cargo_tank_s_temp', 10, 3)->default(0);

                $table->float('no5_cargo_tank_p_level', 10, 3)->default(0);
                $table->float('no5_cargo_tank_p_temp', 10, 3)->default(0);
                $table->float('no5_cargo_tank_s_level', 10, 3)->default(0);
                $table->float('no5_cargo_tank_s_temp', 10, 3)->default(0);

                $table->float('slop_tank_p_level', 10, 3)->default(0);
                $table->float('slop_tank_p_temp', 10, 3)->default(0);

                $table->float('slop_tank_s_level', 10, 3)->default(0);
                $table->float('slop_tank_s_temp', 10, 3)->default(0);
                
                $table->timestamps();
            });
        }
        
        return $model->setTable($tableName);
    }
}
