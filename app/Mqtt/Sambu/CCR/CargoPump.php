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
use Hyperf\Utils\Codec\Json;

class CargoPump
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
            'cargo_pump' => [
                'terminal_time' => Carbon::now()->format('Y-m-d H:i:s'),
                'pump_non_drvend_c1' => (float) $data['pump_non_drvend_c1'] ?: 0,
                'pump_casing_c1' => (float) $data['pump_casing_c1'] ?: 0,
                'pump_drvend_c1' => (float) $data['pump_drvend_c1'] ?: 0,
                'transmission_sealing_c1' => (float) $data['transmission_sealing_c1'] ?: 0,
                'pump_non_drvend_c2' => (float) $data['pump_non_drvend_c2'] ?: 0,
                'pump_casing_c2' => (float) $data['pump_casing_c2'] ?: 0,
                'pump_drvend_c2' => (float) $data['pump_drvend_c2'] ?: 0,
                'transmission_sealing_c2' => (float) $data['transmission_sealing_c2'] ?: 0,
                'pump_non_drvend_c3' => (float) $data['pump_non_drvend_c3'] ?: 0,
                'pump_casing_c3' => (float) $data['pump_casing_c3'] ?: 0,
                'pump_drvend_c3' => (float) $data['pump_drvend_c3'] ?: 0,
                'transmission_sealing_c3' => (float) $data['transmission_sealing_c3'] ?: 0,
                'pump_non_drvend_bp1' => (float) $data['pump_non_drvend_bp1'] ?: 0,
                'pump_casing_bp1' => (float) $data['pump_casing_bp1'] ?: 0,
                'pump_drvend_bp1' => (float) $data['pump_drvend_bp1'] ?: 0,
                'transmission_sealing_bp1' => (float) $data['transmission_sealing_bp1'] ?: 0,
                'pump_non_drvend_bp2' => (float) $data['pump_non_drvend_bp2'] ?: 0,
                'pump_casing_bp2' => (float) $data['pump_casing_bp2'] ?: 0,
                'pump_drvend_bp2' => (float) $data['pump_drvend_bp2'] ?: 0,
                'transmission_sealing_bp2' => (float) $data['transmission_sealing_bp2'] ?: 0,
                'pump_non_drvend_sp1' => (float) $data['pump_non_drvend_sp1'] ?: 0,
                'pump_casing_sp1' => (float) $data['pump_casing_sp1'] ?: 0,
                'pump_drvend_sp1' => (float) $data['pump_drvend_sp1'] ?: 0,
                'transmission_sealing_sp1' => (float) $data['transmission_sealing_sp1'] ?: 0,
                'pump_non_drvend_tcp' => (float) $data['pump_non_drvend_tcp'] ?: 0,
                'pump_casing_tcp' => (float) $data['pump_casing_tcp'] ?: 0,
                'pump_drvend_tcp' => (float) $data['pump_drvend_tcp'] ?: 0,
                'transmission_sealing_tcp' => (float) $data['transmission_sealing_tcp'] ?: 0,
                'vacuum_pump1' => (float) $data['vacuum_pump1'] ?: 0,
                'vacuum_pump2' => (float) $data['vacuum_pump2'] ?: 0,
                'dsch_press_c1' => (float) $data['dsch_press_c1'] ?: 0,
                'dsch_press_c2' => (float) $data['dsch_press_c2'] ?: 0,
                'dsch_press_c3' => (float) $data['dsch_press_c3'] ?: 0,
                'vibration_c1' => (float) $data['vibration_c1'] ?: 0,
                'vibration_c2' => (float) $data['vibration_c2'] ?: 0,
                'vibration_c3' => (float) $data['vibration_c3'] ?: 0,
                'tcm_sw_temp' => (float) $data['tcm_sw_temp'] ?: 0,
                'tcm_sw_press' => (float) $data['tcm_sw_press'] ?: 0,
            ],
        ];
    }
}
