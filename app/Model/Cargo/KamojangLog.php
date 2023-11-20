<?php

declare(strict_types=1);

namespace App\Model\Cargo;

use Carbon\Carbon;
use Hyperf\Database\Schema\Schema;
use Hyperf\DbConnection\Model\Model;
use App\Model\Alarm\SensorAlarmTrait;
use Hyperf\Database\Schema\Blueprint;

class KamojangLog extends Model
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
                
                $table->float('no_1_cargo_tank_p', 10, 3)->default(0);
                $table->float('temp_1ctp', 10, 3)->default(0);
                $table->float('no_1_cargo_tank_s', 10, 3)->default(0);
                $table->float('temp_1cts', 10, 3)->default(0);
                $table->float('no_2_cargo_tank_p', 10, 3)->default(0);
                $table->float('temp_2ctp', 10, 3)->default(0);
                $table->float('no_2_cargo_tank_s', 10, 3)->default(0);
                $table->float('temp_2cts', 10, 3)->default(0);
                $table->float('no_3_cargo_tank_p', 10, 3)->default(0);
                $table->float('temp_3ctp', 10, 3)->default(0);
                $table->float('no_3_cargo_tank_s', 10, 3)->default(0);
                $table->float('temp_3ctm', 10, 3)->default(0);
                $table->float('no_4_cargo_tank_p', 10, 3)->default(0);
                $table->float('temp_4ctp', 10, 3)->default(0);
                $table->float('no_4_cargo_tank_s', 10, 3)->default(0);
                $table->float('temp_4cts', 10, 3)->default(0);
                $table->float('no_5_cargo_tank_p', 10, 3)->default(0);
                $table->float('temp_5ctp', 10, 3)->default(0);
                $table->float('no_5_cargo_tank_s', 10, 3)->default(0);
                $table->float('temp_5cts', 10, 3)->default(0);
                $table->float('slop_tank_p', 10, 3)->default(0);
                $table->float('temp_stp', 10, 3)->default(0);
                $table->float('slop_tank_s', 10, 3)->default(0);
                $table->float('temp_sts', 10, 3)->default(0);

                // pump status
                $table->datetime('pump_timestamp')->nullable();
                $table->boolean('cargo_pump1_run')->nullable();
                $table->boolean('cargo_pump2_run')->nullable();
                $table->boolean('cargo_pump3_run')->nullable();
                $table->boolean('wballast_pump1_run')->nullable();
                $table->boolean('wballast_pump2_run')->nullable();
                $table->boolean('tank_cleanning_pump_run')->nullable();
                $table->boolean('stripping_pump1_run')->nullable();
                $table->boolean('stripping_pump2_run')->nullable();

                $table->timestamps();
            });
        }
        
        return $model->setTable($tableName);
    }


    // Calculate percentage cargo capacity
    public function cargoCapacity($model) : void {
    
        $cargoArray = [
            'no_1_cargo_tank_p', 
            'no_1_cargo_tank_s', 
            'no_2_cargo_tank_p', 
            'no_2_cargo_tank_s',
            'no_3_cargo_tank_p', 
            'no_3_cargo_tank_s', 
            'no_4_cargo_tank_p', 
            'no_4_cargo_tank_s',
            'no_5_cargo_tank_p', 
            'no_5_cargo_tank_s',
        ];

        $sensors = \App\Model\Sensor::where('fleet_id', $model->fleet_id)->where('group', 'cargo')->pluck('danger', 'sensor_name')->toArray();
        $data = [];
        foreach($cargoArray as $c) {
            $max = $sensors[$c];
            $value = $model->{$c};
            
            $percentage = ($value <= $max)? ($value / $max) : 0;
            $data[$c] = (1 - $percentage);
        }
        
        $totalPercentage = 0;
        foreach($data as $d) {
            $totalPercentage += $d;
        }

        $percentageCargo = $totalPercentage / count($cargoArray);

        $now = \Carbon\Carbon::now();
        $fsr = \App\Model\FleetDailyReport::table($model->fleet_id)->where([
            'fleet_id' => $model->fleet_id,
            'date' => $now->format('Y-m-d'),
            'sensor' => 'cargo_percentage'
        ])->first();
        
        if(! $fsr) {
            $fsr = \App\Model\FleetDailyReport::table($model->fleet_id);
            $fsr->fleet_id = $model->fleet_id;
            $fsr->date = $now->format('Y-m-d');
            $fsr->sensor = 'cargo_percentage';
            $fsr->before = $percentageCargo;
        }

        $fsr->after = $percentageCargo;
        $fsr->value = ($fsr->after - $fsr->before);
        $fsr->save();
    }
}
