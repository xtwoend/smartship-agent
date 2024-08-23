<?php

namespace Smartship\Gasparta2\Parser;

use Carbon\Carbon;
use Hyperf\Codec\Json;

class Cargo
{
    protected string $message;

    public function __construct(string $message)
    {
        $this->message = $message;
    }

    public function extract()
    {
        $data = Json::decode($this->message);
       
        return [
            'cargo' => [
                'cargo_timestamp' => (string) Carbon::now()->format('Y-m-d H:i:s'),
                'pump_casing_temp_cop1' => (float) $data['pump_casing_temp_cop1'],
                'pump_de_bearing_temp_cop1' => (float) $data['pump_de_bearing_temp_cop1'],
                'trans_bearing_temp_cop1' => (float) $data['trans_bearing_temp_cop1'],
                'trans_sealing_temp_cop1' => (float) $data['trans_sealing_temp_cop1'],
                'pump_casing_temp_cop2' => (float) $data['pump_casing_temp_cop2'],
                'pump_de_bearing_temp_cop2' => (float) $data['pump_de_bearing_temp_cop2'],
                'trans_bearing_temp_cop2' => (float) $data['trans_bearing_temp_cop2'],
                'trans_sealing_temp_cop2' => (float) $data['trans_sealing_temp_cop2'],
                'pump_casing_temp_cop3' => (float) $data['pump_casing_temp_cop3'],
                'pump_de_bearing_temp_cop3' => (float) $data['pump_de_bearing_temp_cop3'],
                'trans_bearing_temp_cop3' => (float) $data['trans_bearing_temp_cop3'],
                'trans_sealing_temp_cop3' => (float) $data['trans_sealing_temp_cop3'],
                'pump_nde_bearing_temp_sp1' => (float) $data['pump_nde_bearing_temp_sp1'],
                'pump_casing_temp_sp1' => (float) $data['pump_casing_temp_sp1'],
                'pump_de_bearing_temp_sp1' => (float) $data['pump_de_bearing_temp_sp1'],
                'trans_bearing_sp1' => (float) $data['trans_bearing_sp1'],
                'trans_sealing_sp1' => (float) $data['trans_sealing_sp1'],
                'pump_nde_bearing_temp_sp2' => (float) $data['pump_nde_bearing_temp_sp2'],
                'pump_casing_temp_sp2' => (float) $data['pump_casing_temp_sp2'],
                'pump_de_bearing_temp_sp2' => (float) $data['pump_de_bearing_temp_sp2'],
                'trans_bearing_sp2' => (float) $data['trans_bearing_sp2'],
                'trans_sealing_sp2' => (float) $data['trans_sealing_sp2'],
                'pump_casing_bp1' => (float) $data['pump_casing_bp1'],
                'pump_de_bearing_bp1' => (float) $data['pump_de_bearing_bp1'],
                'trans_bearing_bp1' => (float) $data['trans_bearing_bp1'],
                'trans_sealing_bp1' => (float) $data['trans_sealing_bp1'],
                'pump_casing_bp2' => (float) $data['pump_casing_bp2'],
                'pump_de_bearing_bp2' => (float) $data['pump_de_bearing_bp2'],
                'trans_bearing_bp2' => (float) $data['trans_bearing_bp2'],
                'trans_sealing_bp2' => (float) $data['trans_sealing_bp2'],
                'pump_nde_bearing_tcp' => (float) $data['pump_nde_bearing_tcp'],
                'pump_casing_tcp' => (float) $data['pump_casing_tcp'],
                'pump_de_bearing_tcp' => (float) $data['pump_de_bearing_tcp'],
                'trans_bearing_tcp' => (float) $data['trans_bearing_tcp'],
                'trans_sealing_tcp' => (float) $data['trans_sealing_tcp'],
                'bearing_temp_vp1' => (float) $data['bearing_temp_vp1'],
                'bearing_temp_vp2' => (float) $data['bearing_temp_vp2'],
                'throttle_valve_cop1' => (float) $data['throttle_valve_cop1'],
                'throttle_valve_cop2' => (float) $data['throttle_valve_cop2'],
                'throttle_valve_cop3' => (float) $data['throttle_valve_cop3'],
                'discharge_pressure_cop1' => (float) $data['discharge_pressure_cop1'],
                'discharge_pressure_cop2' => (float) $data['discharge_pressure_cop2'],
                'discharge_pressure_cop3' => (float) $data['discharge_pressure_cop3'],
                'vibration_cop1' => (float) $data['vibration_cop1'],
                'vibration_cop2' => (float) $data['vibration_cop2'],
                'vibration_cop3' => (float) $data['vibration_cop3'],
            ],
        ];
    }
}