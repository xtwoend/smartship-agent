<?php

namespace App\Event;


class AlarmEvent
{
    public $model;
    public $group;
    
    public function __construct($model, array $group)
    {
        $this->model = $model;
        $this->group = $group;
    }
}