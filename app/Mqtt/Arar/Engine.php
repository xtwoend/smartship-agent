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

        $d0 = $collection->firstWhere('id', 'arar_engine.arar_me.New PLC 1.d0');
        $d0 = isset($d0['v']) && is_string($d0['v']) ? Json::decode($d0['v']) : [];

        $d55 = $collection->firstWhere('id', 'arar_engine.arar_me.New PLC 1.d55');
        $d55 = isset($d55['v']) && is_string($d55['v']) ? Json::decode($d55['v']) : [];

        $d400 = $collection->firstWhere('id', 'arar_engine.arar_me.New PLC 1.d400');
        $d400 = isset($d400['v']) && is_string($d400['v']) ? Json::decode($d400['v']) : [];

        $d500 = $collection->firstWhere('id', 'arar_engine.arar_me.New PLC 1.d500');
        $d500 = isset($d500['v']) && is_string($d500['v']) ? Json::decode($d500['v']) : [];
       
        if(! empty($d0)) {
            $d0 = [
                // D0
                "me_rev_speed_con_value" => $d0[0] ?? 0,
                "tc_rev_speed_con_value" => $d0[1] ?? 0,
                "me_fo_rack_con_value" => $d0[2] ?? 0,
                "propeller_rev_con_value" => $d0[3] ?? 0,
                "me_lo_press_con_value" => $d0[4] ?? 0,
                "me_fo_press_con_value" => $d0[5] ?? 0,
                "me_h_temp_fw_press_con_value" => $d0[6] ?? 0,
                "booster_air_pressure_con_value" => $d0[7] ?? 0,
                "control_air_pressure_con_value" => $d0[8] ?? 0,
                "me_lo_inlet_temp_con_value" => $d0[9] ?? 0,
                "me_fw_high_temp_outlet_temp_con_value" => $d0[10] ?? 0,
                "me_booster_air_emp_con_value" => $d0[11] ?? 0,
                "me_exh_no1_cyl_temp_con_value" => $d0[12] ?? 0,
                "me_exh_no2_cyl_temp_con_value" => $d0[13] ?? 0,
                "me_exh_no3_cyl_temp_con_value" => $d0[14] ?? 0,
                "me_exh_no4_cyl_temp_con_value" => $d0[15] ?? 0,
                "me_exh_no5_cyl_temp_con_value" => $d0[16] ?? 0,
                "me_exh_no6_cyl_temp_con_value" => $d0[17] ?? 0,
                "me_exh_no7_cyl_temp_con_value" => $d0[18] ?? 0,
                "me_exh_no8_cyl_temp_con_value" => $d0[19] ?? 0,
                "tc_exh_in_temp1_con_value" => $d0[20] ?? 0,
                "tc_exh_in_temp2_con_value" => $d0[21] ?? 0,
                "tc_exh_out_temp_con_value" => $d0[22] ?? 0,
            ];
        }

        if(! empty($d55)) {
            $d55 = [
                // D55
                "exh_temp_set" => $d55[0] ?? 0,
                "deviation_high_set" => $d55[1] ?? 0,
                "deviation_low_set" => $d55[2] ?? 0,
            ];
        }

        if(! empty($d400)) {
            $d400 = [
                // D400
                "me_rev_speed_set_high" => $d400[0] ?? 0,
                "tc_rev_speed_set_high" => $d400[1] ?? 0,
                "me_fo_rack_set_high" => $d400[2] ?? 0,
                "propeller_rev_set_high" => $d400[3] ?? 0,
                "me_lo_press_set_high" => $d400[4] ?? 0,
                "me_fo_press_set_high" => $d400[5] ?? 0,
                "me_h_temp_fw_press_set_high" => $d400[6] ?? 0,
                "booster_air_pressure_set_high" => $d400[7] ?? 0,
                "control_air_pressure_set_high" => $d400[8] ?? 0,
                "me_lo_inlet_temp_set_high" => $d400[9] ?? 0,
                "me_fw_high_temp_outlet_temp_set_high" => $d400[10] ?? 0,
                "me_booster_air_emp_set_high" => $d400[11] ?? 0,
                "me_exh_no1_cyl_temp_set_high" => $d400[12] ?? 0,
                "me_exh_no2_cyl_temp_set_high" => $d400[13] ?? 0,
                "me_exh_no3_cyl_temp_set_high" => $d400[14] ?? 0,
                "me_exh_no4_cyl_temp_set_high" => $d400[15] ?? 0,
                "me_exh_no5_cyl_temp_set_high" => $d400[16] ?? 0,
                "me_exh_no6_cyl_temp_set_high" => $d400[17] ?? 0,
                "me_exh_no7_cyl_temp_set_high" => $d400[18] ?? 0,
                "me_exh_no8_cyl_temp_set_high" => $d400[19] ?? 0,
                "tc_exh_in_temp1_set_high" => $d400[20] ?? 0,
                "tc_exh_in_temp2_set_high" => $d400[21] ?? 0,
                "tc_exh_out_temp_set_high" => $d400[22] ?? 0,
            ];
        }

        if(! empty($d500)) {
            $d500 = [
                // D500
                "me_rev_speed_set_low" => $d500[0] ?? 0,
                "tc_rev_speed_set_low" => $d500[1] ?? 0,
                "me_fo_rack_set_low" => $d500[2] ?? 0,
                "propeller_rev_set_low" => $d500[3] ?? 0,
                "me_lo_press_set_low" => $d500[4] ?? 0,
                "me_fo_press_set_low" => $d500[5] ?? 0,
                "me_h_temp_fw_press_set_low" => $d500[6] ?? 0,
                "booster_air_pressure_set_low" => $d500[7] ?? 0,
                "control_air_pressure_set_low" => $d500[8] ?? 0,
                "me_lo_inlet_temp_set_low" => $d500[9] ?? 0,
                "me_fw_high_temp_outlet_temp_set_low" => $d500[10] ?? 0,
                "me_booster_air_emp_set_low" => $d500[11] ?? 0,
                "me_exh_no1_cyl_temp_set_low" => $d500[12] ?? 0,
                "me_exh_no2_cyl_temp_set_low" => $d500[13] ?? 0,
                "me_exh_no3_cyl_temp_set_low" => $d500[14] ?? 0,
                "me_exh_no4_cyl_temp_set_low" => $d500[15] ?? 0,
                "me_exh_no5_cyl_temp_set_low" => $d500[16] ?? 0,
                "me_exh_no6_cyl_temp_set_low" => $d500[17] ?? 0,
                "me_exh_no7_cyl_temp_set_low" => $d500[18] ?? 0,
                "me_exh_no8_cyl_temp_set_low" => $d500[19] ?? 0,
                "tc_exh_in_temp1_set_low" => $d500[20] ?? 0,
                "tc_exh_in_temp2_set_low" => $d500[21] ?? 0,
                "tc_exh_out_temp_set_low" => $d500[22] ?? 0,
            ];
        }

        $collectData = array_merge($d0, $d55, $d400, $d500, [
            'terminal_time' => Carbon::parse($timestamp)->format('Y-m-d H:i:s'),
        ]);
       
        return [
            'engine' => $collectData
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

    protected $mappD0Array = [
        'ME_REV_SPEED_CON_VALUE',
        'TC_REV_SPEED_CON_VALUE',
        'ME_FO_RACK_CON_VALUE',
        'PROPELLER_REV_CON_VALUE',
        'ME_LO_PRESS_CON_VALUE',
        'ME_FO_PRESS_CON_VALUE',
        'ME_H_TEMP_FW_PRESS_CON_VALUE',
        'BOOSTER_AIR_PRESSURE_CON_VALUE',
        'CONTROL_AIR_PRESSURE_CON_VALUE',
        'ME_LO_INLET_TEMP_CON_VALUE',
        'ME_FW_HIGH_TEMP_OUTLET_TEMP_CON_VALUE',
        'ME_BOOSTER_AIR_EMP_CON_VALUE',
        'ME_EXH_NO1_CYL_TEMP_CON_VALUE',
        'ME_EXH_NO2_CYL_TEMP_CON_VALUE',
        'ME_EXH_NO3_CYL_TEMP_CON_VALUE',
        'ME_EXH_NO4_CYL_TEMP_CON_VALUE',
        'ME_EXH_NO5_CYL_TEMP_CON_VALUE',
        'ME_EXH_NO6_CYL_TEMP_CON_VALUE',
        'ME_EXH_NO7_CYL_TEMP_CON_VALUE',
        'ME_EXH_NO8_CYL_TEMP_CON_VALUE',
        'TC_EXH_IN_TEMP1_CON_VALUE',
        'TC_EXH_IN_TEMP2_CON_VALUE',
        'TC_EXH_OUT_TEMP_CON_VALUE',
    ];


    protected $mappD55Array = [
        'EXH TEMP SET',
        'DEVIATION HIGH SET',
        'DEVIATION LOW SET',
    ];

    protected $mappD400Array = [
        'ME_REV_SPEED_SET_HIGH',
        'TC_REV_SPEED_SET_HIGH',
        'ME_FO_RACK_SET_HIGH',
        'PROPELLER_REV_SET_HIGH',
        'ME_LO_PRESS_SET_HIGH',
        'ME_FO_PRESS_SET_HIGH',
        'ME_H_TEMP_FW_PRESS_SET_HIGH',
        'BOOSTER_AIR_PRESSURE_SET_HIGH',
        'CONTROL_AIR_PRESSURE_SET_HIGH',
        'ME_LO_INLET_TEMP_SET_HIGH',
        'ME_FW_HIGH_TEMP_OUTLET_TEMP_SET_HIGH',
        'ME_BOOSTER_AIR_EMP_SET_HIGH',
        'ME_EXH_NO1_CYL_TEMP_SET_HIGH',
        'ME_EXH_NO2_CYL_TEMP_SET_HIGH',
        'ME_EXH_NO3_CYL_TEMP_SET_HIGH',
        'ME_EXH_NO4_CYL_TEMP_SET_HIGH',
        'ME_EXH_NO5_CYL_TEMP_SET_HIGH',
        'ME_EXH_NO6_CYL_TEMP_SET_HIGH',
        'ME_EXH_NO7_CYL_TEMP_SET_HIGH',
        'ME_EXH_NO8_CYL_TEMP_SET_HIGH',
        'TC_EXH_IN_TEMP1_SET_HIGH',
        'TC_EXH_IN_TEMP2_SET_HIGH',
        'TC_EXH_OUT_TEMP_SET_HIGH',
    ];

    protected $mappD500Array = [
        'ME_REV_SPEED_SET_LOW',
        'TC_REV_SPEED_SET_LOW',
        'ME_FO_RACK_SET_LOW',
        'PROPELLER_REV_SET_LOW',
        'ME_LO_PRESS_SET_LOW',
        'ME_FO_PRESS_SET_LOW',
        'ME_H_TEMP_FW_PRESS_SET_LOW',
        'BOOSTER_AIR_PRESSURE_SET_LOW',
        'CONTROL_AIR_PRESSURE_SET_LOW',
        'ME_LO_INLET_TEMP_SET_LOW',
        'ME_FW_HIGH_TEMP_OUTLET_TEMP_SET_LOW',
        'ME_BOOSTER_AIR_EMP_SET_LOW',
        'ME_EXH_NO1_CYL_TEMP_SET_LOW',
        'ME_EXH_NO2_CYL_TEMP_SET_LOW',
        'ME_EXH_NO3_CYL_TEMP_SET_LOW',
        'ME_EXH_NO4_CYL_TEMP_SET_LOW',
        'ME_EXH_NO5_CYL_TEMP_SET_LOW',
        'ME_EXH_NO6_CYL_TEMP_SET_LOW',
        'ME_EXH_NO7_CYL_TEMP_SET_LOW',
        'ME_EXH_NO8_CYL_TEMP_SET_LOW',
        'TC_EXH_IN_TEMP1_SET_LOW',
        'TC_EXH_IN_TEMP2_SET_LOW',
        'TC_EXH_OUT_TEMP_SET_LOW',
    ];
}