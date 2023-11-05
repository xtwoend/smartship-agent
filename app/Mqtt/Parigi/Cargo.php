<?php

namespace App\Mqtt\Parigi;

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
                'cargo_timestamp' => (string) $data['ts'] ?? Carbon::now()->format('Y-m-d H:i:s'),
                'bottom_gear_cp1' => (float) $data['bottom_gear_cp1'],
                'pump_casing_c1' => (float) $data['pump_casing_c1'],
                'upper_gear_cp1' => (float) $data['upper_gear_cp1'],
                'transmission_seal_c1' => (float) $data['transmission_seal_c1'],
                'trans_v_bearing_c1' => (float) $data['trans_v_bearing_c1'],
                'throtle_position_cp1' => (float) $data['throtle_position_cp1'],
                'bottom_gear_cp2' => (float) $data['bottom_gear_cp2'],
                'pump_casing_cp2' => (float) $data['pump_casing_cp2'],
                'upper_gear_cp2' => (float) $data['upper_gear_cp2'],
                'transmission_seal_cp2' => (float) $data['transmission_seal_cp2'],
                'trans_v_bearing_cp2' => (float) $data['trans_v_bearing_cp2'],
                'throtle_position_cp2' => (float) $data['throtle_position_cp2'],
                'bottom_gear_cp3' => (float) $data['bottom_gear_cp3'],
                'pump_casing_cp3' => (float) $data['pump_casing_cp3'],
                'upper_gear_cp3' => (float) $data['upper_gear_cp3'],
                'tansmission_seal_cp3' => (float) $data['tansmission_seal_cp3'],
                'throtle_position_cp3' => (float) $data['throtle_position_cp3'],
                'pump_casing_bp1' => (float) $data['pump_casing_bp1'],
                'upper_gear_bp1' => (float) $data['upper_gear_bp1'],
                'transmission_sealing_bp1' => (float) $data['transmission_sealing_bp1'],
                'transmission_v_bearing_bp1' => (float) $data['transmission_v_bearing_bp1'],
                'pump_casing_bp2' => (float) $data['pump_casing_bp2'],
                'upper_gear_bp2' => (float) $data['upper_gear_bp2'],
                'transmission_seal_bp2' => (float) $data['transmission_seal_bp2'],
                'transmission_v_bearing_bp2' => (float) $data['transmission_v_bearing_bp2'],
                'bearing_temp_vp1' => (float) $data['bearing_temp_vp1'],
                'bearing_temp_vp2' => (float) $data['bearing_temp_vp2'],
                'bottom_gear_sp' => (float) $data['bottom_gear_sp'],
                'pump_casing_sp' => (float) $data['pump_casing_sp'],
                'upper_gear_sp' => (float) $data['upper_gear_sp'],
                'transmission_seal_sp' => (float) $data['transmission_seal_sp'],
                'transmission_v_bearing_sp' => (float) $data['transmission_v_bearing_sp'],
                'bottom_gear_tcp' => (float) $data['bottom_gear_tcp'],
                'pump_casing_tcp' => (float) $data['pump_casing_tcp'],
                'upper_gear_tcp' => (float) $data['upper_gear_tcp'],
                'transmission_seal_tcp' => (float) $data['transmission_seal_tcp'],
                'transmission_v_bearing_tcp' => (float) $data['transmission_v_bearing_tcp'],
                'suction_cp1' => (float) $data['suction_cp1'],
                'suction_cp2' => (float) $data['suction_cp2'],
                'suction_cp3' => (float) $data['suction_cp3'],
                'suction_sp' => (float) $data['suction_sp'],
                'suction_tcp' => (float) $data['suction_tcp'],
                'suction_bp1' => (float) $data['suction_bp1'],
                'suction_bp2' => (float) $data['suction_bp2'],
                'vibration_cp1' => (float) $data['vibration_cp1'],
                'vibration_cp2' => (float) $data['vibration_cp2'],
                'vibration_cp3' => (float) $data['vibration_cp3'],
                'discharge_cp1' => (float) $data['discharge_cp1'],
                'discharge_cp2' => (float) $data['discharge_cp2'],
                'discharge_cp3' => (float) $data['discharge_cp3'],
                'dicharge_press_sp' => (float) $data['dicharge_press_sp'],
                'discharge_press_tcp' => (float) $data['discharge_press_tcp'],
                'discharge_press_bp1' => (float) $data['discharge_press_bp1'],
                'discharge_press_bp2' => (float) $data['discharge_press_bp2'],
                'vacuum_manifold_pressure' => (float) $data['vacuum_manifold_pressure'],
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