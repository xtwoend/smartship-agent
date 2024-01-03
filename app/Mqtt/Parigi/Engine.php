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
                'no1_ge_fo_inlet_press_low' => (float) ($data['no1_ge_fo_inlet_press_low'] / 100),
                'me_jacket_cfw_inlet_press' => (float) ($data['me_jacket_cfw_inlet_press'] / 100),
                'no2_ge_cfw_inlet_press_low' => (float) ($data['no2_ge_cfw_inlet_press_low'] / 100),
                'starting_air_press_ecr' => (float) ($data['starting_air_press_ecr'] / 100),
                'starting_air_press_low' => (float) ($data['starting_air_press_low'] / 100),
                'tc_lo_inlet_press_low' => (float) ($data['tc_lo_inlet_press_low'] / 100),
                'mlo_pco_inlet_press_ecr' => (float) ($data['mlo_pco_inlet_press_ecr'] / 100),
                'fo_inlet_press_low' => (float) ($data['fo_inlet_press_low'] / 100),
                'me_air_cooler_cw_inlet_press' => (float) ($data['me_air_cooler_cw_inlet_press'] / 100),
                'no1_ge_lo_inlet_press' => (float) ($data['no1_ge_lo_inlet_press'] / 100),
                'no2_ge_lo_inlet_press' => (float) ($data['no2_ge_lo_inlet_press'] / 100),
                'no3_ge_lo_inlet_press' => (float) ($data['no3_ge_lo_inlet_press'] / 100),
            ]
        ];
    }
}