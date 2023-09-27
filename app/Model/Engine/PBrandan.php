<?php

namespace App\Model\Engine;

use Carbon\Carbon;
use Hyperf\Database\Schema\Schema;
use Hyperf\DbConnection\Model\Model;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Model\Events\Updated;

class PBrandan extends Model
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

                // bunker
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
        $last = PBrandanLog::table($model->fleet_id, $date)->orderBy('terminal_time', 'desc')->first();
        $now = Carbon::parse($date);

        // save interval 60 detik
        if($last && $now->diffInSeconds($last->terminal_time) < config('mqtt.interval_save', 60) ) {   
            return;
        }

        return PBrandanLog::table($model->fleet_id, $date)->updateOrCreate([
            'fleet_id' => $model->fleet_id,
            'terminal_time' => $date,
        ], (array) $model->makeHidden(['id', 'fleet_id', 'created_at', 'updated_at'])->toArray());
    }
}