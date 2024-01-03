<?php

namespace App\Model\Engine;

use Carbon\Carbon;
use Hyperf\Database\Schema\Schema;
use Hyperf\DbConnection\Model\Model;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Model\Events\Updated;

class Parigi extends Model
{
    

    /**
     * The table associated with the model.
     */
    protected ?string $table = 'engines';

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
    public static function table($fleetId)
    {
        $model = new self;
        $tableName = $model->getTable() . "_{$fleetId}";
        
        if(! Schema::hasTable($tableName)) {
            Schema::create($tableName, function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('fleet_id')->index();
                $table->datetime('terminal_time')->index();
                $table->float('no1_ge_fo_inlet_press_low', 16, 2)->default(0);
                $table->float('me_jacket_cfw_inlet_press', 16, 2)->default(0);
                $table->float('no2_ge_cfw_inlet_press_low', 16, 2)->default(0);
                $table->float('starting_air_press_ecr', 16, 2)->default(0);
                $table->float('starting_air_press_low', 16, 2)->default(0);
                $table->float('tc_lo_inlet_press_low', 16, 2)->default(0);
                $table->float('mlo_pco_inlet_press_ecr', 16, 2)->default(0);
                $table->float('fo_inlet_press_low', 16, 2)->default(0);
                $table->float('me_air_cooler_cw_inlet_press', 16, 2)->default(0);
                $table->float('no1_ge_lo_inlet_press', 16, 2)->default(0);
                $table->float('no2_ge_lo_inlet_press', 16, 2)->default(0);
                $table->float('no3_ge_lo_inlet_press', 16, 2)->default(0);
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
        $last = ParigiLog::table($model->fleet_id, $date)->orderBy('terminal_time', 'desc')->first();
        $now = Carbon::parse($date);

        

        // save interval 60 detik
        if($last && $now->diffInSeconds($last->terminal_time) < config('mqtt.interval_save', 60) ) {   
            return;
        }

        return ParigiLog::table($model->fleet_id, $date)->updateOrCreate([
            'fleet_id' => $model->fleet_id,
            'terminal_time' => $date,
        ], (array) $model->makeHidden(['id', 'fleet_id', 'created_at', 'updated_at'])->toArray());
    }
}