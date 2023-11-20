<?php

declare(strict_types=1);

namespace App\Model\Cargo;

use Carbon\Carbon;
use Hyperf\Database\Schema\Schema;
use Hyperf\DbConnection\Model\Model;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Model\Events\Updated;

class Arar extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'cargo';

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
    public static function table($fleetId)
    {
        $model = new self;
        $tableName = $model->getTable() . "_{$fleetId}";
        
        if(! Schema::hasTable($tableName)) {
            Schema::create($tableName, function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('fleet_id')->index();
                $table->datetime('terminal_time')->index();
                $table->float('pressure_tank_tank1', 10, 3)->default(0);
                $table->float('level_tank1', 10, 3)->default(0);
                $table->float('bottom_temp_tank1', 10, 3)->default(0);
                $table->float('middle_temp_tank1', 10, 3)->default(0);
                $table->float('top_temp_tank1', 10, 3)->default(0);
                $table->float('motor_current_tank1', 10, 3)->default(0);
                $table->float('sp_low_current_pm5101_tank1', 10, 3)->default(0);
                $table->float('sp_bottom_temp_t5101_tank1', 10, 3)->default(0);
                $table->float('pressure_tank_tank2', 10, 3)->default(0);
                $table->float('level_tank2', 10, 3)->default(0);
                $table->float('bottom_temp_tank2', 10, 3)->default(0);
                $table->float('middle_temp_tank2', 10, 3)->default(0);
                $table->float('top_temp_tank2', 10, 3)->default(0);
                $table->float('motor_current_tank2', 10, 3)->default(0);
                $table->float('sp_low_current_pm5101_tank2', 10, 3)->default(0);
                $table->float('sp_bottom_temp_t5101_tank2', 10, 3)->default(0);
                $table->float('heating_crossover_outloading', 10, 3)->default(0);
                $table->float('cm1101_motor_current', 10, 3)->default(0);
                $table->float('cm1201_motor_current', 10, 3)->default(0);

                // Pump Status
                $table->datetime('pump_latest_update_at')->nullable();
                $table->boolean('esd_ca_board')->nullable();
                $table->boolean('esd_wheel_house')->nullable();
                $table->boolean('esd_compressor_room')->nullable();
                $table->boolean('esd_tank_5100')->nullable();
                $table->boolean('esd_tank_5200')->nullable();
                $table->boolean('esd_cross_over_1')->nullable();
                $table->boolean('esd_cross_over_2')->nullable();
                $table->boolean('fire_air_system')->nullable();
                $table->boolean('esd_relais')->nullable();
                $table->boolean('98_tank_t5100')->nullable();
                $table->boolean('L1101')->nullable();
                $table->boolean('P9801')->nullable();
                $table->boolean('P1102')->nullable();
                $table->boolean('T1102')->nullable();
                $table->boolean('PD1103')->nullable();
                $table->boolean('CM1101_HSH_start')->nullable();
                $table->boolean('CM1101_HSH_stop')->nullable();
                $table->boolean('not_used')->nullable();
                $table->boolean('cm1101_run')->nullable();
                $table->boolean('cm1101_fault')->nullable();
                $table->boolean('cm101_winding_temp')->nullable();
                $table->boolean('pm5101_hsh_start')->nullable();
                $table->boolean('pm5101_hsl_start')->nullable();
                $table->boolean('pm5101_power_avail')->nullable();
                $table->boolean('pm5101_run')->nullable();
                $table->boolean('pm5101_fault')->nullable();
                $table->boolean('pm5101_winding_temp')->nullable();
                $table->boolean('L5102')->nullable();
                $table->boolean('P5103_al')->nullable();
                $table->boolean('p5103_ah_vcm')->nullable();
                $table->boolean('p5102_ah_standard')->nullable();
                $table->boolean('l5104')->nullable();
                $table->boolean('98_tank_5200')->nullable();
                $table->boolean('P9803')->nullable();
                $table->boolean('cm1201_hsh_start')->nullable();
                $table->boolean('cm1201_hsl_stop')->nullable();
                $table->boolean('cm1201_run')->nullable();
                $table->boolean('cm1201_fault')->nullable();
                $table->boolean('cm1201_winding_temp')->nullable();
                $table->boolean('pm5201_hsh_start')->nullable();
                $table->boolean('pm5201_hsl_stop')->nullable();
                $table->boolean('pm5201_run')->nullable();
                $table->boolean('pm5201_fault')->nullable();
                $table->boolean('pm5201_winding_temp')->nullable();
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
