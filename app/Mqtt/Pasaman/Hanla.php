<?php

namespace App\Mqtt\Pasaman;

use Carbon\Carbon;
use Hyperf\Utils\Str;
use Hyperf\Utils\Codec\Json;

class Hanla
{
    protected string $message;

    public function __construct(string $message) {
       
        $this->message = $message;
    }
    
    public function extract()
    {
        $data = Json::decode($this->message);
        
        return [
            'cargo' => [
                'cargo_timestamp' => $data['_terminalTime'] ?? Carbon::now()->format('Y-m-d H:i:s'),
                'no_1_cot_p' => (float) $data['NO_1_COT_P'],
                'no_1_p_a_temp' => (float) $data['NO_1_P_A_TEMP'],
                'no_1_p_u_temp' => (float) $data['NO_1_P_U_TEMP'],
                'no_1_p_m_temp' => (float) $data['NO_1_P_M_TEMP'],
                'no_1_p_l_temp' => (float) $data['NO_1_P_L_TEMP'],
                'no_1_p_pressure' => (float) $data['NO_1_P_PRESSURE'],
                'no_1_cot_s' => (float) $data['NO_1_COT_S'],
                'no_1_s_a_temp' => (float) $data['NO_1_S_A_TEMP'],
                'no_1_s_u_temp' => (float) $data['NO_1_S_U_TEMP'],
                'no_1_s_m_temp' => (float) $data['NO_1_S_M_TEMP'],
                'no_1_s_l_temp' => (float) $data['NO_1_S_L_TEMP'],
                'no_1_s_pressure' => (float) $data['NO_1_S_PRESSURE'],
                'no_2_cot_p' => (float) $data['NO_2_COT_P'],
                'no_2_p_a_temp' => (float) $data['NO_2_P_A_TEMP'],
                'no_2_p_u_temp' => (float) $data['NO_2_P_U_TEMP'],
                'no_2_p_m_temp' => (float) $data['NO_2_P_M_TEMP'],
                'no_2_p_l_temp' => (float) $data['NO_2_P_L_TEMP'],
                'no_2_p_pressure' => (float) $data['NO_2_P_PRESSURE'],
                'no_2_cot_s' => (float) $data['NO_2_COT_S'],
                'no_2_s_a_temp' => (float) $data['NO_2_S_A_TEMP'],
                'no_2_s_u_temp' => (float) $data['NO_2_S_U_TEMP'],
                'no_2_s_m_temp' => (float) $data['NO_2_S_M_TEMP'],
                'no_2_s_l_temp' => (float) $data['NO_2_S_L_TEMP'],
                'no_2_s_pressure' => (float) $data['NO_2_S_PRESSURE'],
                'no_3_cot_p' => (float) $data['NO_3_COT_P'],
                'no_3_p_a_temp' => (float) $data['NO_3_P_A_TEMP'],
                'no_3_p_u_temp' => (float) $data['NO_3_P_U_TEMP'],
                'no_3_p_m_temp' => (float) $data['NO_3_P_M_TEMP'],
                'no_3_p_l_temp' => (float) $data['NO_3_P_L_TEMP'],
                'no_3_p_pressure' => (float) $data['NO_3_P_PRESSURE'],
                'no_3_cot_s' => (float) $data['NO_3_COT_S'],
                'no_3_s_a_temp' => (float) $data['NO_3_S_A_TEMP'],
                'no_3_s_u_temp' => (float) $data['NO_3_S_U_TEMP'],
                'no_3_s_m_temp' => (float) $data['NO_3_S_M_TEMP'],
                'no_3_s_l_temp' => (float) $data['NO_3_S_L_TEMP'],
                'no_3_s_pressure' => (float) $data['NO_3_S_PRESSURE'],
                'no_4_cot_p' => (float) $data['NO_4_COT_P'],
                'no_4_p_a_temp' => (float) $data['NO_4_P_A_TEMP'],
                'no_4_p_u_temp' => (float) $data['NO_4_P_U_TEMP'],
                'no_4_p_m_temp' => (float) $data['NO_4_P_M_TEMP'],
                'no_4_p_l_temp' => (float) $data['NO_4_P_L_TEMP'],
                'no_4_p_pressure' => (float) $data['NO_4_P_PRESSURE'],
                'no_4_cot_s' => (float) $data['NO_4_COT_S'],
                'no_4_s_a_temp' => (float) $data['NO_4_S_A_TEMP'],
                'no_4_s_u_temp' => (float) $data['NO_4_S_U_TEMP'],
                'no_4_s_m_temp' => (float) $data['NO_4_S_M_TEMP'],
                'no_4_s_l_temp' => (float) $data['NO_4_S_L_TEMP'],
                'no_4_s_pressure' => (float) $data['NO_4_S_PRESSURE'],
                'no_5_cot_p' => (float) $data['NO_5_COT_P'],
                'no_5_p_a_temp' => (float) $data['NO_5_P_A_TEMP'],
                'no_5_p_u_temp' => (float) $data['NO_5_P_U_TEMP'],
                'no_5_p_m_temp' => (float) $data['NO_5_P_M_TEMP'],
                'no_5_p_l_temp' => (float) $data['NO_5_P_L_TEMP'],
                'no_5_p_pressure' => (float) $data['NO_5_P_PRESSURE'],
                'no_5_cot_s' => (float) $data['NO_5_COT_S'],
                'no_5_s_a_temp' => (float) $data['NO_5_S_A_TEMP'],
                'no_5_s_u_temp' => (float) $data['NO_5_S_U_TEMP'],
                'no_5_s_m_temp' => (float) $data['NO_5_S_M_TEMP'],
                'no_5_s_l_temp' => (float) $data['NO_5_S_L_TEMP'],
                'no_5_s_pressure' => (float) $data['NO_5_S_PRESSURE'],
                'slop_tk_p' => (float) $data['SLOP_TK_P'],
                'slop_p_a_temp' => (float) $data['SLOP_P_A_TEMP'],
                'slop_p_u_temp' => (float) $data['SLOP_P_U_TEMP'],
                'slop_p_m_temp' => (float) $data['SLOP_P_M_TEMP'],
                'slop_p_l_temp' => (float) $data['SLOP_P_L_TEMP'],
                'slop_p_pressure' => (float) $data['SLOP_P_PRESSURE'],
                'slop_tk_s' => (float) $data['SLOP_TK_S'],
                'slop_s_a_temp' => (float) $data['SLOP_S_A_TEMP'],
                'slop_s_u_temp' => (float) $data['SLOP_S_U_TEMP'],
                'slop_s_m_temp' => (float) $data['SLOP_S_M_TEMP'],
                'slop_s_l_temp' => (float) $data['SLOP_S_L_TEMP'],
                'slop_s_pressure' => (float) $data['SLOP_S_PRESSURE'],
                'cargo_pump1_run' => (float) $data['CARGO_PUMP1_RUN'],
                'cargo_pump2_run' => (float) $data['CARGO_PUMP2_RUN'],
                'cargo_pump3_run' => (float) $data['CARGO_PUMP3_RUN'],
                'stripping_pump_run' => (float) $data['STRIPPING_PUMP_RUN'],
                'tk_cleanning_pump_run' => (float) $data['TK_CLEANNING_PUMP_RUN'],
                'ballast_pump1_run' => (float) $data['BALLAST_PUMP1_RUN'],
                'ballast_pump2_run' => (float) $data['BALLAST_PUMP2_RUN'],
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
        'NO_1_COT_P',
        'NO_1_P_A_TEMP',
        'NO_1_P_U_TEMP',
        'NO_1_P_M_TEMP',
        'NO_1_P_L_TEMP',
        'NO_1_P_PRESSURE',
        'NO_1_COT_S',
        'NO_1_S_A_TEMP',
        'NO_1_S_U_TEMP',
        'NO_1_S_M_TEMP',
        'NO_1_S_L_TEMP',
        'NO_1_S_PRESSURE',
        'NO_2_COT_P',
        'NO_2_P_A_TEMP',
        'NO_2_P_U_TEMP',
        'NO_2_P_M_TEMP',
        'NO_2_P_L_TEMP',
        'NO_2_P_PRESSURE',
        'NO_2_COT_S',
        'NO_2_S_A_TEMP',
        'NO_2_S_U_TEMP',
        'NO_2_S_M_TEMP',
        'NO_2_S_L_TEMP',
        'NO_2_S_PRESSURE',
        'NO_3_COT_P',
        'NO_3_P_A_TEMP',
        'NO_3_P_U_TEMP',
        'NO_3_P_M_TEMP',
        'NO_3_P_L_TEMP',
        'NO_3_P_PRESSURE',
        'NO_3_COT_S',
        'NO_3_S_A_TEMP',
        'NO_3_S_U_TEMP',
        'NO_3_S_M_TEMP',
        'NO_3_S_L_TEMP',
        'NO_3_S_PRESSURE',
        'NO_4_COT_P',
        'NO_4_P_A_TEMP',
        'NO_4_P_U_TEMP',
        'NO_4_P_M_TEMP',
        'NO_4_P_L_TEMP',
        'NO_4_P_PRESSURE',
        'NO_4_COT_S',
        'NO_4_S_A_TEMP',
        'NO_4_S_U_TEMP',
        'NO_4_S_M_TEMP',
        'NO_4_S_L_TEMP',
        'NO_4_S_PRESSURE',
        'NO_5_COT_P',
        'NO_5_P_A_TEMP',
        'NO_5_P_U_TEMP',
        'NO_5_P_M_TEMP',
        'NO_5_P_L_TEMP',
        'NO_5_P_PRESSURE',
        'NO_5_COT_S',
        'NO_5_S_A_TEMP',
        'NO_5_S_U_TEMP',
        'NO_5_S_M_TEMP',
        'NO_5_S_L_TEMP',
        'NO_5_S_PRESSURE',
        'SLOP_TK_P',
        'SLOP_P_A_TEMP',
        'SLOP_P_U_TEMP',
        'SLOP_P_M_TEMP',
        'SLOP_P_L_TEMP',
        'SLOP_P_PRESSURE',
        'SLOP_TK_S',
        'SLOP_S_A_TEMP',
        'SLOP_S_U_TEMP',
        'SLOP_S_M_TEMP',
        'SLOP_S_L_TEMP',
        'SLOP_S_PRESSURE',
        'CARGO_PUMP1_RUN',
        'CARGO_PUMP2_RUN',
        'CARGO_PUMP3_RUN',
        'STRIPPING_PUMP_RUN',
        'TK_CLEANNING_PUMP_RUN',
        'BALLAST_PUMP1_RUN',
        'BALLAST_PUMP2_RUN',
    ];
}