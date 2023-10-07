<?php

namespace App\Mqtt\Panjang;

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
                'cargo_timestamp' => $data['_terminalTime'] ?? Carbon::now()->format('Y-m-d H:i:s'),
                'pump_non_drvend_brg_temp_cp1' => $data['pump_non_drvend_brg_temp_cp1'],
                'pump_casing_temp_cp1' => $data['pump_casing_temp_cp1'],
                'pump_drvend_brg_temp_cp1' => $data['pump_drvend_brg_temp_cp1'],
                'transmission_seal_cp1' => $data['transmission_seal_cp1'],
                'trans_v_bearing_temp_cp1' => $data['trans_v_bearing_temp_cp1'],
                'throtle_v_position_cp1' => $data['throtle_v_position_cp1'],
                'pump_non_drvend_brg_temp_cp2' => $data['pump_non_drvend_brg_temp_cp2'],
                'pump_casing_temp_cp2' => $data['pump_casing_temp_cp2'],
                'pump_drvend_brg_temp_cp2' => $data['pump_drvend_brg_temp_cp2'],
                'transmission_seal_cp2' => $data['transmission_seal_cp2'],
                'trans_v_bearing_cp2' => $data['trans_v_bearing_cp2'],
                'throtle_v_position_cp2' => $data['throtle_v_position_cp2'],
                'pump_non_drvend_brg_temp_cp3' => $data['pump_non_drvend_brg_temp_cp3'],
                'pump_casing_temp_cp3' => $data['pump_casing_temp_cp3'],
                'pump_drvend_brg_temp_cp3' => $data['pump_drvend_brg_temp_cp3'],
                'transmission_seal_cp3' => $data['transmission_seal_cp3'],
                'trans_v_bearing_cp3' => $data['trans_v_bearing_cp3'],
                'throtle_v_position_cp3' => $data['throtle_v_position_cp3'],
                'pump_casing_temp_bp1' => $data['pump_casing_temp_bp1'],
                'pump_drv_end_brg_temp_bp1' => $data['pump_drv_end_brg_temp_bp1'],
                'transmission_seal_temp_bp1' => $data['transmission_seal_temp_bp1'],
                'transmission_v_bearing_temp_bp1' => $data['transmission_v_bearing_temp_bp1'],
                'pump_casing_temp_bp2' => $data['pump_casing_temp_bp2'],
                'pump_drv_end_brg_temp_bp2' => $data['pump_drv_end_brg_temp_bp2'],
                'transmission_seal_temp_bp2' => $data['transmission_seal_temp_bp2'],
                'transmission_v_bearing_temp_bp2' => $data['transmission_v_bearing_temp_bp2'],
                'bearing_temp_vp1' => $data['bearing_temp_vp1'],
                'bearing_temp_vp2' => $data['bearing_temp_vp2'],
                'non_drvend_brg_temp_csp' => $data['non_drvend_brg_temp_csp'],
                'casing_temp_csp' => $data['casing_temp_csp'],
                'transmission_brg_temp_csp' => $data['transmission_brg_temp_csp'],
                'transmission_seal_temp_csp' => $data['transmission_seal_temp_csp'],
                'trans_drv_end_brg_temp_csp' => $data['trans_drv_end_brg_temp_csp'],
                'not_used' => $data['not_used'],
                'non_drvend_brg_tcp' => $data['non_drvend_brg_tcp'],
                'pump_casing_temp_tcp' => $data['pump_casing_temp_tcp'],
                'drv_end_brg_temp_tcp' => $data['drv_end_brg_temp_tcp'],
                'transmission_seal_temp_tcp' => $data['transmission_seal_temp_tcp'],
                'trans_bearing_temp_tcp' => $data['trans_bearing_temp_tcp'],
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