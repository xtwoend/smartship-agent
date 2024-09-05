<?php

namespace Smartship\Klasogun;

use function Hyperf\Config\config;

class Handler
{
    public function fleet() {
        $model = config('klasogun.fleet_model');
        if(! class_exists($model)) {
            return;
        }
        return new $model;
    }
}