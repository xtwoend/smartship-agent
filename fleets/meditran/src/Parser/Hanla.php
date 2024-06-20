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
                'no_1_cargo_tank_p' => (float) $data['NO_1_CARGO_TANK_P'],
                'temp_1ctp' => (float) $data['TEMP_1CTP'],
                'no_1_cargo_tank_s' => (float) $data['NO_1_CARGO_TANK_S'],
                'temp_1cts' => (float) $data['TEMP_1CTS'],
                'no_2_cargo_tank_p' => (float) $data['NO_2_CARGO_TANK_P'],
                'temp_2ctp' => (float) $data['TEMP_2CTP'],
                'no_2_cargo_tank_s' => (float) $data['NO_2_CARGO_TANK_S'],
                'temp_2cts' => (float) $data['TEMP_2CTS'],
                'no_3_cargo_tank_p' => (float) $data['NO_3_CARGO_TANK_P'],
                'temp_3ctp' => (float) $data['TEMP_3CTP'],
                'no_3_cargo_tank_s' => (float) $data['NO_3_CARGO_TANK_S'],
                'temp_3ctm' => (float) $data['TEMP_3CTM'],
                'no_4_cargo_tank_p' => (float) $data['NO_4_CARGO_TANK_P'],
                'temp_4ctp' => (float) $data['TEMP_4CTP'],
                'no_4_cargo_tank_s' => (float) $data['NO_4_CARGO_TANK_S'],
                'temp_4cts' => (float) $data['TEMP_4CTS'],
                'no_5_cargo_tank_p' => (float) $data['NO_5_CARGO_TANK_P'],
                'temp_5ctp' => (float) $data['TEMP_5CTP'],
                'no_5_cargo_tank_s' => (float) $data['NO_5_CARGO_TANK_S'],
                'temp_5cts' => (float) $data['TEMP_5CTS'],
                'slop_tank_p' => (float) $data['SLOP_TANK_P'],
                'temp_stp' => (float) $data['TEMP_STP'],
                'slop_tank_s' => (float) $data['SLOP_TANK_S'],
                'temp_sts' => (float) $data['TEMP_STS'],
            ],
        ];
    }
}