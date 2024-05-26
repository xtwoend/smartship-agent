<?php

namespace Smartship\Bima;

use function Hyperf\Config\config;

class Handler
{
    public function fleet() {
        $model = config('bima.fleet_model');
        if(! class_exists($model)) {
            return;
        }
        return new $model;
    }
}