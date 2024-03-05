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
namespace App\Mqtt\Panjang;

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
                'me_exh_vv_spring_air_pressure' => $data['me_exh_vv_spring_air_pressure'],
                'me_fo_inlet_pressure' => $data['me_fo_inlet_pressure'],
                'tc_lo_inlet_pressure' => $data['tc_lo_inlet_pressure'],
                'me_air_cooler_cw_inlet_pressure' => $data['me_air_cooler_cw_inlet_pressure'],
                'me_exh_vv_driv_oil_inlet_pressure' => $data['me_exh_vv_driv_oil_inlet_pressure'],
                'me_jacket_cfw_inlet_pressure' => $data['me_jacket_cfw_inlet_pressure'],
                'me_starting_air_pressure' => $data['me_starting_air_pressure'],
                'me_scavenging_air_pressure' => $data['me_scavenging_air_pressure'],
                'no1_ge_lo_inlet_pressure' => $data['no1_ge_lo_inlet_pressure'],
                'no2_ge_lo_inlet_pressure' => $data['no2_ge_lo_inlet_pressure'],
                'no3_ge_lo_inlet_pressure' => $data['no3_ge_lo_inlet_pressure'],
                'me_lo_inlet_pressure' => $data['me_lo_inlet_pressure'],
            ],
        ];
    }
}
