<?php

namespace Smartship\Arafura;

use function Hyperf\Config\config;

class Handler
{
    public function fleet() {
        $model = config('arafura.fleet_model');
        if(! class_exists($model)) {
            return;
        }
        return new $model;
    }
}