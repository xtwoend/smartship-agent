<?php

namespace Smartship\Aquila;

use function Hyperf\Config\config;

class Handler
{
    public function fleet() {
        $model = config('aquila.fleet_model');
        if(! class_exists($model)) {
            return;
        }
        return new $model;
    }
}