<?php

namespace Smartship\Sengeti;

use function Hyperf\Config\config;

class Handler
{
    public function fleet() {
        $model = config('sengeti.fleet_model');
        if(! class_exists($model)) {
            return;
        }
        return new $model;
    }
}