<?php

declare(strict_types=1);

namespace App\Model\Cargo;

use Carbon\Carbon;
use Hyperf\Database\Schema\Schema;
use Hyperf\DbConnection\Model\Model;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Model\Events\Updated;

class Attaka extends Model
{
    use \App\Model\Traits\LoggerTrait;

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

                $table->datetime('pump_latest_update_at')->nullable()->default(null);
                $table->boolean('esd_ca_board')->nullable()->default(null);
                $table->boolean('esd_wheel_house')->nullable()->default(null);
                $table->boolean('esd_compressor_room')->nullable()->default(null);
                $table->boolean('esd_tank_5100')->nullable()->default(null);
                $table->boolean('esd_tank_5200')->nullable()->default(null);
                $table->boolean('esd_cross_over_1')->nullable()->default(null);
                $table->boolean('esd_cross_over_2')->nullable()->default(null);
                $table->boolean('fire_air_system')->nullable()->default(null);
                $table->boolean('esd_relais')->nullable()->default(null);
                $table->boolean('98_tank_t5100')->nullable()->default(null);
                $table->boolean('L1101')->nullable()->default(null);
                $table->boolean('P9801')->nullable()->default(null);
                $table->boolean('P1102')->nullable()->default(null);
                $table->boolean('T1102')->nullable()->default(null);
                $table->boolean('PD1103')->nullable()->default(null);
                $table->boolean('CM1101_HSH_start')->nullable()->default(null);
                $table->boolean('CM1101_HSH_stop')->nullable()->default(null);
                $table->boolean('not_used')->nullable()->default(null);
                $table->boolean('cm1101_run')->nullable()->default(null);
                $table->boolean('cm1101_fault')->nullable()->default(null);
                $table->boolean('cm101_winding_temp')->nullable()->default(null);
                $table->boolean('pm5101_hsh_start')->nullable()->default(null);
                $table->boolean('pm5101_hsl_start')->nullable()->default(null);
                $table->boolean('pm5101_power_avail')->nullable()->default(null);
                $table->boolean('pm5101_run')->nullable()->default(null);
                $table->boolean('pm5101_fault')->nullable()->default(null);
                $table->boolean('pm5101_winding_temp')->nullable()->default(null);
                $table->boolean('L5102')->nullable()->default(null);
                $table->boolean('P5103_al')->nullable()->default(null);
                $table->boolean('p5103_ah_vcm')->nullable()->default(null);
                $table->boolean('p5102_ah_standard')->nullable()->default(null);
                $table->boolean('l5104')->nullable()->default(null);
                $table->boolean('98_tank_5200')->nullable()->default(null);
                $table->boolean('P9803')->nullable()->default(null);
                $table->boolean('cm1201_hsh_start')->nullable()->default(null);
                $table->boolean('cm1201_hsl_stop')->nullable()->default(null);
                $table->boolean('cm1201_run')->nullable()->default(null);
                $table->boolean('cm1201_fault')->nullable()->default(null);
                $table->boolean('cm1201_winding_temp')->nullable()->default(null);
                $table->boolean('pm5201_hsh_start')->nullable()->default(null);
                $table->boolean('pm5201_hsl_stop')->nullable()->default(null);
                $table->boolean('pm5201_run')->nullable()->default(null);
                $table->boolean('pm5201_fault')->nullable()->default(null);
                $table->boolean('pm5201_winding_temp')->nullable()->default(null);

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
        $last = AttakaLog::table($model->fleet_id, $date)->orderBy('terminal_time', 'desc')->first();
     
        $now = Carbon::parse($date);

        $this->logger('cargo', $model);

        // save interval 60 detik
        if($last && $now->diffInSeconds($last->terminal_time) < config('mqtt.interval_save', 60) ) {   
            return;
        }
        
        return AttakaLog::table($model->fleet_id, $date)->updateOrCreate([
            'fleet_id' => $model->fleet_id,
            'terminal_time' => $date,
        ], (array) $model->makeHidden(['id', 'fleet_id', 'created_at', 'updated_at'])->toArray());
    }
}
