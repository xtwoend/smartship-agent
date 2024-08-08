<?php

namespace Smartship\Primaxp;

use function Hyperf\Config\config;

class Handler
{
    public function fleet() {
        $model = config('primaxp.fleet_model');
        if(! class_exists($model)) {
            return;
        }
        return new $model;
    }
}