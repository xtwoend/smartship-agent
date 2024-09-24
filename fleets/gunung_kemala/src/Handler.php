<?php

namespace Smartship\GunungKemala;

use function Hyperf\Config\config;

class Handler
{
    public function fleet() {
        $model = config('gunung_kemala.fleet_model');
        if(! class_exists($model)) {
            return;
        }
        return new $model;
    }
}