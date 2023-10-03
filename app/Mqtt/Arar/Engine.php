<?php

namespace App\Mqtt\Arar;

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
        $values = $data['values'];
        $collection = collect($values);
        $timestamp = Carbon::now()->format('Y-m-d H:i:s'); //$data['timestamp'];

        $d100 = $collection->firstWhere('id', 'cj2m.Device1.New PLC 1.d100');
        $d100 = isset($d100['v']) && is_string($d100['v']) ? Json::decode($d100['v']) : [];
       
        if(empty($d100)) {
            return [
                'engine' => []
            ];
        }
       
        return [
            'engine' => [
                'terminal_time' => Carbon::parse($timestamp)->format('Y-m-d H:i:s'),
                'no_1_generator_winding_u_phase_value' => (float) $data[0],
                'no_1_generator_winding_v_phase_value' => (float) $data[1],
                'no_1_generator_winding_w_phase_value' => (float) $data[2],
                'stern_shaft_aft_bearing_temp_value' => (float) $data[3],
                'no_2_generator_winding_v_phase_value' => (float) $data[4],
                'no_2_generator_winding_w_phase_value' => (float) $data[5],
                'no_2_generator_winding_u_phase_value' => (float) $data[6],
                'no_3_generator_winding_u_phase_value' => (float) $data[7],
                'no_3_generator_winding_v_phase_value' => (float) $data[8],
                'no_3_generator_winding_w_phase_value' => (float) $data[9],
                'no_1_generator_ht_fw_outlet_temp_value' => (float) $data[10],
                'no_2_generator_ht_fw_outlet_temp_value' => (float) $data[11],
                'no_3_generator_ht_fw_outlet_temp_value' => (float) $data[12],
                'stern_shaft_intermediat_bearing_temp_value' => (float) $data[13],
                'no_1_generator_exh_gas_tc_outlet_temp_value' => (float) $data[14],
                'no_2_generator_exh_gas_tc_outlet_temp_value' => (float) $data[15],
                'no_3_generator_exh_gas_tc_outlet_temp_value' => (float) $data[16],
                'generator_ht_fw_pressure_value' => (float) $data[17],
                'no_1_generator_lo_press_value' => (float) $data[18],
                'no_2_generator_ht_fw_press_value' => (float) $data[19],
                'no_2_generator_lo_press_value' => (float) $data[20],
                'no_3_generator_ht_fw_press_value' => (float) $data[21],
                'no_3_generator_lo_press_value' => (float) $data[22],
                'hsd_stor_tank_p_level_value' => (float) $data[23],
                'hsd_stor_tank_s_level_value' => (float) $data[24],
            ]
        ];

    }

    function arrayToSnake() : array {
        $snake = [];
        foreach($this->mappArray as $in => $val) {
            if(is_null($val)) continue;
            $key = Str::snake(strtolower($val));
            $snake[$key] = $in;
        } 
        return $snake;
    }

    protected $mappArray = [
        'NO_1_GENERATOR_WINDING_U_PHASE_VALUE',
        'NO_1_GENERATOR_WINDING_V_PHASE_VALUE',
        'NO_1_GENERATOR_WINDING_W_PHASE_VALUE',
        'STERN_SHAFT_AFT_BEARING_TEMP_VALUE',
        'NO_2_GENERATOR_WINDING_V_PHASE_VALUE',
        'NO_2_GENERATOR_WINDING_W_PHASE_VALUE',
        'NO_2_GENERATOR_WINDING_U_PHASE_VALUE',
        'NO_3_GENERATOR_WINDING_U_PHASE_VALUE',
        'NO_3_GENERATOR_WINDING_V_PHASE_VALUE',
        'NO_3_GENERATOR_WINDING_W_PHASE_VALUE',
        'NO_1_GENERATOR_HT_FW_OUTLET_TEMP_VALUE',
        'NO_2_GENERATOR_HT_FW_OUTLET_TEMP_VALUE',
        'NO_3_GENERATOR_HT_FW_OUTLET_TEMP_VALUE',
        'STERN_SHAFT_INTERMEDIAT_BEARING_TEMP_VALUE',
        'NO_1_GENERATOR_EXH_GAS_TC_OUTLET_TEMP_VALUE',
        'NO_2_GENERATOR_EXH_GAS_TC_OUTLET_TEMP_VALUE',
        'NO_3_GENERATOR_EXH_GAS_TC_OUTLET_TEMP_VALUE',
        'GENERATOR_HT_FW_PRESSURE_VALUE',
        'NO_1_GENERATOR_LO_PRESS_VALUE',
        'NO_2_GENERATOR_HT_FW_PRESS_VALUE',
        'NO_2_GENERATOR_LO_PRESS_VALUE',
        'NO_3_GENERATOR_HT_FW_PRESS_VALUE',
        'NO_3_GENERATOR_LO_PRESS_VALUE',
        'HSD_STOR_TANK_P_LEVEL_VALUE',
        'HSD_STOR_TANK_S_LEVEL_VALUE',
    ];
}