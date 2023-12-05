<?php

namespace App\Mqtt\Kasim;

use Carbon\Carbon;
use Hyperf\Utils\Str;
use Hyperf\Utils\Codec\Json;

class Pump
{
    protected string $message;

    public function __construct(string $message) {
       
        $this->message = $message;
    }
    
    public function extract()
    {
        $data = Json::decode($this->message);
        $sensors = [];
        foreach($data['values'] as $val) {
            $id = str_replace('plc.cop.q02h.', '', $val['id']);
            $sensors[$id] = (float) $val['v'];
        }
        
        return [
            'cargo' => [
                'pump_timestamp' => $data['timestamp'] ?? Carbon::now()->format('Y-m-d H:i:s'),

            ]
        ];
    }

    function arrayToSnake() : array {
        $snake = [];
        foreach($this->mappArray as $in => $val) {
            if(is_null($val)) continue;
            $key = Str::snake(strtolower($val));
            $snake[$key] = $val;
        } 
        return $snake;
    }

    protected $mappArray = [
        
    ];
}