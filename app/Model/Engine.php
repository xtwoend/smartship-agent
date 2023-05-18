<?php

declare(strict_types=1);

namespace App\Model;

use Carbon\Carbon;
use Hyperf\DbConnection\Model\Model;
use Hyperf\Database\Model\Events\Updated;

/**
 */
class Engine extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'engines';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [
        'vessel_id',
        'terminal_time',
        'control_air_inlet',
        'me_ac_cw_inlet_cooler',
        'jcw_inlet',
        'me_lo_inlet',
        'scav_air_receiver',
        'start_air_inlet',
        'main_lub_oil',
        'me_fo_inlet_engine',
        'turbo_charger_speed_no_1',
        'turbo_charger_speed_no_2',
        'turbo_charger_speed_no_3',
        'tachometer_turbocharge',
        'main_engine_speed',
    ];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = [
        'terminal_time' => 'datetime'
    ];


    public function updated(Updated $event)
    {
        $model = $event->getModel();
        $date = $model->terminal_time;
        $last = EngineLog::table($model->vessel_id, $date)->orderBy('terminal_time', 'desc')->first();
        $now = Carbon::parse($date);

        // save interval 60 detik
        if($last && $now->diffInSeconds($last->terminal_time) < config('mqtt.interval_save', 60) ) {   
            return;
        }

        return EngineLog::table($model->vessel_id, $date)->updateOrCreate([
            'vessel_id' => $model->vessel_id,
            'terminal_time' => $date,
        ], (array) $model->makeHidden(['id', 'vessel_id', 'created_at', 'updated_at'])->toArray());
    }
}
