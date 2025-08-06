<?php

class Vibration
{
    protected $message;

    protected $data;

    public function __construct(string $message)
    {
        $this->message = $message;
    }

     public function extract()
    {
        $data = Json::decode($this->message);

        
    }
}