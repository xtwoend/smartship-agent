<?php

declare(strict_types=1);

namespace App\Model\Cargo;

use Carbon\Carbon;
use App\Model\Cargo\TypeSLog;
use Hyperf\Database\Schema\Schema;
use Hyperf\DbConnection\Model\Model;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Model\Events\Updated;

class TypeA extends Model
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
                $table->float('temp_tank_upper_no1', 10, 3)->default(0);
                $table->float('temp_tank_upper_no2', 10, 3)->default(0);
                $table->float('temp_comp_outlet_no1', 10, 3)->default(0);
                $table->float('pressure_tank_no1', 10, 3)->default(0);
                $table->float('tamp_tank_middle_no1', 10, 3)->default(0);
                $table->float('tamp_tank_middle_no2', 10, 3)->default(0);
                $table->float('temp_comp_outlet_no2', 10, 3)->default(0);
                $table->float('pressure_tank_no2', 10, 3)->default(0);
                $table->float('tamp_tank_bottom_no1', 10, 3)->default(0);
                $table->float('tamp_tank_bottom_no2', 10, 3)->default(0);
                $table->float('pressure_comp_inlet', 10, 3)->default(0);
                $table->float('pressure_comp_outlet', 10, 3)->default(0);
                $table->float('ullage_cargo_no1', 10, 3)->default(0);
                $table->float('ullage_cargo_no2', 10, 3)->default(0);
                $table->float('data15', 10, 3)->default(0);
                $table->float('data16', 10, 3)->default(0);
                $table->float('cargo_pump1_run', 10, 3)->default(0);
                $table->float('cargo_pump2_run', 10, 3)->default(0);
                $table->float('compressor_no1_run', 10, 3)->default(0);
                $table->float('compressor_no2_run', 10, 3)->default(0);
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
        $last = TypeALog::table($model->fleet_id, $date)->orderBy('terminal_time', 'desc')->first();
     
        $now = Carbon::parse($date);

        $this->logger('cargo', $model->makeHidden(['id', 'fleet_id', 'created_at', 'updated_at'])->toArray());
        
        // save interval 60 detik
        if($last && $now->diffInSeconds($last->terminal_time) < config('mqtt.interval_save', 60) ) {   
            return;
        }
        
        return TypeALog::table($model->fleet_id, $date)->updateOrCreate([
            'fleet_id' => $model->fleet_id,
            'terminal_time' => $date,
        ], (array) $model->makeHidden(['id', 'fleet_id', 'created_at', 'updated_at'])->toArray());
    }
}
