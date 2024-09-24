<?php

namespace Smartship\SangaSanga;

use function Hyperf\Config\config;

class Handler
{
    public function fleet() {
        $model = config('sanga.fleet_model');
        if(! class_exists($model)) {
            return;
        }
        return new $model;
    }
}