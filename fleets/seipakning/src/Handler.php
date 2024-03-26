<?php

namespace Smartship\Seipakning;

use Hyperf\DbConnection\Model\Model;

class Handler
{
    public function fleet() {
        $model = config('seipakning.fleet_model');
        if(! class_exists($model)) {
            return;
        }
        return new $model;
    }
}