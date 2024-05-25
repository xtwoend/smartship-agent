<?php

namespace Smartship\Pg2;

use function Hyperf\Config\config;

class Handler
{
    public function fleet() {
        $model = config('Pg2.fleet_model');
        if(! class_exists($model)) {
            return;
        }
        return new $model;
    }
}