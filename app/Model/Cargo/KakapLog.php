<?php

declare(strict_types=1);

namespace App\Model\Cargo;

use Hyperf\Database\Schema\Schema;
use Hyperf\DbConnection\Model\Model;
use Hyperf\Database\Schema\Blueprint;
use Carbon\Carbon;

class KakapLog extends Model
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
                $table->float('no_1_cargo_tank_p', 10, 3)->nullable();
                $table->float('temp_1ctp', 10, 3)->nullable();
                $table->float('no_1_cargo_tank_s', 10, 3)->nullable();
                $table->float('temp_1cts', 10, 3)->nullable();
                $table->float('no_2_cargo_tank_p', 10, 3)->nullable();
                $table->float('temp_2ctp', 10, 3)->nullable();
                $table->float('no_2_cargo_tank_s', 10, 3)->nullable();
                $table->float('temp_2cts', 10, 3)->nullable();
                $table->float('no_3_cargo_tank_p', 10, 3)->nullable();
                $table->float('temp_3ctp', 10, 3)->nullable();
                $table->float('no_3_cargo_tank_s', 10, 3)->nullable();
                $table->float('temp_3cts', 10, 3)->nullable();
                $table->float('no_4_cargo_tank_p', 10, 3)->nullable();
                $table->float('temp_4ctp', 10, 3)->nullable();
                $table->float('no_4_cargo_tank_s', 10, 3)->nullable();
                $table->float('temp_4cts', 10, 3)->nullable();
                $table->float('no_5_cargo_tank_p', 10, 3)->nullable();
                $table->float('temp_5ctp', 10, 3)->nullable();
                $table->float('no_5_cargo_tank_s', 10, 3)->nullable();
                $table->float('temp_5cts', 10, 3)->nullable();
                $table->float('no_6_cargo_tank_p', 10, 3)->nullable();
                $table->float('temp_6ctp', 10, 3)->nullable();
                $table->float('no_6_cargo_tank_s', 10, 3)->nullable();
                $table->float('temp_6cts', 10, 3)->nullable();
                $table->timestamps();
            });
        }
        
        return $model->setTable($tableName);
    }
}
