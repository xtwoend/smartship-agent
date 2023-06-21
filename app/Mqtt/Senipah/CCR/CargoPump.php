<?php

namespace App\Mqtt\Senipah\CCR;

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
            'cargo_pump' => [
                'terminal_time' => (string) $data['_terminalTime'],
                'pump_non_drvend_c1' => (float) $data['pump_non_drvend_c1'],
                'pump_casing_c1' => (float) $data['pump_casing_c1'],
                'pump_drvend_c1' => (float) $data['pump_drvend_c1'],
                'transmission_sealing_c1' => (float) $data['transmission_sealing_c1'],
                'pump_non_drvend_c2' => (float) $data['pump_non_drvend_c2'],
                'pump_casing_c2' => (float) $data['pump_casing_c2'],
                'pump_drvend_c2' => (float) $data['pump_drvend_c2'],
                'transmission_sealing_c2' => (float) $data['transmission_sealing_c2'],
                'pump_non_drvend_c3' => (float) $data['pump_non_drvend_c3'],
                'pump_casing_c3' => (float) $data['pump_casing_c3'],
                'pump_drvend_c3' => (float) $data['pump_drvend_c3'],
                'transmission_sealing_c3' => (float) $data['transmission_sealing_c3'],
                'pump_non_drvend_bp1' => (float) $data['pump_non_drvend_bp1'],
                'pump_casing_bp1' => (float) $data['pump_casing_bp1'],
                'pump_drvend_bp1' => (float) $data['pump_drvend_bp1'],
                'transmission_sealing_bp1' => (float) $data['transmission_sealing_bp1'],
                'pump_non_drvend_bp2' => (float) $data['pump_non_drvend_bp2'],
                'pump_casing_bp2' => (float) $data['pump_casing_bp2'],
                'pump_drvend_bp2' => (float) $data['pump_drvend_bp2'],
                'transmission_sealing_bp2' => (float) $data['transmission_sealing_bp2'],
                'pump_non_drvend_sp1' => (float) $data['pump_non_drvend_sp1'],
                'pump_casing_sp1' => (float) $data['pump_casing_sp1'],
                'pump_drvend_sp1' => (float) $data['pump_drvend_sp1'],
                'transmission_sealing_sp1' => (float) $data['ttransmission_sealing_sp1'],
                'pump_non_drvend_tcp' => (float) $data['pump_non_drvend_tcp'],
                'pump_casing_tcp' => (float) $data['pump_casing_tcp'],
                'pump_drvend_tcp' => (float) $data['pump_drvend_tcp'],
                'transmission_sealing_tcp' => (float) $data['transmission_sealing_tcp'],
                'vacuum_pump1' => (float) $data['vacuum_pump1'],
                'vacuum_pump2' => (float) $data['vacuum_pump2'],
                'dsch_press_c1' => (float) $data['dsch_press_c1'],
                'dsch_press_c2' => (float) $data['dsch_press_c2'],
                'dsch_press_c3' => (float) $data['dsch_press_c3'],
                'vibration_c1' => (float) $data['vibration_c1'],
                'vibration_c2' => (float) $data['vibration_c2'],
                'vibration_c3' => (float) $data['vibration_c3'],
                'tcm_sw_temp' => (float) $data['tcm_sw_temp'],
                'tcm_sw_press' => (float) $data['tcm_sw_press'],
            ]
        ];
    }
}