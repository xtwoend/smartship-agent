<?php

namespace App\Mqtt\Kasim;

use Carbon\Carbon;
use Hyperf\Utils\Str;
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
                'me_ht_water_temp_air_cooler_inlet' => $data['TE1102'],
                'me_ht_water_temp_cyl_row_inlet' => $data['TE1103'],
                'me_lube_oil_temp_cooler_inlet' => $data['TE1222'],
                'me_lube_oil_temp_engine_inlet' => $data['TE1224'],
                'me_exhaust_gat_temp_cyl1_a' => $data['TE1601A'],
                'me_exhaust_gat_temp_cyl2_a' => $data['TE1602A'],
                'me_exhaust_gat_temp_cyl3_a' => $data['TE1603A'],
                'me_exhaust_gat_temp_cyl4_a' => $data['TE1604A'],
                'me_exhaust_gat_temp_cyl5_a' => $data['TE1605A'],
                'me_exhaust_gat_temp_cyl6_a' => $data['TE1606A'],
                'me_exhaust_gat_temp_cyl7_a' => $data['TE1607A'],
                'me_exhaust_gat_temp_cyl8_a' => $data['TE1608A'],
                'me_exhaust_gas_temp_tc_inlet' => $data['TE1621'],
                'me_exhaust_gas_temp_tc_outlet' => $data['TE1622'],
                'me_ht_water_pressure' => $data['PT1102A'],
                'me_ht_water_temp_cyl_row_outlet' => $data['TE1104A'],
                'me_exhaust_gat_temp_cyl1_b' => $data['TE1601B'],
                'me_exhaust_gat_temp_cyl2_b' => $data['TE1602B'],
                'me_exhaust_gat_temp_cyl3_b' => $data['TE1603B'],
                'me_exhaust_gat_temp_cyl4_b' => $data['TE1604B'],
                'me_exhaust_gat_temp_cyl5_b' => $data['TE1605B'],
                'me_exhaust_gat_temp_cyl6_b' => $data['TE1606B'],
                'me_exhaust_gat_temp_cyl7_b' => $data['TE1607B'],
                'me_exhaust_gat_temp_cyl8_b' => $data['TE1608B'],
                'me_ht_water_pressure2' => $data['PT1102B'],
                'me_ht_water_temp_cyl_row_outlet2' => $data['TE1104B']
            ]
        ];

    }

    function arrayToSnake($arrayName) : array {
        $snake = [];
        foreach($this->{$arrayName} as $in => $val) {
            if(is_null($val)) continue;
            $key = Str::snake(strtolower($val));
            $snake[$key] = $in;
        } 
        return $snake;
    }

    protected $engine = [
        'ME HT Water Temp Air Cooler Inlet', 
        'ME HT Water Temp Cyl Row Inlet',
        'ME Lube Oil Temp Cooler Inlet',
        'ME Lube Oil Temp Engine Inlet',
        'ME Exhaust Gat Temp Cyl 1 A',
        'ME Exhaust Gat Temp Cyl 2 A',
        'ME Exhaust Gat Temp Cyl 3 A',
        'ME Exhaust Gat Temp Cyl 4 A',
        'ME Exhaust Gat Temp Cyl 5 A',
        'ME Exhaust Gat Temp Cyl 6 A',
        'ME Exhaust Gat Temp Cyl 7 A',
        'ME Exhaust Gat Temp Cyl 8 A',
        'ME Exhaust Gas Temp TC Inlet',
        'ME Exhaust Gas Temp TC Outlet',
        'ME HT Water Pressure',
        'ME HT Water Temp Cyl Row Outlet',
        'ME Exhaust Gat Temp Cyl 1 B',
        'ME Exhaust Gat Temp Cyl 2 B',
        'ME Exhaust Gat Temp Cyl 3 B',
        'ME Exhaust Gat Temp Cyl 4 B',
        'ME Exhaust Gat Temp Cyl 5 B',
        'ME Exhaust Gat Temp Cyl 6 B',
        'ME Exhaust Gat Temp Cyl 7 B',
        'ME Exhaust Gat Temp Cyl 8 B',
        'ME HT Water Pressure 2',
        'ME HT Water Temp Cyl Row Outlet 2',
    ];
}