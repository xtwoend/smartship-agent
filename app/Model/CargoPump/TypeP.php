<?php

declare(strict_types=1);

namespace App\Model\CargoPump;

use Carbon\Carbon;
use App\Model\CargoPump\TypeSLog;
use Hyperf\Database\Schema\Schema;
use Hyperf\DbConnection\Model\Model;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Model\Events\Updated;

class TypeP extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'cargo_pump';

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
        $tableName = $model->getTable() . '_{$fleetId}';
        
        if(! Schema::hasTable($tableName)) {
            Schema::create($tableName, function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('fleet_id')->index();
                $table->datetime('terminal_time')->index();
                $table->float('pump_non_drvend_c1', 15, 5)->default(0);
                $table->float('pump_casing_c1', 15, 5)->default(0);
                $table->float('bulk_head_c1', 15, 5)->default(0);
                $table->float('transmission_sealing_c1', 15, 5)->default(0);
                $table->float('pump_non_drvend_c2', 15, 5)->default(0);
                $table->float('pump_casing_c2', 15, 5)->default(0);
                $table->float('bulk_head_c2', 15, 5)->default(0);
                $table->float('transmission_sealing_c2', 15, 5)->default(0);
                $table->float('pump_non_drvend_c3', 15, 5)->default(0);
                $table->float('pump_casing_c3', 15, 5)->default(0);
                $table->float('bulk_head_c3', 15, 5)->default(0);
                $table->float('transmission_sealing_c3', 15, 5)->default(0);
                $table->float('pump_non_drvend_bp1', 15, 5)->default(0);
                $table->float('pump_casing_bp1', 15, 5)->default(0);
                $table->float('bulk_head_bp1', 15, 5)->default(0);
                $table->float('tansmission_sealing_bp1', 15, 5)->default(0);
                $table->float('pump_non_drvend_bp2', 15, 5)->default(0);
                $table->float('pump_casing_bp2', 15, 5)->default(0);
                $table->float('bulk_head_bp2', 15, 5)->default(0);
                $table->float('transmission_sealing_bp2', 15, 5)->default(0);
                $table->float('pump_non_drvend_sp1', 15, 5)->default(0);
                $table->float('pump_casing_sp1', 15, 5)->default(0);
                $table->float('bulk_head_sp1', 15, 5)->default(0);
                $table->float('transmission_sealing_sp1', 15, 5)->default(0);
                $table->float('pump_non_drvend_tcp', 15, 5)->default(0);
                $table->float('pump_casing_tcp', 15, 5)->default(0);
                $table->float('bulk_head_tcp', 15, 5)->default(0);
                $table->float('transmission_sealing_tcp', 15, 5)->default(0);
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
        $last = TypePLog::table($model->fleet_id, $date)->orderBy('terminal_time', 'desc')->first();
     
        $now = Carbon::parse($date);

        // save interval 60 detik
        if($last && $now->diffInSeconds($last->terminal_time) < config('mqtt.interval_save', 60) ) {   
            return;
        }
        
        return TypePLog::table($model->fleet_id, $date)->updateOrCreate([
            'fleet_id' => $model->fleet_id,
            'terminal_time' => $date,
        ], (array) $model->makeHidden(['id', 'fleet_id', 'created_at', 'updated_at'])->toArray());
    }
}
