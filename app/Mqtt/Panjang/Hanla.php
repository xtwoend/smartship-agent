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
        'FP_WB_TK_C',
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
                'terminal_time' => Carbon::now()->format('Y-m-d H:i:s'),
                'no_1_cargo_tank_p' => $data['NO_1_CARGO_TANK_P'],
                'temp_1ctp' => $data['TEMP_1CTP'],
                'no_1_cargo_tank_s' => $data['NO_1_CARGO_TANK_S'],
                'temp_1cts' => $data['TEMP_1CTS'],
                'no_2_cargo_tank_p' => $data['NO_2_CARGO_TANK_P'],
                'temp_2ctp' => $data['TEMP_2CTP'],
                'no_2_cargo_tank_s' => $data['NO_2_CARGO_TANK_S'],
                'temp_2cts' => $data['TEMP_2CTS'],
                'no_3_cargo_tank_p' => $data['NO_3_CARGO_TANK_P'],
                'temp_3ctp' => $data['TEMP_3CTP'],
                'no_3_cargo_tank_s' => $data['NO_3_CARGO_TANK_S'],
                'temp_3cts' => $data['TEMP_3CTS'],
                'no_4_cargo_tank_p' => $data['NO_4_CARGO_TANK_P'],
                'temp_4ctp' => $data['TEMP_4CTP'],
                'no_4_cargo_tank_s' => $data['NO_4_CARGO_TANK_S'],
                'temp_4cts' => $data['TEMP_4CTS'],
                'no_5_cargo_tank_p' => $data['NO_5_CARGO_TANK_P'],
                'temp_5ctp' => $data['TEMP_5CTP'],
                'no_5_cargo_tank_s' => $data['NO_5_CARGO_TANK_S'],
                'temp_5cts' => $data['TEMP_5CTS'],
                'slop_cargo_tank_p' => $data['SLOP_CARGO_TANK_P'],
                'temp_sctp' => $data['TEMP_SCTP'],
                'slop_cargo_tank_s' => $data['SLOP_CARGO_TANK_S'],
                'temp_scts' => $data['TEMP_SCTS'],
                'fp_wb_tk_c' => $data['FP_WB_TK_C'],
                'no_1_wbt_p' => $data['NO_1_WBT_P'],
                'no_1_wbt_s' => $data['NO_1_WBT_S'],
                'no_2_wbt_p' => $data['NO_2_WBT_P'],
                'no_2_wbt_s' => $data['NO_2_WBT_S'],
                'no_3_wbt_p' => $data['NO_3_WBT_P'],
                'no_3_wbt_s' => $data['NO_3_WBT_S'],
                'no_4_wbt_p' => $data['NO_4_WBT_P'],
                'no_4_wbt_s' => $data['NO_4_WBT_S'],
                'no_5_wbt_p' => $data['NO_5_WBT_P'],
                'no_5_wbt_s' => $data['NO_5_WBT_S'],
                'no_6_wbt_p' => $data['NO_6_WBT_P'],
                'no_6_wbt_s' => $data['NO_6_WBT_S'],
                'no_7_wbt_p' => $data['NO_7_WBT_P'],
                'no_7_wbt_s' => $data['NO_7_WBT_S'],
                'aftk_p' => $data['AFTK_P'],
                'aftk_s' => $data['AFTK_S'],
                'no1_mdo_tank_p' => $data['NO1_MDO_TANK_P'],
                'no2_mdo_tank_s' => $data['NO2_MDO_TANK_S'],
                'mdo_sett_tank_s' => $data['MDO_SETT_TANK_S'],
                'no1_mdo_day_tank_p' => $data['NO1_MDO_DAY_TANK_P'],
                'no2_mdo_day_tank_s' => $data['NO2_MDO_DAY_TANK_S'],
                'no1_hfo_tank_p' => $data['NO1_HFO_TANK_P'],
                'no2_hfo_tank_s' => $data['NO2_HFO_TANK_S'],
                'hfo_sett_tank_p' => $data['HFO_SETT_TANK_P'],
                'no1_hfo_day_tank_p' => $data['NO1_HFO_DAY_TANK_P'],
                'no2_hfo_day_tank_s' => $data['NO2_HFO_DAY_TANK_S'],
                'draft_fore' => $data['DRAFT_FORE'],
                'draft_mid_p' => $data['DRAFT_MID_P'],
                'draft_mid_s' => $data['DRAFT_MID_S'],
                'draft_after' => $data['DRAFT_AFTER'],
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
