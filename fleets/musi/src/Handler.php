<?php

namespace Smartship\Musi;

use function Hyperf\Config\config;

class Handler
{
    public function fleet() {
        $model = config('musi.fleet_model');
        if(! class_exists($model)) {
            return;
        }
        return new $model;
    }
}