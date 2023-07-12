<?php

namespace App\Model\Cargo;

trait CargoTrait
{
    public function setCargo($model, array $data)
    {
        if(isset($data['cargo'])) {
            $model = (new $model)->table($this->id);
      
            $log = $model->updateOrCreate([
                'fleet_id' => $this->id
            ], $data['cargo']);

            $this->logger('cargo', $log);

            return $log;
        }
    }
}