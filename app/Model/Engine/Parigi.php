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
                $table->float('mdo_tank_1p', 10, 3)->default(0);
                $table->float('mdo_tank_2s', 10, 3)->default(0);
                $table->float('mdo_day_tank_1p', 10, 3)->default(0);
                $table->float('mdo_day_tank_2s', 10, 3)->default(0);
                $table->float('hfo_tank_1p', 10, 3)->default(0);
                $table->float('hfo_tank_2s', 10, 3)->default(0);
                $table->float('hfo_day_tank_1p', 10, 3)->default(0);
                $table->float('hfo_day_tank_2s', 10, 3)->default(0);
                $table->float('hfo_setting_tank', 10, 3)->default(0);
                $table->float('mdo_setting_tank', 10, 3)->default(0);
                $table->float('me_rpm', 10, 3)->default(0);
                $table->float('spare_2', 10, 3)->default(0);
                $table->float('spare_3', 10, 3)->default(0);
                $table->float('spare_4', 10, 3)->default(0);
                $table->float('spare_5', 10, 3)->default(0);
                $table->float('spare_6', 10, 3)->default(0);
                $table->float('me_starting_air_pressure', 10, 3)->default(0);
                $table->float('scav_air_pressure', 10, 3)->default(0);
                $table->float('main_lo_pco_inlet_pressure', 10, 3)->default(0);
                $table->float('tc_lo_inlet_pressur_me', 10, 3)->default(0);
                $table->float('tc_tachometer', 10, 3)->default(0);
                $table->float('me_fo_inlet_pressure', 10, 3)->default(0);
                $table->float('me_jacket_cfw_inlet_pressure', 10, 3)->default(0);
                $table->float('me_lo_inlet_pressure', 10, 3)->default(0);
                $table->float('spare_7', 10, 3)->default(0);
                $table->float('spare_8', 10, 3)->default(0);
                $table->float('spare_9', 10, 3)->default(0);
                $table->float('spare_10', 10, 3)->default(0);
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