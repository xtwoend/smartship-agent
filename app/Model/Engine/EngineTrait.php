<?php

namespace App\Model\Engine;

trait EngineTrait
{
    public function setEngine($model, array $data)
    {   
        if(isset($data['engine'])) {
            
            $model = (new $model)->table($this->id);
            
            $log = $model->updateOrCreate([
                'fleet_id' => $this->id
            ], $data['engine']);
            
            $this->logger('engine', $log);

            return $log;
        }
    }
}