<?php

namespace App\Model\CargoPump;

trait CargoPumpTrait
{
    public function setCargoPump($model, array $data)
    {
        if(isset($data['cargo_pump'])) {
            $model = (new $model)->table($this->id);
      
            $log = $model->updateOrCreate([
                'fleet_id' => $this->id
            ], $data['cargo_pump']);

            $this->logger('ccr', $log);

            return $log;
        }
    }
}