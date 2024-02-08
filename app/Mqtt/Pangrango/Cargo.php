<?php

namespace App\Mqtt\Pangrango;

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
                'bottom_gear_cp1' => $data['bottom_gear_cp1'],
                'pump_casing_cp1' => $data['pump_casing_cp1'],
                'upper_gear_cp1' => $data['upper_gear_cp1'],
                'transmission_seal_cp1' => $data['transmission_seal_cp1'],
                'trans_v_bearin_cp1' => $data['trans_v_bearin_cp1'],
                'throtle_position_cp1' => $data['throtle_position_cp1'],
                'bottom_gear_cp2' => $data['bottom_gear_cp2'],
                'pump_casing_cp2' => $data['pump_casing_cp2'],
                'upper_gear_cp2' => $data['upper_gear_cp2'],
                'transmission_seal_cp2' => $data['transmission_seal_cp2'],
                'trans_v_bearing_cp2' => $data['trans_v_bearing_cp2'],
                'throtle_position_cp2' => $data['throtle_position_cp2'],
                'bottom_gear_cp3' => $data['bottom_gear_cp3'],
                'pump_casing_cp3' => $data['pump_casing_cp3'],
                'upper_gear_cp3' => $data['upper_gear_cp3'],
                'transmission_seal_cp3' => $data['transmission_seal_cp3'],
                'trans_v_bearing_cp3' => $data['trans_v_bearing_cp3'],
                'throtle_position_cp3' => $data['throtle_position_cp3'],
                'pump_casing_bp1' => $data['pump_casing_bp1'],
                'upper_gear_bp1' => $data['upper_gear_bp1'],
                'transmission_seal_bp1' => $data['transmission_seal_bp1'],
                'transmission_v_bearing_bp1' => $data['transmission_v_bearing_bp1'],
                'pump_casing_bp2' => $data['pump_casing_bp2'],
                'upper_gear_bp2' => $data['upper_gear_bp2'],
                'transmission_seal_bp2' => $data['transmission_seal_bp2'],
                'transmission_v_bearing_bp2' => $data['transmission_v_bearing_bp2'],
                'bearing_temp_vp1' => $data['bearing_temp_vp1'],
                'bearing_temp_vp2' => $data['bearing_temp_vp2'],
                'bottom_gear_sp' => $data['bottom_gear_sp'],
                'pump_casing_sp' => $data['pump_casing_sp'],
                'upper_gear_sp' => $data['upper_gear_sp'],
                'transmission_seal_sp' => $data['transmission_seal_sp'],
                'trans_v_bearing_sp' => $data['trans_v_bearing_sp'],
                'not_used' => $data['not_used'],
                'bottom_gear_tcp' => $data['bottom_gear_tcp'],
                'pump_casing_tcp' => $data['pump_casing_tcp'],
                'upper_gear_tcp' => $data['upper_gear_tcp'],
                'transmission_seal_tcp' => $data['transmission_seal_tcp'],
                'trans_v_bearing_tcp' => $data['trans_v_bearing_tcp'],
                'not_used_1' => $data['not_used_1'],
                'suction_cp1' => $data['suction_cp1'],
                'suction_cp2' => $data['suction_cp2'],
                'suction_cp3' => $data['suction_cp3'],
                'suction_sp' => $data['suction_sp'],
                'suction_tcp' => $data['suction_tcp'],
                'airgas_separatorcp1' => $data['airgas_separatorcp1'],
                'airgas_separator_cp2' => $data['airgas_separator_cp2'],
                'airgas_separator_cp3' => $data['airgas_separator_cp3'],
                'vibration_cp1' => $data['vibration_cp1'],
                'vibration_cp2' => $data['vibration_cp2'],
                'vibration_cp3' => $data['vibration_cp3'],
                'vacuum_manifold_pressure' => $data['vacuum_manifold_pressure'],
                'suction_bp1' => $data['suction_bp1'],
                'discharge_press_bp1' => $data['discharge_press_bp1'],
                'suction_bp2' => $data['suction_bp2'],
                'discharge_press_bp2' => $data['discharge_press_bp2'],
                'discharge_press_cp1' => $data['discharge_press_cp1'],
                'discharge_press_cp2' => $data['discharge_press_cp2'],
                'discharge_press_cp3' => $data['discharge_press_cp3'],
                'discharge_press_sp' => $data['discharge_press_sp'],
                'discharge_press_tcp' => $data['discharge_press_tcp'],
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