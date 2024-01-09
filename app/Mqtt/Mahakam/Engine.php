<?php

namespace App\Mqtt\Mahakam;

use Carbon\Carbon;
use Hyperf\Utils\Str;
use Hyperf\Utils\Codec\Json;

class Engine
{
    protected string $message;

    public function __construct(string $message) {
       
        $this->message = $message;
    }
    
    public function extract()
    {
        $data = Json::decode($this->message);
       
        return [
            'engine' => [
                'terminal_time' => Carbon::now()->format('Y-m-d H:i:s'),
                'me_fo_inlet_press' => $data['me_fo_inlet_press'],
                'me_tc_lo_inlet_press' => $data['me_tc_lo_inlet_press'],
                'me_lo_pco_inlet_press' => $data['me_lo_pco_inlet_press'],
                'jcw_inlet_press' => $data['jcw_inlet_press'],
                'cw_ac_inlet_press' => $data['cw_ac_inlet_press'],
                'starting_air_inlet_press' => $data['starting_air_inlet_press'],
                'scavenging_air_inlet_press' => $data['scavenging_air_inlet_press'],
                'speed_setting_air_inlet_press' => $data['speed_setting_air_inlet_press'],
                'control_air_inlet_press' => $data['control_air_inlet_press'],
            ]
        ];

    }

    function arrayToSnake($arrayName) : array {
        $snake = [];
        foreach($this->{$arrayName} as $in => $val) {
            if(is_null($val)) continue;
            $key = Str::snake(strtolower($val));
            $snake[$key] = $in;
        } 
        return $snake;
    }

    protected $engine = [
    ];
}