<?php

namespace App\Model\Engine;

use Carbon\Carbon;
use Hyperf\Database\Schema\Schema;
use Hyperf\DbConnection\Model\Model;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Model\Events\Updated;

class TypeS extends Model
{
    use \App\Model\Traits\LoggerTrait;

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
                $table->float('control_air_inlet', 12, 6)->default(0);
                $table->float('me_ac_cw_inlet_cooler', 12, 6)->default(0);
                $table->float('jcw_inlet', 12, 6)->default(0);
                $table->float('me_lo_inlet', 12, 6)->default(0);
                $table->float('scav_air_receiver', 12, 6)->default(0);
                $table->float('start_air_inlet', 12, 6)->default(0);
                $table->float('main_lub_oil', 12, 6)->default(0);
                $table->float('me_fo_inlet_engine', 12, 6)->default(0);
                $table->float('turbo_charger_speed_no_1', 12, 6)->default(0);
                $table->float('turbo_charger_speed_no_2', 12, 6)->default(0);
                $table->float('turbo_charger_speed_no_3', 12, 6)->default(0);
                $table->float('tachometer_turbocharge', 12, 6)->default(0);
                $table->float('main_engine_speed', 12, 6)->default(0);
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
        $last = TypeSLog::table($model->fleet_id, $date)->orderBy('terminal_time', 'desc')->first();
        $now = Carbon::parse($date);

        $this->logger('engine', $model->makeHidden(['id', 'fleet_id', 'created_at', 'updated_at'])->toArray());
        
        // save interval 60 detik
        if($last && $now->diffInSeconds($last->terminal_time) < config('mqtt.interval_save', 60) ) {   
            return;
        }

        return TypeSLog::table($model->fleet_id, $date)->updateOrCreate([
            'fleet_id' => $model->fleet_id,
            'terminal_time' => $date,
        ], (array) $model->makeHidden(['id', 'fleet_id', 'created_at', 'updated_at'])->toArray());
    }
}