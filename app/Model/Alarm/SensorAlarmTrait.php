<?php

namespace App\Model\Alarm;

use Carbon\Carbon;
use App\Model\Sensor;
use App\Model\Alarm\Alarm;
use Hyperf\Database\Model\Events\Created;
use Hyperf\Database\Model\Relations\HasMany;


trait SensorAlarmTrait
{
    public function sensor() : HasMany {
        return $this->HasMany(Sensor::class, 'fleet_id', 'fleet_id');
    }

    public function created(Created $event)
    {
        $model = $event->getModel();
        $fleetId = $model->fleet_id;

        // todo: 10/10/2023 15:12 add condition sensor by min & max value
        $this->conditionSensor();
        
        foreach($this->sensor()->whereIn('group', $this->sensor_group)->where('is_ams', 1)->get() as $sensor) {
            $val = $model->{$sensor->sensor_name};
            $val = round($val, 2, PHP_ROUND_HALF_UP);
            
            if($model->{$sensor->sensor_name} < $sensor->normal) {
                
                $lo = Alarm::table($fleetId)
                    ->firstOrCreate([
                        'fleet_id' => $fleetId,
                        'property' => 'sensor',
                        'property_key' => $sensor->sensor_name,
                        'status' => 1
                    ], [
                        'message' => \strtoupper($sensor->name) . " VALUE {$val} ".  'IS VERY LOW',
                    ]);
                if(is_null($lo->started_at)) {
                    $lo->started_at = Carbon::now()->format('Y-m-d H:i:s');
                }
                $lo->finished_at = Carbon::now()->format('Y-m-d H:i:s');
                $lo->save();
            }
            if($model->{$sensor->sensor_name} > $sensor->danger) {
                $hi = Alarm::table($fleetId)
                    ->firstOrCreate([
                        'fleet_id' => $fleetId,
                        'property' => 'sensor',
                        'property_key' => $sensor->sensor_name,
                        'status' => 1
                    ], [
                        'message' => \strtoupper($sensor->name) . " VALUE {$val} ".  'IS VERY HIGH',
                    ]);
                if(is_null($hi->started_at)) {
                    $hi->started_at = Carbon::now()->format('Y-m-d H:i:s');
                }
                $hi->finished_at = Carbon::now()->format('Y-m-d H:i:s');
                $hi->save();
            }
        }
        
    }


    function conditionSensor() : void {
        foreach($this->sensor()->get() as $sensor) {
            $val = $model->{$sensor->sensor_name};
            
            if($val) {
                if($sensor->min < $val || $sensor->max > $val) {
                    $sensor->update([
                        'condition' => 'ABNORMAL'
                    ]);
                }else{
                    $sensor->update([
                        'condition' => 'NORMAL'
                    ]);
                }
            }
        }
    }
}