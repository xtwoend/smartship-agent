<?php

namespace Smartship\Plaju;

use function Hyperf\Config\config;

class Handler
{
    public function fleet() {
        $model = config('plaju.fleet_model');
        if(! class_exists($model)) {
            return;
        }
        return new $model;
    }
}