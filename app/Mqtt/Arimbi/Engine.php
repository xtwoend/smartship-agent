<?php

namespace App\Mqtt\Arimbi;

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

        $d100 = $collection->firstWhere('id', 'plc.cj2m.cj2m.D100');
        // $d400 = $collection->firstWhere('id', 'plc.cj2m.cj2m.D400');

        $d100 = isset($d100['v']) && is_string($d100['v']) ? Json::decode($d100['v']) : [];
        
        if(empty($d100)) {
            return [
                'engine' => []
            ];
        }
        
        return [
            'engine' => [
                'terminal_time' => $data['timestamp'] ?: Carbon::now()->format('Y-m-d H:i:s'),
                "dg1_u_phase_temp" => $d100[1],
                "dg1_v_phase_temp" => $d100[2],
                "dg1_w_phase_temp" => $d100[3],
                "dg1_htfw_cool_temp" => $d100[4],
                "me_rpm" => $d100[5],
                "dg1_cyl1_3_temp" => $d100[6],
                "exh_gas_tc_aft_tc" => $d100[7],
                "dg1_charge_air_out_temp" => $d100[8],
                "dg2_u_winding_temp" => $d100[9],
                "dg2_v_winding_temp" => $d100[10],
                "dg2_w_winding_temp" => $d100[11],
                "dg2_htcfw_temp" => $d100[12],
                "me_shaft_rpm" => $d100[13],
                "tc_lo_temp" => $d100[14],
                "htcw_temp_eng_out" => $d100[15],
                "dg2_charge_air_out_temp" => $d100[16],
                "dg3_u_winding_temp" => $d100[17],
                "dg3_v_winding_temp" => $d100[18],
                "dg3_w_winding_temp" => $d100[19],
                "dg3__htcdw_temp" => $d100[20],
                "dg3_lo_temp" => $d100[21],
                "me_lo_temp" => $d100[22],
                "me_lo_pressure" => $d100[23],
                "dg3_charge_air_out_temp" => $d100[24],
                "dg1_htfw_pressure" => $d100[25],
                "dg1_lo_in_pressure" => $d100[26],
                "dg2_htfw_in_pressure" => $d100[27],
                "dg2_lo_in_pressure" => $d100[28],
                "dg3_htfw_in_pressure" => $d100[29],
                "dg3_lo_in_pressure" => $d100[30],
                "nozzle_cw_temp.beofre_engine" => $d100[31],
                "intake_air_temp_before_compressor" => $d100[32],
                "change_air_temp_inlet_engine_temp" => $d100[33],
                "htcw_temp_before_intercooler" => $d100[34],
                "ltc_water_temp_before_intercooler" => $d100[35],
                "fuel_temp_before_engine" => $d100[36],
                "charge_air_temp_after_compresor_tc" => $d100[37],
                "me_htcw_temp_before_engine" => $d100[38],
                "nzzle_cool_water_pressure" => $d100[39],
                "ltc_water_before_intercooler_pressure" => $d100[40],
                "fuel_pressure_before_engine" => $d100[41],
                "emergency_cut_off_air_pressure" => $d100[42],
                "control_air_pressure" => $d100[43],
                "me_cyl_temp_1" => $d100[44],
                "me_exh_temp_cyl_2" => $d100[45],
                "me_exh_temp_cyl_3" => $d100[46],
                "me_exh_cyl_4" => $d100[47],
                "me_exh_cyl_5" => $d100[48],
                "me_exh_cyl_6" => $d100[49],
                "me_exh_before_tc" => $d100[50],
                "me_exh_after_tc" => $d100[51],
                "exh_gas_temp_dg2" => $d100[52],
                "exh_gas_temp_dg3" => $d100[53],
                "air_low_press_dg0_16_bar" => $d100[54],
                "winding_temp_r_shaft_tg" => $d100[55],
                "winding_temp_s_shaft_tg" => $d100[56],
                "winding_temp_t_shaft_tg" => $d100[57],
                "winding_temp_r_syncro" => $d100[58],
                "winding_temp_s_syncro" => $d100[59],
                "winding_temp_t_syncro" => $d100[60],
                "dg_1_bearing_temp" => $d100[61],
                "dg_2_bearing_temp" => $d100[62],
                "dg_3_bearing_temp" => $d100[63],
                "temp_below_piston1_80" => $d100[65],
                "temp_below_piston1_120" => $d100[66],
                "temp_below_pist2_80" => $d100[67],
                "temp_below_piston2_120" => $d100[68],
                "temp_below_piston3_80" => $d100[69],
                "temp_below_piston3_120_sub" => $d100[70],
                "temp_below_piston4_80" => $d100[71],
                "temp_below_piston4_120" => $d100[72],
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
        NULL,
        'DG1_U PHASE TEMP',
        'DG1 V PHASE TEMP',
        'DG1_W PHASE TEMP',
        'DG1_HTFW COOL TEMP',
        'ME RPM',
        'DG1_CYL1_3 TEMP',
        'EXH GAS TC _Aft TC',
        'DG1_CHARGE AIR OUT TEMP',
        'DG2_U WINDING TEMP',
        'DG2_V WINDING TEMP',
        'DG2_W WINDING TEMP',
        'DG2_HTCFW TEMP',
        'ME SHAFT RPM',
        'TC LO Temp',
        'HTCW TEMP ENG OUT',
        'DG2_CHARGE AIR OUT TEMP',
        'DG3_U WINDING TEMP',
        'dG3_V WINDING TEMP',
        'DG3_W WINDING TEMP',
        'DG3_ HTCDW TEMP',
        'DG3_LO TEMP',
        'ME LO Temp',
        'ME LO Pressure',
        'DG3 CHARGE AIR OUT TEMP',
        'DG1_HTFW PRESSURE',
        'DG1_LO IN PRESSURE',
        'DG2_HTFW IN PRESSURE',
        'DG2_LO IN PRESSURE',
        'DG3_HTFW IN PRESSURE',
        'DG3_LO IN PRESSURE',
        'NOZZLE CW TEMP.BEOFRE ENGINE',
        'INTAKE AIR TEMP BEFORE COMPRESSOR',
        'CHANGE AIR TEMP _INLET ENGINE TEMP',
        'HTCW TEMP BEFORE INTERCOOLER',
        'LTC WATER TEMP BEFORE INTERCOOLER',
        'FUEL TEMP BEFORE ENGINE',
        'CHARGE AIR TEMP AFTER COMPRESOR TC',
        'ME HTCW TEMP _BEFORE ENGINE',
        'NZZLE COOL WATER PRESSURE',
        'LTC WATER BEFORE INTERCOOLER PRESSURE',
        'FUEL PRESSURE BEFORE ENGINE',
        'EMERGENCY CUT OFF AIR PRESSURE',
        'CONTROL AIR PRESSURE',
        'ME CYL TEMP_1',
        'ME EXH TEMP CYL_2',
        'ME EXH TEMP CYL_3',
        'ME EXH CYL_4',
        'ME EXH CYL_5',
        'ME EXH CYL_6',
        'ME EXH BEFORE TC',
        'ME EXH AFTER TC',
        'Exh Gas temp DG2',
        'Exh gas temp DG3',
        'Air Low press DG 0_16 Bar',
        'Winding Temp R Shaft TG',
        'Winding Temp S Shaft TG',
        'Winding Temp T Shaft TG',
        'Winding Temp R Syncro',
        'Winding Temp S Syncro',
        'Winding temp T syncro',
        'DG_1 BEARING TEMP',
        'DG_2 BEARING TEMP',
        'DG_3 BEARING TEMP',
        NULL,
        'temp below piston 1_80',
        'temp below piston 1 _120',
        'temp below pist  2_80 ',
        'temp below piston 2 _120',
        'temp below piston 3_80',
        'temp below piston 3_120_sub',
        'temp below piston 4_80',
        'temp below piston 4_120',
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
    ];

    protected $setValArray = [
        'temp under piston_80 alarm set',
        'Temp below pist 1 _120 alarm set',
        'temp below pist 2_80 set',
        'temp below pist 2 _120 deg set',
        'temp below pist 3_80 set',
        'temp below pist 3_120 set',
        'temp below pist 4_80 set',
        'temp below pist 4_120 set',
        'temp below pist 5_80 set',
        'temp below pist 5_120 set',
        'contrl air low 6 bar set',
        'sprind air low press. 6 bar set',
        'Nafta Fo inlet low press. 10 bar set',
        'Nafta Fo inlet high temp  set',
        'Fresh water inlet low press set',
        'Sea water inlet low press set',
        'Fresh water temp BT set',
        'Temp Air wash Aft Remake 0_200Deg set',
        'NO_1 cyl cfw out temp _90 set',
        'NO_1 cyl cfw out temp _90_s set',
        'NO_2 cyl cfw out temp _90',
        'NO_2 cyl cfw out temp _90_s set',
        'NO_3 cyl cfw out temp _90 set',
        'NO_3 cyl cfw out temp _90_s set',
        'NO_4 cyl cfw out temp _90 set',
        'NO_4 cyl cfw out temp _90_s set',
        'NO_5 cyl cfw out temp_90 set',
        'NO_5 cyl cfw out temp_90_s set',
        'FW inlet press _s_0_10 bar set',
        'BOX BRNG OIL Temp 0_200 deg set',
        'Shaft BRNG Oil temp 0_200 deg set',
        'TC EXH valve OIL press.0_16 bar set',
        'FW Inlet Temp 0_200 deg set',
        'NO_1 Piston oil out temp _75 set',
        'NO_1 Piston oil out temp _80 set',
        'NO_2 piston oil out temp _75 set',
        'NO_2 Piston oil out temp _75 set',
        'NO_3 Piston oil out temp _75 set',
        'NO_3 Piston oil out temp _80 set',
        'NO_4 piston oil out temp_75 set',
        'NO_4 piston oil out temp_80 set',
        'NO_5 piston oil out temp_75 set',
        'NO_5 piston oil out temp_80 set',
        'TC BRNG Oil TEMP 110DEG set',
        'TC BRNG OIL temp 120Deg set',
        'Piston cool LO press 0_6 bar set',
        'Piston Cool LO temp _50 deg set',
        'piston Cool LO temp_55Deg set',
        'Thrust Brng Temp _60Deg set',
        'Thrust Brng Temp_ 65 Deg set',
        'EXH GAS TEMP DG1 set',
        'Exh Gas temp DG2 set',
        'Exh gas temp DG3 set',
        'Air Low press DG 0_16 Bar set',
        'Winding Temp R Shaft TG set',
        'Winding Temp S Shaft TG set',
        'Winding Temp T Shaft TG set',
        'Winding Temp R Syncro set',
        'Winding Temp S Syncro set',
        'Winding temp T syncro set',
    ];
}