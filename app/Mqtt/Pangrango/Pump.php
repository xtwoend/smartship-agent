<?php

namespace App\Mqtt\Pangrango;

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
       
        return [
            'cargo' => [
                'pump_latest_update_at' =>  Carbon::now()->format('Y-m-d H:i:s'),
                'cargo_pump1_run' => $data['cargo_pump1_run'],
                'cargo_pump2_run' => $data['cargo_pump2_run'],
                'cargo_pump3_run' => $data['cargo_pump3_run'],
                'wballast_pump1_run' => $data['wballast_pump1_run'],
                'wballast_pump2_run' => $data['wballast_pump2_run'],
                'tank_cleaning_pump_run' => $data['tank_cleaning_pump_run'],
                'stripping_pump_run' => $data['stripping_pump_run']
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