<?php

namespace Smartship\Meditran\Parser;

use Carbon\Carbon;
use Hyperf\Codec\Json;

class Hanla
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
                'terminal_time' => (string) Carbon::now()->format('Y-m-d H:i:s'),
                'no_1_cargo_tank_p' => (float) $data['no_1_cargo_tank_p'],
                'temp_1ctp' => (float) $data['temp_1ctp'],
                'no_1_cargo_tank_s' => (float) $data['no_1_cargo_tank_s'],
                'temp_1cts' => (float) $data['temp_1cts'],
                'no_2_cargo_tank_p' => (float) $data['no_2_cargo_tank_p'],
                'temp_2ctp' => (float) $data['temp_2ctp'],
                'no_2_cargo_tank_s' => (float) $data['no_2_cargo_tank_s'],
                'temp_2cts' => (float) $data['temp_2cts'],
                'no_3_cargo_tank_p' => (float) $data['no_3_cargo_tank_p'],
                'temp_3ctp' => (float) $data['temp_3ctp'],
                'no_3_cargo_tank_s' => (float) $data['no_3_cargo_tank_s'],
                'temp_3ctm' => (float) $data['temp_3ctm'],
                'no_4_cargo_tank_p' => (float) $data['no_4_cargo_tank_p'],
                'temp_4ctp' => (float) $data['temp_4ctp'],
                'no_4_cargo_tank_s' => (float) $data['no_4_cargo_tank_s'],
                'temp_4cts' => (float) $data['temp_4cts'],
                'no_5_cargo_tank_p' => (float) $data['no_5_cargo_tank_p'],
                'temp_5ctp' => (float) $data['temp_5ctp'],
                'no_5_cargo_tank_s' => (float) $data['no_5_cargo_tank_s'],
                'temp_5cts' => (float) $data['temp_5cts'],
                'slop_tank_p' => (float) $data['slop_tank_p'],
                'temp_stp' => (float) $data['temp_stp'],
                'slop_tank_s' => (float) $data['slop_tank_s'],
                'temp_sts' => (float) $data['temp_sts'],
            ],
        ];
    }
}