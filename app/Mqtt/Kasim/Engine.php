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
        $signal = $data['signal'];
        $values = $data['value'];
        $collectData = [];

        if($signal == 'RPM_Propeller'){
            $collectData['rpm_propeller'] = $values[0];
        }elseif($signal == 'ENG HT-CW PRESS PT1102(0~6BAR)') {
            $collectData['eng_htcw_pressure'] = $values[0];
        }elseif($signal == 'db14_real') {
            $collectData = [
                "speed_lever_sig_factor_dep_idle_rpm" => $values[0],
                "speed_lever_sig_factor_dep_idle_rpmcal" => $values[1],
                "sld_command_rpm" => $values[2],
                "sld_command_rpmcal" => $values[3],
                "sld_command_rpm_hysl" => $values[4],
                "sld_command_rpm_hysh" => $values[5],
            ];
        }elseif($signal == 'sensor_SE1704B') {
            $collectData['sensor_SE1704B'] = $values[0];
        }elseif($signal == 'sensor_db11_1'){
            $collectData = [
                "eng_exh_gas_temp_cyl1_te1601" => $values[17],
                "eng_exh_gas_temp_cyl2_te1602" => $values[18],
                "eng_exh_gas_temp_cyl3_te1603" => $values[19],
                "eng_exh_gas_temp_cyl4_te1604" => $values[20],
                "eng_exh_gas_temp_cyl5_te1605" => $values[21],
                "eng_exh_gas_temp_cyl6_te1606" => $values[22],
                "eng_exh_gas_temp_cyl7_te1607" => $values[23],
                "eng_exh_gas_temp_cyl8_te1608" => $values[24],
            ];
        }

        return [
            'engine' => array_merge($collectData, ['terminal_time' => Carbon::now()->format('Y-m-d H:i:s'),])
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

    protected $mapDb11_1 = [
        17 => 'ENG EXH GAS TEMP CYL1 TE1601',
        18 => 'ENG EXH GAS TEMP CYL2 TE1602',
        19 => 'ENG EXH GAS TEMP CYL3 TE1603',
        20 => 'ENG EXH GAS TEMP CYL4 TE1604',
        21 => 'ENG EXH GAS TEMP CYL5 TE1605',
        22 => 'ENG EXH GAS TEMP CYL6 TE1606',
        23 => 'ENG EXH GAS TEMP CYL7 TE1607',
        24 => 'ENG EXH GAS TEMP CYL8 TE1608'
    ];


    protected $rpm = [
        'SPEED_LEVER_SIG_FACTOR_DEP_IDLE_RPM',
        'SPEED_LEVER_SIG_FACTOR_DEP_IDLE_RPMcal',
        'SLD_COMMAND_RPM',
        'SLD_COMMAND_RPMcal',
        'SLD_COMMAND_RPM_hysL',
        'SLD_COMMAND_RPM_hysH',
    ];

}