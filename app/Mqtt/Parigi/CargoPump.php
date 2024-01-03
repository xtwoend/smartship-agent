<?php

namespace App\Mqtt\Parigi;

use Carbon\Carbon;
use Hyperf\Utils\Str;
use Hyperf\Utils\Codec\Json;

class CargoPump
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
                'cargo_pump_timestamp' => Carbon::now()->format('Y-m-d H:i:s'),
                'cargo_pump1_run' => (boolean) $data['cargo_pump1_run'],
                'cargo_pump2_run' => (boolean) $data['cargo_pump2_run'],
                'cargo_pump3_run' => (boolean) $data['cargo_pump3_run'],
                'ballast_pump1_run' => (boolean) $data['ballast_pump1_run'],
                'ballast_pump2_run' => (boolean) $data['ballast_pump2_run'],
                'stripping_pump_run' => (boolean) $data['stripping_pump_run'],
                'vacuum_pump1_run' => (boolean) $data['vacuum_pump1_run'],
                'vacuum_pump2_run' => (boolean) $data['vacuum_pump2_run'],
                'tank_cleaning_pump_run' => (boolean) $data['tank_cleaning_pump_run'],
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