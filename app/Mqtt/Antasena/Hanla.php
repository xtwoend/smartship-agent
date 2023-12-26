<?php

namespace App\Mqtt\Antasena;

use Carbon\Carbon;
use Hyperf\Utils\Str;
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
                'terminal_time' => $data['_terminalTime'] ?: Carbon::now()->format('Y-m-d H:i:s'),
                'level_cot_1p' => $data['level_cot_1p'],
                'temp_cot_1p' => $data['temp_cot_1p'],
                'level_cot_1s' => $data['level_cot_1s'],
                'temp_cot_1s' => $data['temp_cot_1s'],
                'level_cot_2p' => $data['level_cot_2p'],
                'temp_cot_2p' => $data['temp_cot_2p'],
                'level_cot_2s' => $data['level_cot_2s'],
                'temp_cot_2s' => $data['temp_cot_2s'],
                'level_cot_3p' => $data['level_cot_3p'],
                'temp_cot_3p' => $data['temp_cot_3p'],
                'level_cot_3s' => $data['level_cot_3s'],
                'temp_cot_3s' => $data['temp_cot_3s'],
                'level_cot_4p' => $data['level_cot_4p'],
                'temp_cot_4p' => $data['temp_cot_4p'],
                'level_cot_4s' => $data['level_cot_4s'],
                'temp_cot_4s' => $data['temp_cot_4s'],
                'level_cot_5p' => $data['level_cot_5p'],
                'temp_cot_5p' => $data['temp_cot_5p'],
                'level_cot_5s' => $data['level_cot_5s'],
                'temp_cot_5s' => $data['temp_cot_5s'],
                'level_slop_p' => $data['level_slop_p'],
                'temp_slop_p' => $data['temp_slop_p'],
                'level_slop_s' => $data['level_slop_s'],
                'temp_slop_s' => $data['temp_slop_s'],
                'fore_peak_tank' => $data['fore_peak_tank'],
                'level_wbt_1p' => $data['level_wbt_1p'],
                'level_wbt_1s' => $data['level_wbt_1s'],
                'level_wbt_2p' => $data['level_wbt_2p'],
                'level_wbt_2s' => $data['level_wbt_2s'],
                'level_wbt_3p' => $data['level_wbt_3p'],
                'level_wbt_3s' => $data['level_wbt_3s'],
                'level_wbt_4p' => $data['level_wbt_4p'],
                'level_wbt_4s' => $data['level_wbt_4s'],
                'level_wbt_5p' => $data['level_wbt_5p'],
                'level_wbt_5s' => $data['level_wbt_5s'],
                'level_draft_fore' => $data['level_draft_fore'],
                'level_draft_after' => $data['level_draft_after'],
                'after_peak_tank' => $data['after_peak_tank'],
                'mdo_mgo_tank_p' => $data['mdo_mgo_tank_p'],
                'mdo_tank_s' => $data['mdo_tank_s'],
                'fore_fw_tank_p' => $data['fore_fw_tank_p'],
                'fore_fw_tank_s' => $data['fore_fw_tank_s'],
                'fw_tank_p' => $data['fw_tank_p'],
                'fw_tank_s' => $data['fw_tank_s'],
                'fo_overflow_tank' => $data['fo_overflow_tank'],
            ]
        ];
    }

    function arrayToSnake() : array {
        $snake = [];
        foreach($this->mappArray as $in => $val) {
            if(is_null($val)) continue;
            $key = Str::snake(strtolower($val));
            $snake[$key] = $val;
        } 
        return $snake;
    }

    protected $mappArray = [
        'level_cot_1p',
        'temp_cot_1p',
        'level_cot_1s',
        'temp_cot_1s',
        'level_cot_2p',
        'temp_cot_2p',
        'level_cot_2s',
        'temp_cot_2s',
        'level_cot_3p',
        'temp_cot_3p',
        'level_cot_3s',
        'temp_cot_3s',
        'level_cot_4p',
        'temp_cot_4p',
        'level_cot_4s',
        'temp_cot_4s',
        'level_cot_5p',
        'temp_cot_5p',
        'level_cot_5s',
        'temp_cot_5s',
        'level_slop_p',
        'temp_slop_p',
        'level_slop_s',
        'temp_slop_s',
        'fore_peak_tank',
        'level_wbt_1p',
        'level_wbt_1s',
        'level_wbt_2p',
        'level_wbt_2s',
        'level_wbt_3p',
        'level_wbt_3s',
        'level_wbt_4p',
        'level_wbt_4s',
        'level_wbt_5p',
        'level_wbt_5s',
        'level_draft_fore',
        'level_draft_after',
        'after_peak_tank',
        'mdo_mgo_tank_p',
        'mdo_tank_s',
        'fore_fw_tank_p',
        'fore_fw_tank_s',
        'fw_tank_p',
        'fw_tank_s',
        'fo_overflow_tank',
    ];
}