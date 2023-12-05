<?php

namespace App\Mqtt\Kasim;

use Carbon\Carbon;
use Hyperf\Utils\Str;
use Hyperf\Utils\Codec\Json;

class Cargo
{
    protected string $message;

    public function __construct(string $message) {
       
        $this->message = $message;
    }
    
    public function extract()
    {
        $data = Json::decode($this->message);

        $sensors = [];
        foreach($data['values'] as $val) {
            $id = str_replace('plc.cop.q02h.', '', $val['id']);
            $sensors[$id] = (float) $val['v'];
        }
        
        return [
            'cargo' => [
                'cargo_timestamp' => Carbon::now()->format('Y-m-d H:i:s'),
                'bp1_casing_temp' => $sensors['bp1_casing_temp'],
                'bp1_transmission_brg_temp' => $sensors['bp1_transmission_brg_temp'],
                'bp1_drive_end_bearing_temp' => $sensors['bp1_drive_end_bearing_temp'],
                'bp1_nondrive_end_bearing_temp' => $sensors['bp1_nondrive_end_bearing_temp'],
                'bp1_transmission_seal_temp' => $sensors['bp1_transmission_seal_temp'],
                'bp2_drive_end_bearing_temp' => $sensors['bp2_drive_end_bearing_temp'],
                'bp2_casing_temp' => $sensors['bp2_casing_temp'],
                'bp2_transmission_brg_temp' => $sensors['bp2_transmission_brg_temp'],
                'bp2_nondrive_end_bearing_temp' => $sensors['bp2_nondrive_end_bearing_temp'],
                'bp2_transmission_seal_temp' => $sensors['bp2_transmission_seal_temp'],
                'cp1_casing_temp' => $sensors['cp1_casing_temp'],
                'cp1_bearing_temp' => $sensors['cp1_bearing_temp'],
                'cp1_transmission_brg_temp' => $sensors['cp1_transmission_brg_temp'],
                'cp1_discharge_pressure' => $sensors['cp1_discharge_pressure'],
                'cp1_transmission_seal_temp' => $sensors['cp1_transmission_seal_temp'],
                'cp2_casing_temp' => $sensors['cp2_casing_temp'],
                'cp2_bearing_temp' => $sensors['cp2_bearing_temp'],
                'cp2_transmission_brg_temp' => $sensors['cp2_transmission_brg_temp'],
                'cp2_discharge_pressure' => $sensors['cp2_discharge_pressure'],
                'cp2_transmission_seal_temp' => $sensors['cp2_transmission_seal_temp'],
                'cp3_bearing_temp' => $sensors['cp3_bearing_temp'],
                'cp3_casing_temp' => $sensors['cp3_casing_temp'],
                'cp3_discharge_pressure' => $sensors['cp3_discharge_pressure'],
                'cp3_transmission_brg_temp' => $sensors['cp3_transmission_brg_temp'],
                'cp3_transmission_seal_temp' => $sensors['cp3_transmission_seal_temp'],
                'sp1_discharge_pressure' => $sensors['sp1_discharge_pressure'],
                'sp1_drive_end_bearing_temp' => $sensors['sp1_drive_end_bearing_temp'],
                'sp1_casing_temp' => $sensors['sp1_casing_temp'],
                'sp1_nondrive_end_bearing_temp' => $sensors['sp1_nondrive_end_bearing_temp'],
                'sp1_transmission_brg_temp' => $sensors['sp1_transmission_brg_temp'],
                'sp2_casing_temp' => $sensors['sp2_casing_temp'],
                'sp1_transmission_seal_temp' => $sensors['sp1_transmission_seal_temp'],
                'sp2_discharge_pressure' => $sensors['sp2_discharge_pressure'],
                'sp2_drive_end_bearing_temp' => $sensors['sp2_drive_end_bearing_temp'],
                'sp2_nondrive_end_bearing_temp' => $sensors['sp2_nondrive_end_bearing_temp'],
                'sp2_transmission_brg_temp' => $sensors['sp2_transmission_brg_temp'],
                'sp2_transmission_seal_temp' => $sensors['sp2_transmission_seal_temp'],
                'tcp_casing_temp' => $sensors['tcp_casing_temp'],
                'tcp_discharge_pressure' => $sensors['tcp_discharge_pressure'],
                'tcp_nondrive_end_bearing_temp' => $sensors['tcp_nondrive_end_bearing_temp'],
                'tcp_drive_end_bearing_temp' => $sensors['tcp_drive_end_bearing_temp'],
                'tcp_transmission_brg_temp' => $sensors['tcp_transmission_brg_temp'],
                'tcp_transmission_seal_temp' => $sensors['tcp_transmission_seal_temp'],
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
        
    ];
}