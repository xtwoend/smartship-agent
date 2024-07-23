<?php

namespace Smartship\Plaju\Parser;

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
                'level_cot_1p' => (float) $data['level_cot_1p'],
                'temp_cot_1p' => (float) $data['temp_cot_1p'],
                'level_cot_1s' => (float) $data['level_cot_1s'],
                'temp_cot_1s' => (float) $data['temp_cot_1s'],
                'level_cot_2p' => (float) $data['level_cot_2p'],
                'temp_cot_2p' => (float) $data['temp_cot_2p'],
                'level_cot_2s' => (float) $data['level_cot_2s'],
                'temp_cot_2s' => (float) $data['temp_cot_2s'],
                'level_cot_3p' => (float) $data['level_cot_3p'],
                'temp_cot_3p' => (float) $data['temp_cot_3p'],
                'level_cot_3s' => (float) $data['level_cot_3s'],
                'temp_cot_3s' => (float) $data['temp_cot_3s'],
                'level_cot_4p' => (float) $data['level_cot_4p'],
                'temp_cot_4p' => (float) $data['temp_cot_4p'],
                'level_cot_4s' => (float) $data['level_cot_4s'],
                'temp_cot_4s' => (float) $data['temp_cot_4s'],
                'level_cot_5p' => (float) $data['level_cot_5p'],
                'temp_cot_5p' => (float) $data['temp_cot_5p'],
                'level_cot_5s' => (float) $data['level_cot_5s'],
                'temp_cot_5s' => (float) $data['temp_cot_5s'],
                'level_slop_p' => (float) $data['level_slop_p'],
                'temp_slop_p' => (float) $data['temp_slop_p'],
                'level_slop_s' => (float) $data['level_slop_s'],
                'temp_slop_s' => (float) $data['temp_slop_s'],
                'fore_peak_tank' => (float) $data['fore_peak_tank'],
                'level_wbt_1p' => (float) $data['level_wbt_1p'],
                'level_wbt_1s' => (float) $data['level_wbt_1s'],
                'level_wbt_2p' => (float) $data['level_wbt_2p'],
                'level_wbt_2s' => (float) $data['level_wbt_2s'],
                'level_wbt_3p' => (float) $data['level_wbt_3p'],
                'level_wbt_3s' => (float) $data['level_wbt_3s'],
                'level_wbt_4p' => (float) $data['level_wbt_4p'],
                'level_wbt_4s' => (float) $data['level_wbt_4s'],
                'level_wbt_5p' => (float) $data['level_wbt_5p'],
                'level_wbt_5s' => (float) $data['level_wbt_5s'],
                'level_draft_fore' => (float) $data['level_draft_fore'],
                'level_draft_after' => (float) $data['level_draft_after'],
                'after_peak_tank' => (float) $data['after_peak_tank'],
                'mdo_mgo_tank_p' => (float) $data['mdo_mgo_tank_p'],
                'mdo_tank_s' => (float) $data['mdo_tank_s'],
                'fore_fw_tank_p' => (float) $data['fore_fw_tank_p'],
                'fore_fw_tank_s' => (float) $data['fore_fw_tank_s'],
                'fw_tank_p' => (float) $data['fw_tank_p'],
                'fw_tank_s' => (float) $data['fw_tank_s'],
                'fo_overflow_tank' => (float) $data['fo_overflow_tank']
            ],
        ];
    }
}