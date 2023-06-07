<?php

namespace App\Mqtt\Walio\ECR;

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
                'terminal_time' => (string) $data['_terminalTime'] ?: Carbon::now()->format('Y-m-d H:i:s'),
                'me_tc_rpm_indicator' => $data['me_tc_rpm_indicator'],
                'ai_hfo_bunker' => $data['ai_hfo_bunker'],
                'ai_fwd_hfo_bunker' => $data['ai_fwd_hfo_bunker'],
                'ai_ls_hfo_bunker' => $data['ai_ls_hfo_bunker'],
                'ai_hfo_service' => $data['ai_hfo_service'],
                'ai_hfo_settling' => $data['ai_hfo_settling'],
                'ai_ls_hfo_settling' => $data['ai_ls_hfo_settling'],
                'ai_mdo_storage' => $data['ai_mdo_storage'],
                'ai_mdo_service' => $data['ai_mdo_service'],
                'ai_igg_fuel' => $data['ai_igg_fuel'],
                'me_fo_inlet_engine' => $data['me_fo_inlet_engine'],
                'me_lo_inlet_press' => $data['me_lo_inlet_press'],
                'me_scav_air_inlet_press' => $data['me_scav_air_inlet_press'],
                'me_jcfw_inlet_press' => $data['me_jcfw_inlet_press'],
                'me_starting_air_inlet_press' => $data['me_starting_air_inlet_press'],
                'me_cont_air_inlet_press' => $data['me_cont_air_inlet_press'],
                'hfo_bunker_tank' => $data['hfo_bunker_tank'],
                'fwd_hfo_bunker_tank' => $data['fwd_hfo_bunker_tank'],
                'ls_hfo_bunker_tank' => $data['ls_hfo_bunker_tank'],
                'hfo_service_tank' => $data['hfo_service_tank'],
                'ls_hfo_service_tank' => $data['ls_hfo_service_tank'],
                'hfo_settling_tank' => $data['hfo_settling_tank'],
                'ls_hfo_settling_tank' => $data['ls_hfo_settling_tank'],
                'mdo_storage_tank' => $data['mdo_storage_tank'],
                'mdo_service_tank' => $data['mdo_service_tank'],
                'igg_fuel_tank' => $data['igg_fuel_tank'],
                'rpm_me' => $data['rpm_me'],
            ]
        ];
    }
}