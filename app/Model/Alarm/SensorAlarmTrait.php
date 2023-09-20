<?php

namespace App\Model\Alarm;

use Carbon\Carbon;
use App\Model\Sensor;
use App\Model\Alarm\Alarm;
use Hyperf\Database\Model\Events\Created;
use Hyperf\Database\Model\Relations\HasMany;


trait SensorAlarmTrait
{
    public array $sensor_group = [];

    public function sensor() : HasMany {
        return $this->belongsTo(Sensor::class, 'fleet_id', 'fleet_id');
    }

    public function created(Created $event)
    {
        $model = $event->getModel();
        $fleetId = $model->fleet_id;

        foreach($this->sensor()->whereIn('group', $this->sensor_group)->get() as $sensor) {
            if($model->{$sensor->sensor_name} < $sensor->normal) {
                
                $lo = Alarm::table($fleetId)
                    ->firstOrCreate([
                        'fleet_id' => $fleetId,
                        'property' => 'sensor',
                        'property_key' => $sensor->sensor_name,
                        'message' => \strtoupper($sensor->name) . ' VERY LOW',
                        'status' => 1
                    ]);
                if(is_null($lo->started_at)) {
                    $lo->started_at = Carbon::now()->format('Y-m-d H:i:s');
                }
                $lo->finished_at = Carbon::now()->format('Y-m-d H:i:s');
                $lo->save();
            }
            if($model->{$sensor->session_name} > $sensor->danger) {
                $hi = Alarm::table($fleetId)
                    ->firstOrCreate([
                        'fleet_id' => $fleetId,
                        'property' => 'sensor',
                        'property_key' => $sensor->sensor_name,
                        'message' => \strtoupper($sensor->name) . ' VERY HIGH',
                        'status' => 1
                    ]);
                if(is_null($hi->started_at)) {
                    $hi->started_at = Carbon::now()->format('Y-m-d H:i:s');
                }
                $hi->finished_at = Carbon::now()->format('Y-m-d H:i:s');
                $hi->save();
            }
        }
    }
}