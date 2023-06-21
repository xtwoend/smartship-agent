<?php

namespace App\Event;

class NavigationUpdateEvent
{
    public $data;

    public function __construct($data) {
        $this->data = $data;
    }
}