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
        'NO_1_HFO_P',
        'NO_2_HFO_S',
        'NO_1_HFODAY_P',
        'NO_2_HFODAY_S',
        'HFO_SETT_P',
        'MDO_SETT_S',
        'NO_1_MDO_P',
        'NO_2_MDO_S',
        'NO_1_MDODAY_P',
        'NO_S_MDODAY_S',
        'VOLUME_COT_1P',
        'VOLUME_COT_1S',
        'VOLUME_COT_2P',
        'VOLUME_COT_2S',
        'VOLUME_COT_3P',
        'VOLUME_COT_3S',
        'VOLUME_COT_4P',
        'VOLUME_COT_4S',
        'VOLUME_COT_5P',
        'VOLUME_COT_5S',
        'VOLUME_FPT',
        'VOLUME_WBT_1P',
        'VOLUME_WBT_1S',
        'VOLUME_WBT_2P',
        'VOLUME_WBT_2S',
        'VOLUME_WBT_3P',
        'VOLUME_WBT_3S',
        'VOLUME_WBT_4P',
        'VOLUME_WBT_4S',
        'VOLUME_WBT_5P',
        'VOLUME_WBT_5S',
        'VOLUME_WBT_6P',
        'VOLUME_WBT_6S',
        'VOLUME_WBT_7P',
        'VOLUME_WBT_7S',
        'VOLUME_AFT_1P',
        'VOLUME_AFT_1S',
        'VOLUME_MDO_1P',
        'VOLUME_MDO_2S',
        'VOLUME_HFO_1P',
        'VOLUME_HFO_2S',
        'VOLUME_MDO_SETT_S',
        'VOLUME_MDODAY_1P',
        'VOLUME_MDODAY_2S',
        'VOLUME_HFO_SETT_P',
        'cargo_pump1_run',
        'cargo_pump2_run',
        'cargo_pump3_run',
        'wballast_pump1_run',
        'wballast_pump2_run',
        'tank_cleaning_pump_run',
        'stripping_pump_run',
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
                'f_p_t_c' => $data['F_P_T_C'],
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
                'no_1_hfo_p' => $data['NO_1_HFO_P'],
                'no_2_hfo_s' => $data['NO_2_HFO_S'],
                'no_1_hfoday_p' => $data['NO_1_HFODAY_P'],
                'no_2_hfoday_s' => $data['NO_2_HFODAY_S'],
                'hfo_sett_p' => $data['HFO_SETT_P'],
                'mdo_sett_s' => $data['MDO_SETT_S'],
                'no_1_mdo_p' => $data['NO_1_MDO_P'],
                'no_2_mdo_s' => $data['NO_2_MDO_S'],
                'no_1_mdoday_p' => $data['NO_1_MDODAY_P'],
                'no_s_mdoday_s' => $data['NO_S_MDODAY_S'],
                'volume_cot_1p' => $data['VOLUME_COT_1P'],
                'volume_cot_1s' => $data['VOLUME_COT_1S'],
                'volume_cot_2p' => $data['VOLUME_COT_2P'],
                'volume_cot_2s' => $data['VOLUME_COT_2S'],
                'volume_cot_3p' => $data['VOLUME_COT_3P'],
                'volume_cot_3s' => $data['VOLUME_COT_3S'],
                'volume_cot_4p' => $data['VOLUME_COT_4P'],
                'volume_cot_4s' => $data['VOLUME_COT_4S'],
                'volume_cot_5p' => $data['VOLUME_COT_5P'],
                'volume_cot_5s' => $data['VOLUME_COT_5S'],
                'volume_fpt' => $data['VOLUME_FPT'],
                'volume_wbt_1p' => $data['VOLUME_WBT_1P'],
                'volume_wbt_1s' => $data['VOLUME_WBT_1S'],
                'volume_wbt_2p' => $data['VOLUME_WBT_2P'],
                'volume_wbt_2s' => $data['VOLUME_WBT_2S'],
                'volume_wbt_3p' => $data['VOLUME_WBT_3P'],
                'volume_wbt_3s' => $data['VOLUME_WBT_3S'],
                'volume_wbt_4p' => $data['VOLUME_WBT_4P'],
                'volume_wbt_4s' => $data['VOLUME_WBT_4S'],
                'volume_wbt_5p' => $data['VOLUME_WBT_5P'],
                'volume_wbt_5s' => $data['VOLUME_WBT_5S'],
                'volume_wbt_6p' => $data['VOLUME_WBT_6P'],
                'volume_wbt_6s' => $data['VOLUME_WBT_6S'],
                'volume_wbt_7p' => $data['VOLUME_WBT_7P'],
                'volume_wbt_7s' => $data['VOLUME_WBT_7S'],
                'volume_aft_1p' => $data['VOLUME_AFT_1P'],
                'volume_aft_1s' => $data['VOLUME_AFT_1S'],
                'volume_mdo_1p' => $data['VOLUME_MDO_1P'],
                'volume_mdo_2s' => $data['VOLUME_MDO_2S'],
                'volume_hfo_1p' => $data['VOLUME_HFO_1P'],
                'volume_hfo_2s' => $data['VOLUME_HFO_2S'],
                'volume_mdo_sett_s' => $data['VOLUME_MDO_SETT_S'],
                'volume_mdoday_1p' => $data['VOLUME_MDODAY_1P'],
                'volume_mdoday_2s' => $data['VOLUME_MDODAY_2S'],
                'volume_hfo_sett_p' => $data['VOLUME_HFO_SETT_P'],
                'cargo_pump1_run' => $data['cargo_pump1_run'],
                'cargo_pump2_run' => $data['cargo_pump2_run'],
                'cargo_pump3_run' => $data['cargo_pump3_run'],
                'wballast_pump1_run' => $data['wballast_pump1_run'],
                'wballast_pump2_run' => $data['wballast_pump2_run'],
                'tank_cleaning_pump_run' => $data['tank_cleaning_pump_run'],
                'stripping_pump_run' => $data['stripping_pump_run'],
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
