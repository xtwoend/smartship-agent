<?php

namespace App\Mqtt\Panderman;

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
                'terminal_time' =>  Carbon::now()->format('Y-m-d H:i:s'),
                'control_air_inlet_pressure' => $data['control_air_inlet_pressure'],
                'me_fo_inlet_pressure' => $data['me_fo_inlet_pressure'],
                'tc_lo_inlet_pressure' => $data['tc_lo_inlet_pressure'],
                'me_air_cooler_cw_inlet_pressure' => $data['me_air_cooler_cw_inlet_pressure'],
                'main_lo_pco_inlet_pressure' => $data['main_lo_pco_inlet_pressure'],
                'jcw_inlet_pressure' => $data['jcw_inlet_pressure'],
                'me_starting_air_pressure' => $data['me_starting_air_pressure'],
                'me_scavenging_air_pressure' => $data['me_scavenging_air_pressure'],
                'no1_ge_lo_inlet_pressure' => $data['no1_ge_lo_inlet_pressure'],
                'no2_ge_lo_inlet_pressure' => $data['no2_ge_lo_inlet_pressure'],
                'no3_ge_lo_inlet_pressure' => $data['no3_ge_lo_inlet_pressure'],
                'no1_ge_cooling_fw_inlet_pressure' => $data['no1_ge_cooling_fw_inlet_pressure'],
            ]
        ];
    }
}