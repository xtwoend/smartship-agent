<?php

namespace App\Mqtt\Yudhistira;

use Carbon\Carbon;
use Hyperf\Utils\Str;
use Hyperf\Utils\Codec\Json;

class Cargo
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
                'cargo_timestamp' => Carbon::now()->format('Y-m-d H:i:s'),
                'pump_casing_temp_cop1' => $data['pump_casing_temp_cop1'],
                'pump_de_bearing_temp_cop1' => $data['pump_de_bearing_temp_cop1'],
                'trans_bearing_temp_cop1' => $data['trans_bearing_temp_cop1'],
                'trans_sealing_temp_cop1' => $data['trans_sealing_temp_cop1'],
                'pump_casing_temp_cop2' => $data['pump_casing_temp_cop2'],
                'pump_de_bearing_temp_cop2' => $data['pump_de_bearing_temp_cop2'],
                'trans_bearing_temp_cop2' => $data['trans_bearing_temp_cop2'],
                'trans_sealing_temp_cop2' => $data['trans_sealing_temp_cop2'],
                'pump_casing_temp_cop3' => $data['pump_casing_temp_cop3'],
                'pump_de_bearing_temp_cop3' => $data['pump_de_bearing_temp_cop3'],
                'trans_bearing_temp_cop3' => $data['trans_bearing_temp_cop3'],
                'trans_sealing_temp_cop3' => $data['trans_sealing_temp_cop3'],
                'pump_nde_bearing_temp_sp1' => $data['pump_nde_bearing_temp_sp1'],
                'pump_casing_temp_sp1' => $data['pump_casing_temp_sp1'],
                'pump_de_bearing_temp_sp1' => $data['pump_de_bearing_temp_sp1'],
                'trans_bearing_sp1' => $data['trans_bearing_sp1'],
                'trans_sealing_sp1' => $data['trans_sealing_sp1'],
                'pump_nde_bearing_temp_sp2' => $data['pump_nde_bearing_temp_sp2'],
                'pump_casing_temp_sp2' => $data['pump_casing_temp_sp2'],
                'pump_de_bearing_temp_sp2' => $data['pump_de_bearing_temp_sp2'],
                'trans_bearing_sp2' => $data['trans_bearing_sp2'],
                'trans_sealing_sp2' => $data['trans_sealing_sp2'],
                'pump_casing_bp1' => $data['pump_casing_bp1'],
                'pump_de_bearing_bp1' => $data['pump_de_bearing_bp1'],
                'trans_bearing_bp1' => $data['trans_bearing_bp1'],
                'trans_sealing_bp1' => $data['trans_sealing_bp1'],
                'pump_casing_bp2' => $data['pump_casing_bp2'],
                'pump_de_bearing_bp2' => $data['pump_de_bearing_bp2'],
                'trans_bearing_bp2' => $data['trans_bearing_bp2'],
                'trans_sealing_bp2' => $data['trans_sealing_bp2'],
                'pump_nde_bearing_tcp' => $data['pump_nde_bearing_tcp'],
                'pump_casing_tcp' => $data['pump_casing_tcp'],
                'pump_de_bearing_tcp' => $data['pump_de_bearing_tcp'],
                'trans_bearing_tcp' => $data['trans_bearing_tcp'],
                'trans_sealing_tcp' => $data['trans_sealing_tcp'],
                'bearing_temp_vp1' => $data['bearing_temp_vp1'],
                'bearing_temp_vp2' => $data['bearing_temp_vp2'],
                'throttle_valve_cop1' => $data['throttle_valve_cop1'],
                'throttle_valve_cop2' => $data['throttle_valve_cop2'],
                'throttle_valve_cop3' => $data['throttle_valve_cop3'],
                'discharge_pressure_cop1' => $data['discharge_pressure_cop1'],
                'discharge_pressure_cop2' => $data['discharge_pressure_cop2'],
                'discharge_pressure_cop3' => $data['discharge_pressure_cop3'],
                'vibration_cop1' => $data['vibration_cop1'],
                'vibration_cop2' => $data['vibration_cop2'],
                'vibration_cop3' => $data['vibration_cop3'],
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