<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace App\Mqtt\Sambu\CCR;

use Carbon\Carbon;

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
                'terminal_time' => Carbon::now()->format('Y-m-d H:i:s'),
                'pump_non_drvend_c1' => $data['pump_non_drvend_c1'],
                'pump_casing_c1' => $data['pump_casing_c1'],
                'pump_drvend_c1' => $data['pump_drvend_c1'],
                'transmission_sealing_c1' => $data['transmission_sealing_c1'],
                'pump_non_drvend_c2' => $data['pump_non_drvend_c2'],
                'pump_casing_c2' => $data['pump_casing_c2'],
                'pump_drvend_c2' => $data['pump_drvend_c2'],
                'transmission_sealing_c2' => $data['transmission_sealing_c2'],
                'pump_non_drvend_c3' => $data['pump_non_drvend_c3'],
                'pump_casing_c3' => $data['pump_casing_c3'],
                'pump_drvend_c3' => $data['pump_drvend_c3'],
                'transmission_sealing_c3' => $data['transmission_sealing_c3'],
                'pump_non_drvend_bp1' => $data['pump_non_drvend_bp1'],
                'pump_casing_bp1' => $data['pump_casing_bp1'],
                'pump_drvend_bp1' => $data['pump_drvend_bp1'],
                'tansmission_sealing_bp1' => $data['tansmission_sealing_bp1'],
                'pump_non_drvend_bp2' => $data['pump_non_drvend_bp2'],
                'pump_casing_bp2' => $data['pump_casing_bp2'],
                'pump_drvend_bp2' => $data['pump_drvend_bp2'],
                'transmission_sealing_bp2' => $data['transmission_sealing_bp2'],
                'pump_non_drvend_sp1' => $data['pump_non_drvend_sp1'],
                'pump_casing_sp1' => $data['pump_casing_sp1'],
                'pump_drvend_sp1' => $data['pump_drvend_sp1'],
                'transmission_sealing_sp1' => $data['transmission_sealing_sp1'],
                'pump_non_drvend_tcp' => $data['pump_non_drvend_tcp'],
                'pump_casing_tcp' => $data['pump_casing_tcp'],
                'pump_drvend_tcp' => $data['pump_drvend_tcp'],
                'transmission_sealing_tcp' => $data['transmission_sealing_tcp'],
                'vacuum_pump1' => $data['vacuum_pump1'],
                'vacuum_pump2' => $data['vacuum_pump2'],
                'dsch_press_c1' => $data['dsch_press_c1'],
                'dsch_press_c2' => $data['dsch_press_c2'],
                'dsch_press_c3' => $data['dsch_press_c3'],
                'vibration_c1' => $data['vibration_c1'],
                'vibration_c2' => $data['vibration_c2'],
                'vibration_c3' => $data['vibration_c3'],
                'tcm_sw_temp' => $data['tcm_sw_temp'],
                'tcm_sw_press' => $data['tcm_sw_press'],
            ],
        ];
    }
}
