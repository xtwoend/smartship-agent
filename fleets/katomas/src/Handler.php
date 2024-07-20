<?php

namespace Smartship\Katomas;

use function Hyperf\Config\config;

class Handler
{
    public function fleet() {
        $model = config('katomas.fleet_model');
        if(! class_exists($model)) {
            return;
        }
        return new $model;
    }
}