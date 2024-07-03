<?php

namespace Smartship\Mauhau;

use function Hyperf\Config\config;

class Handler
{
    public function fleet() {
        $model = config('mauhau.fleet_model');
        if(! class_exists($model)) {
            return;
        }
        return new $model;
    }
}