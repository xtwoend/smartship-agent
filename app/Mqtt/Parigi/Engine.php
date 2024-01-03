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
       
        return  [
            'engine' => [
                'terminal_time' => Carbon::now()->format('Y-m-d H:i:s'),
                'no1_ge_fo_inlet_press_low' => (float) $data['no1_ge_fo_inlet_press_low'],
                'me_jacket_cfw_inlet_press' => (float) $data['me_jacket_cfw_inlet_press'],
                'no2_ge_cfw_inlet_press_low' => (float) $data['no2_ge_cfw_inlet_press_low'],
                'starting_air_press_ecr' => (float) $data['starting_air_press_ecr'],
                'starting_air_press_low' => (float) $data['starting_air_press_low'],
                'tc_lo_inlet_press_low' => (float) $data['tc_lo_inlet_press_low'],
                'mlo_pco_inlet_press_ecr' => (float) $data['mlo_pco_inlet_press_ecr'],
                'fo_inlet_press_low' => (float) $data['fo_inlet_press_low'],
                'me_air_cooler_cw_inlet_press' => (float) $data['me_air_cooler_cw_inlet_press'],
                'no1_ge_lo_inlet_press' => (float) $data['no1_ge_lo_inlet_press'],
                'no2_ge_lo_inlet_press' => (float) $data['no2_ge_lo_inlet_press'],
                'no3_ge_lo_inlet_press' => (float) $data['no3_ge_lo_inlet_press']
            ]
        ];
    }
}