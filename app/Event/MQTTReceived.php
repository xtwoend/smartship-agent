<?php

namespace App\Event;


class MQTTReceived
{
    public $message;
    public $topic;
    public $row;

    public function __construct($message, $topic, $row) {
        $this->message = $message;
        $this->topic = $topic;
        $this->row = $row;
    }
}