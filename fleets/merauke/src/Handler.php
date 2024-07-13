<?php

namespace Smartship\Merauke;

use function Hyperf\Config\config;

class Handler
{
    public function fleet() {
        $model = config('merauke.fleet_model');
        if(! class_exists($model)) {
            return;
        }
        return new $model;
    }
}