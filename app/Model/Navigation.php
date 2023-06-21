<?php

declare(strict_types=1);

namespace App\Model;

use Carbon\Carbon;
use App\Model\NavigationLog;
use Hyperf\DbConnection\Model\Model;
use Hyperf\Database\Model\Events\Updated;

/**
 */
class Navigation extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'navigations';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [
        'fleet_id',
        'terminal_time',
        'wind_speed',
        'wind_direction',
        'lat',
        'lat_dir',
        'lng',
        'lng_dir',
        'datum_refrence',
        'sog',
        'cog',
        'total_distance',
        'distance',
        'heading',
        'rot',
        'depth'
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
        $last = NavigationLog::table($model->fleet_id, $date)->orderBy('terminal_time', 'desc')->first();
        $now = Carbon::parse($date);

        // save interval 60 detik
        if($last && $now->diffInSeconds($last->terminal_time) < config('mqtt.interval_save', 60) ) {   
            return;
        }
        
        dispatch(new NavigationUpdateEvent($model));

        return NavigationLog::table($model->fleet_id, $date)->updateOrCreate([
            'fleet_id' => $model->fleet_id,
            'terminal_time' => $date,
        ], (array) $model->makeHidden(['id', 'fleet_id', 'created_at', 'updated_at'])->toArray());
    }
}
