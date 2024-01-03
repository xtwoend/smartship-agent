<?php

namespace App\Mqtt\Parigi;

use Carbon\Carbon;
use Hyperf\Utils\Codec\Json;

class Hanla
{
    protected string $message;

    public function __construct(string $message) {
        $this->message = $message;
    }

    public function extract()
    {
        $data = Json::decode($this->message);

        return [
            'cargo' => [
                'terminal_time' => Carbon::now()->format('Y-m-d H:i:s'),
                'no1_cargo_tank_p_level' => (float) $data['NO_1_CARGO_TANK_P'],
                'no1_cargo_tank_p_temp' => (float) $data['TEMP_1CTP'],
                'no1_cargo_tank_s_level' => (float) $data['NO_1_CARGO_TANK_S'],
                'no1_cargo_tank_s_temp' => (float) $data['TEMP_1CTS'],

                'no2_cargo_tank_p_level' => (float) $data['NO_2_CARGO_TANK_P'],
                'no2_cargo_tank_p_temp' => (float) $data['TEMP_2CTP'],
                'no2_cargo_tank_s_level' => (float) $data['NO_2_CARGO_TANK_S'],
                'no2_cargo_tank_s_temp' => (float) $data['TEMP_2CTS'],

                'no3_cargo_tank_p_level' => (float) $data['NO_3_CARGO_TANK_P'],
                'no3_cargo_tank_p_temp' => (float) $data['TEMP_3CTP'],
                'no3_cargo_tank_s_level' => (float) $data['NO_3_CARGO_TANK_S'],
                'no3_cargo_tank_s_temp' => (float) $data['TEMP_3CTS'],

                'no4_cargo_tank_p_level' => (float) $data['NO_4_CARGO_TANK_P'],
                'no4_cargo_tank_p_temp' => (float) $data['TEMP_4CTP'],
                'no4_cargo_tank_s_level' => (float) $data['NO_4_CARGO_TANK_S'],
                'no4_cargo_tank_s_temp' => (float) $data['TEMP_4CTS'],

                'no5_cargo_tank_p_level' => (float) $data['NO_5_CARGO_TANK_P'],
                'no5_cargo_tank_p_temp' => (float) $data['TEMP_5CTP'],
                'no5_cargo_tank_s_level' => (float) $data['NO_5_CARGO_TANK_S'],
                'no5_cargo_tank_s_temp' => (float) $data['TEMP_5CTS'],

                'slop_tank_p_level' => (float) $data['Data_SLOP_CARGO_TANK_P'],
                'slop_tank_p_temp' => (float) $data['Data_TEMP_SCTP'],

                'slop_tank_s_level' => (float) $data['Data_SLOP_CARGO_TANK_S'],
                'slop_tank_s_temp' => (float) $data['Data_TEMP_SCTS'],
            ]
        ];
    }
}