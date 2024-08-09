<?php

namespace Smartship\Ketaling;

use function Hyperf\Config\config;

class Handler
{
    public function fleet() {
        $model = config('ketaling.fleet_model');
        if(! class_exists($model)) {
            return;
        }
        return new $model;
    }
}