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
namespace App\Mqtt\Pasaman;

use Carbon\Carbon;
use Hyperf\Utils\Codec\Json;

class Engine
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
            'engine' => [
                'terminal_time' => Carbon::now()->format('Y-m-d H:i:s'),
                'me_lo_inlet_pressure' => $data['me_lo_inlet_pressure'],
                'me_tc_lo_inlet_pressure' => $data['me_tc_lo_inlet_pressure'],
                'me_jcw_inlet_pressure' => $data['me_jcw_inlet_pressure'],
                'me_fo_inlet_pressure' => $data['me_fo_inlet_pressure'],
                'me_starting_air_pressure' => $data['me_starting_air_pressure'],
                'me_scavenging_air_pressure' => $data['me_scavenging_air_pressure'],
                'me_exh_valve_spring_air_pressure' => $data['me_exh_valve_spring_air_pressure'],
                'me_cfw_air_cooler_pressure' => $data['me_cfw_air_cooler_pressure'],
                'me_exh_valve_drive_oil_pressure' => $data['me_exh_valve_drive_oil_pressure'],
                'no1_dg_lo_inlet_pressure' => $data['no1_dg_lo_inlet_pressure'],
                'no2_dg_lo_inlet_pressure' => $data['no2_dg_lo_inlet_pressure'],
                'no3_dg_lo_inlet_pressure' => $data['no3_dg_lo_inlet_pressure'],
            ],
        ];
    }
}
