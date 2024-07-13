<?php

namespace Smartship\Matindok;

use function Hyperf\Config\config;

class Handler
{
    public function fleet() {
        $model = config('matindok.fleet_model');
        if(! class_exists($model)) {
            return;
        }
        return new $model;
    }
}