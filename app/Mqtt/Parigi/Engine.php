<?php

namespace App\Mqtt\Parigi;

use Carbon\Carbon;
use Hyperf\Utils\Codec\Json;

class Engine
{
    protected string $message;

    public function __construct(string $message) {
       
        $this->message = $message;
    }
    
    public function extract()
    {
        $data = Json::decode($this->message);
        
        return [
            'engine' => [
                'terminal_time' => Carbon::now()->format('Y-m-d H:i:s'),
                'mdo_tank_1p' => (float) $data['mdo_tank_1p'],
                'mdo_tank_2s' => (float) $data['mdo_tank_2s'],
                'mdo_day_tank_1p' => (float) $data['mdo_day_tank_1p'],
                'mdo_day_tank_2s' => (float) $data['mdo_day_tank_2s'],
                'hfo_tank_1p' => (float) $data['hfo_tank_1p'],
                'hfo_tank_2s' => (float) $data['hfo_tank_2s'],
                'hfo_day_tank_1p' => (float) $data['hfo_day_tank_1p'],
                'hfo_day_tank_2s' => (float) $data['hfo_day_tank_2s'],
                'hfo_setting_tank' => (float) $data['hfo_setting_tank'],
                'mdo_setting_tank' => (float) $data['mdo_setting_tank'],
                'me_rpm' => (float) $data['me_rpm'],
                'spare_2' => (float) $data['spare_2'],
                'spare_3' => (float) $data['spare_3'],
                'spare_4' => (float) $data['spare_4'],
                'spare_5' => (float) $data['spare_5'],
                'spare_6' => (float) $data['spare_6'],
                'me_starting_air_pressure' => (float) $data['me_starting_air_pressure'],
                'scav_air_pressure' => (float) $data['scav_air_pressure'],
                'main_lo_pco_inlet_pressure' => (float) $data['main_lo_pco_inlet_pressure'],
                'tc_lo_inlet_pressur_me' => (float) $data['tc_lo_inlet_pressur_me'],
                'tc_tachometer' => (float) $data['tc_tachometer'],
                'me_fo_inlet_pressure' => (float) $data['me_fo_inlet_pressure'],
                'me_jacket_cfw_inlet_pressure' => (float) $data['me_jacket_cfw_inlet_pressure'],
                'me_lo_inlet_pressure' => (float) $data['me_lo_inlet_pressure'],
                'spare_7' => (float) $data['spare_7'],
                'spare_8' => (float) $data['spare_8'],
                'spare_9' => (float) $data['spare_9'],
                'spare_10' => (float) $data['spare_10'],
            ]
        ];
    }
}