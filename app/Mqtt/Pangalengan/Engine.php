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
namespace App\Mqtt\Pangalengan;

use Carbon\Carbon;
use Hyperf\Utils\Codec\Json;
use Hyperf\Utils\Str;

class Engine
{
    protected string $message;

    protected $mappArray = [
    ];

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
                'control_air_inlet_pressure' => $data['control_air_inlet_pressure'],
                'me_fo_inlet_pressure' => $data['me_fo_inlet_pressure'],
                'tc_lo_inlet_pressure' => $data['tc_lo_inlet_pressure'],
                'me_air_cooler_cw_inlet_pressure' => $data['me_air_cooler_cw_inlet_pressure'],
                'main_lo_pco_inlet_pressure' => $data['main_lo_pco_inlet_pressure'],
                'jcw_inlet_pressure' => $data['jcw_inlet_pressure'],
                'me_starting_air_pressure' => $data['me_starting_air_pressure'],
                'me_scavenging_air_pressure' => $data['me_scavenging_air_pressure'],
                'no1_dg_lo_inlet_pressure' => $data['no1_dg_lo_inlet_pressure'],
                'no2_dg_lo_inlet_pressure' => $data['no2_dg_lo_inlet_pressure'],
                'no3_dg_lo_inlet_pressure' => $data['no3_dg_lo_inlet_pressure'],
                'tc_tacho_rpm' => $data['tc_tacho_rpm'],
            ],
        ];
    }

    public function arrayToSnake(): array
    {
        $snake = [];
        foreach ($this->mappArray as $in => $val) {
            if (is_null($val)) {
                continue;
            }
            $key = Str::snake($val);
            $snake[$key] = $in;
        }
        return $snake;
    }
}
