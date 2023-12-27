<?php

namespace App\Model\Traits;

use Carbon\Carbon;
use App\Model\Logger;

trait LoggerTrait
{
    public function logger($group, $data)
    {
        $date = $data->updated_at; // get last update data
        $model = Logger::table($this->id, $date);
        $last = $model->where('group', $group)->orderBy('terminal_time', 'desc')->first();
        $now = Carbon::parse($date);
        
        // delete data log
        Logger::table($this->id, $date)->where('terminal_time', '<', Carbon::now()->subHour()->format('Y-m-d H:i:s'))->delete();
        
        $data = $data->makeHidden(['id', 'fleet_id', 'created_at', 'updated_at'])->toArray();
    
        // save interval 5 detik
        if($last && $now->diffInSeconds($last->terminal_time) < config('mqtt.interval_save', 5) ) {   
            return;
        }

        // submit to event
        websocket_emit("fleet-{$this->id}", "{$group}_{$this->id}", $data);

        return $model->updateOrCreate([
            'group' => $group,
            'fleet_id' => $this->id,
            'terminal_time' => $date,
        ], [
            'data' => (array) $data
        ]);
    }
}