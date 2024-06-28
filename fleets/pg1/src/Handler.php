<?php

namespace Smartship\Pg1;

use function Hyperf\Config\config;

class Handler
{
    public function fleet() {
        $model = config('pg1.fleet_model');
        if(! class_exists($model)) {
            return;
        }
        return new $model;
    }
}