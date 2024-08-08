<?php

namespace Smartship\Pagaden;

use function Hyperf\Config\config;

class Handler
{
    public function fleet() {
        $model = config('pagaden.fleet_model');
        if(! class_exists($model)) {
            return;
        }
        return new $model;
    }
}