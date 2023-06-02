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
        
        /**
         * "me_tc_rpm_indicator": "14337.6",
            "ai_hfo_bunker": "0",
            "ai_fwd_hfo_bunker": "0",
            "ai_ls_hfo_bunker": "0",
            "ai_hfo_service": "0.147425",
            "ai_hfo_settling": "0",
            "ai_ls_hfo_settling": "0",
            "ai_mdo_storage": "0",
            "ai_mdo_service": "0",
            "ai_igg_fuel": "0",
            "me_fo_inlet_engine": "7.2",
            "me_lo_inlet_press": "2.1",
            "me_scav_air_inlet_press": "3.4",
            "me_jcfw_inlet_press": "3.8",
            "me_starting_air_inlet_press": "0",
            "me_cont_air_inlet_press": "0",
            "hfo_bunker_tank": "0",
            "fwd_hfo_bunker_tank": "0",
            "ls_hfo_bunker_tank": "0",
            "hfo_service_tank": "0",
            "ls_hfo_service_tank": "0",
            "hfo_settling_tank": "0",
            "ls_hfo_settling_tank": "0",
            "mdo_storage_tank": "0",
            "mdo_service_tank": "0",
            "igg_fuel_tank": "0",
            "rpm_me": "11"
         */

        return [
            'engine' => [
                'terminal_time' => (string) $data['_terminalTime'] ?: Carbon::now()->format('Y-m-d H:i:s'),
                'control_air_inlet' => (float) 0,
                'me_ac_cw_inlet_cooler' => (float) $data['me_jcfw_inlet_press'] ?: 0,
                'jcw_inlet' => (float) $data['me_jcfw_inlet_press'] ?: 0,
                'me_lo_inlet' => (float) $data['me_lo_inlet_press'] ?: 0,
                'scav_air_receiver' => (float) $data['me_scav_air_inlet_press'] ?: 0,
                'start_air_inlet' => (float) $data['me_starting_air_inlet_press'] ?: 0,
                'main_lub_oil' => (float) 0,
                'me_fo_inlet_engine' => (float) $data['me_fo_inlet_engine'] ?: 0,
                'turbo_charger_speed_no_1' => (float) $data['me_tc_rpm_indicator'] ?: 0,
                'turbo_charger_speed_no_2' => (float) 0,
                'turbo_charger_speed_no_3' => (float) 0,
                'tachometer_turbocharge' => (float) $data['me_tc_rpm_indicator'] ?: 0,
                'main_engine_speed' => (float) isset($data['rpm_me'])? $data['rpm_me'] : 0,
            ]
        ];
    }
}