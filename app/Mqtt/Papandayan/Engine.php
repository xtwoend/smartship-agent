<?php

namespace App\Mqtt\Papandayan;

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
                'terminal_time' => Carbon::parse($data['_terminalTime'])->format('Y-m-d H:i:s'),
                'me_control_air_inlet_pressure' => (float) $data['me_control_air_inlet_pressure'],
                'me_fo_inlet_pressure' => (float) $data['me_fo_inlet_pressure'],
                'tc_lo_inlet_pressure' => (float) $data['tc_lo_inlet_pressure'],
                'me_air_cooler_cw_inlet_pressure' => (float) $data['me_air_cooler_cw_inlet_pressure'],
                'main_lo_pco_inlet_pressure' => (float) $data['main_lo_pco_inlet_pressure'],
                'jcw_inlet_pressure' => (float) $data['jcw_inlet_pressure'],
                'me_starting_air_pressure' => (float) $data['me_starting_air_pressure'],
                'me_scavenging_air_pressure' => (float) $data['me_scavenging_air_pressure'],
                'no1_dg_lo_inlet_pressure' => (float) $data['no1_dg_lo_inlet_pressure'],
                'no2_dg_lo_inlet_pressure' => (float) $data['no2_dg_lo_inlet_pressure'],
                'no3_dg_lo_inlet_pressure' => (float) $data['no3_dg_lo_inlet_pressure'],
            ]
        ];
    }
}