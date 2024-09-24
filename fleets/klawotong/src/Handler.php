<?php

namespace Smartship\Klawotong;

use function Hyperf\Config\config;

class Handler
{
    public function fleet() {
        $model = config('klawotong.fleet_model');
        if(! class_exists($model)) {
            return;
        }
        return new $model;
    }
}