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
namespace App\Mqtt\Papandayan;

use Carbon\Carbon;
use Hyperf\Utils\Codec\Json;
use Hyperf\Utils\Str;

class Hanla
{
    protected string $message;

    protected $mappArray = [
        'NO_1_CARGO_TANK_P',
        'TEMP_1CTP',
        'NO_1_CARGO_TANK_S',
        'TEMP_1CTS',
        'NO_2_CARGO_TANK_P',
        'TEMP_2CTP',
        'NO_2_CARGO_TANK_S',
        'TEMP_2CTS',
        'NO_3_CARGO_TANK_P',
        'TEMP_3CTP',
        'NO_3_CARGO_TANK_S',
        'TEMP_3CTS',
        'NO_4_CARGO_TANK_P',
        'TEMP_4CTP',
        'NO_4_CARGO_TANK_S',
        'TEMP_4CTS',
        'NO_5_CARGO_TANK_P',
        'TEMP_5CTP',
        'NO_5_CARGO_TANK_S',
        'TEMP_5CTS',
        'SLOP_CARGO_TANK_P',
        'TEMP_SCTP',
        'SLOP_CARGO_TANK_S',
        'TEMP_SCTS',
        'F_P_T_C',
        'NO_1_WBT_P',
        'NO_1_WBT_S',
        'NO_2_WBT_P',
        'NO_2_WBT_S',
        'NO_3_WBT_P',
        'NO_3_WBT_S',
        'NO_4_WBT_P',
        'NO_4_WBT_S',
        'NO_5_WBT_P',
        'NO_5_WBT_S',
        'NO_6_WBT_P',
        'NO_6_WBT_S',
        'NO_7_WBT_P',
        'NO_7_WBT_S',
        'AFTK_P',
        'AFTK_S',
        'NO1_MDO_TANK_P',
        'NO2_MDO_TANK_S',
        'MDO_SETT_TANK_S',
        'NO1_MDO_DAY_TANK_P',
        'NO2_MDO_DAY_TANK_S',
        'NO1_HFO_TANK_P',
        'NO2_HFO_TANK_S',
        'HFO_SETT_TANK_P',
        'NO1_HFO_DAY_TANK_P',
        'NO2_HFO_DAY_TANK_S',
        'DRAFT_FORE',
        'DRAFT_MID_P',
        'DRAFT_MID_S',
        'DRAFT_AFTER',
    ];

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
                'temp_3cts' => (float) $data['TEMP_3CTS'],
                'no_4_cargo_tank_p' => (float) $data['NO_4_CARGO_TANK_P'],
                'temp_4ctp' => (float) $data['TEMP_4CTP'],
                'no_4_cargo_tank_s' => (float) $data['NO_4_CARGO_TANK_S'],
                'temp_4cts' => (float) $data['TEMP_4CTS'],
                'no_5_cargo_tank_p' => (float) $data['NO_5_CARGO_TANK_P'],
                'temp_5ctp' => (float) $data['TEMP_5CTP'],
                'no_5_cargo_tank_s' => (float) $data['NO_5_CARGO_TANK_S'],
                'temp_5cts' => (float) $data['TEMP_5CTS'],
                'slop_cargo_tank_p' => (float) $data['SLOP_CARGO_TANK_P'],
                'temp_sctp' => (float) $data['TEMP_SCTP'],
                'slop_cargo_tank_s' => (float) $data['SLOP_CARGO_TANK_S'],
                'temp_scts' => (float) $data['TEMP_SCTS'],
                'f_p_t_c' => (float) $data['F_P_T_C'],
                'no_1_wbt_p' => (float) $data['NO_1_WBT_P'],
                'no_1_wbt_s' => (float) $data['NO_1_WBT_S'],
                'no_2_wbt_p' => (float) $data['NO_2_WBT_P'],
                'no_2_wbt_s' => (float) $data['NO_2_WBT_S'],
                'no_3_wbt_p' => (float) $data['NO_3_WBT_P'],
                'no_3_wbt_s' => (float) $data['NO_3_WBT_S'],
                'no_4_wbt_p' => (float) $data['NO_4_WBT_P'],
                'no_4_wbt_s' => (float) $data['NO_4_WBT_S'],
                'no_5_wbt_p' => (float) $data['NO_5_WBT_P'],
                'no_5_wbt_s' => (float) $data['NO_5_WBT_S'],
                'no_6_wbt_p' => (float) $data['NO_6_WBT_P'],
                'no_6_wbt_s' => (float) $data['NO_6_WBT_S'],
                'no_7_wbt_p' => (float) $data['NO_7_WBT_P'],
                'no_7_wbt_s' => (float) $data['NO_7_WBT_S'],
                'aftk_p' => (float) $data['AFTK_P'],
                'aftk_s' => (float) $data['AFTK_S'],
                'no1_mdo_tank_p' => (float) $data['NO1_MDO_TANK_P'],
                'no2_mdo_tank_s' => (float) $data['NO2_MDO_TANK_S'],
                'mdo_sett_tank_s' => (float) $data['MDO_SETT_TANK_S'],
                'no1_mdo_day_tank_p' => (float) $data['NO1_MDO_DAY_TANK_P'],
                'no2_mdo_day_tank_s' => (float) $data['NO2_MDO_DAY_TANK_S'],
                'no1_hfo_tank_p' => (float) $data['NO1_HFO_TANK_P'],
                'no2_hfo_tank_s' => (float) $data['NO2_HFO_TANK_S'],
                'hfo_sett_tank_p' => (float) $data['HFO_SETT_TANK_P'],
                'no1_hfo_day_tank_p' => (float) $data['NO1_HFO_DAY_TANK_P'],
                'no2_hfo_day_tank_s' => (float) $data['NO2_HFO_DAY_TANK_S'],
                'draft_fore' => (float) $data['DRAFT_FORE'],
                'draft_mid_p' => (float) $data['DRAFT_MID_P'],
                'draft_mid_s' => (float) $data['DRAFT_MID_S'],
                'draft_after' => (float) $data['DRAFT_AFTER'],
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
            $key = Str::snake(strtolower($val));
            $snake[$key] = $val;
        }
        return $snake;
    }
}
