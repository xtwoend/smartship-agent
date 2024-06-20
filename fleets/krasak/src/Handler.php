<?php

namespace Smartship\Krasak;

use function Hyperf\Config\config;

class Handler
{
    public function fleet() {
        $model = config('krasak.fleet_model');
        if(! class_exists($model)) {
            return;
        }
        return new $model;
    }
}