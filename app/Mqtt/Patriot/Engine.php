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
namespace App\Mqtt\Patriot;

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
                'me_fo_inlet_press' => (float) $data['me_fo_inlet_press'],
                'me_lo_pco_inlet_press' => (float) $data['me_lo_pco_inlet_press'],
                'jcw_inlet_press' => (float) $data['jcw_inlet_press'],
                'air_cooler_cw_inlet_press' => (float) $data['air_cooler_cw_inlet_press'],
                'starting_air_press' => (float) $data['starting_air_press'],
                'scavenging_air_inlet_press' => (float) $data['scavenging_air_inlet_press'],
                'control_air_press' => (float) $data['control_air_press'],
            ],
        ];
    }
}
