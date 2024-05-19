<?php

namespace Smartship\Taurus;

use function Hyperf\Config\config;

class Handler
{
    public function fleet() {
        $model = config('taurus.fleet_model');
        if(! class_exists($model)) {
            return;
        }
        return new $model;
    }
}