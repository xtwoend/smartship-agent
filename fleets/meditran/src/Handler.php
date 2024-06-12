<?php

namespace Smartship\Meditran;

use function Hyperf\Config\config;

class Handler
{
    public function fleet() {
        $model = config('meditran.fleet_model');
        if(! class_exists($model)) {
            return;
        }
        return new $model;
    }
}