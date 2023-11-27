<?php

namespace App\Mqtt\Yudhistira;

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
                'terminal_time' => $data['_terminalTime'] ?? Carbon::now()->format('Y-m-d H:i:s'),
                'me_rpm' => $data['me_rpm'],
                'me_exhaust_gas_cyl_1_temp' => $data['me_exhaust_gas_cyl_1_temp'],
                'me_exhaust_gas_cyl_2_temp' => $data['me_exhaust_gas_cyl_2_temp'],
                'me_exhaust_gas_cyl_3_temp' => $data['me_exhaust_gas_cyl_3_temp'],
                'me_exhaust_gas_cyl_4_temp' => $data['me_exhaust_gas_cyl_4_temp'],
                'me_exhaust_gas_cyl_5_temp' => $data['me_exhaust_gas_cyl_5_temp'],
                'me_exhaust_gas_cyl_6_temp' => $data['me_exhaust_gas_cyl_6_temp'],
                'me_exhaust_gas_temp_tc_inlet_no1' => $data['me_exhaust_gas_temp_tc_inlet_no1'],
                'me_exhaust_gas_temp_tc_inlet_no2' => $data['me_exhaust_gas_temp_tc_inlet_no2'],
                'me_exhaust_gas_temp_tc_outlet' => $data['me_exhaust_gas_temp_tc_outlet'],
                'me_fuel_oil_temp_inlet' => $data['me_fuel_oil_temp_inlet'],
                'me_lube_oil_temp_inlet' => $data['me_lube_oil_temp_inlet'],
                'me_tc_lube_oil_temp_outlet' => $data['me_tc_lube_oil_temp_outlet'],
                'me_cool_fw_temp_outlet_cyl_no1' => $data['me_cool_fw_temp_outlet_cyl_no1'],
                'me_cool_fw_temp_outlet_cyl_no2' => $data['me_cool_fw_temp_outlet_cyl_no2'],
                'me_cool_fw_temp_outlet_cyl_no3' => $data['me_cool_fw_temp_outlet_cyl_no3'],
                'me_cool_fw_temp_outlet_cyl_no4' => $data['me_cool_fw_temp_outlet_cyl_no4'],
                'me_cool_fw_temp_outlet_cyl_no5' => $data['me_cool_fw_temp_outlet_cyl_no5'],
                'me_cool_fw_temp_outlet_cyl_no6' => $data['me_cool_fw_temp_outlet_cyl_no6'],
                'me_cool_fw_temp_inlet' => $data['me_cool_fw_temp_inlet'],
                'me_cool_sw_temp_inlet' => $data['me_cool_sw_temp_inlet'],
                'me_boost_air_temp_inlet' => $data['me_boost_air_temp_inlet'],
                'me_starting_air_pressure' => $data['me_starting_air_pressure'],
                'me_control_air_pressure' => $data['me_control_air_pressure'],
                'ge1_lube_oil_pressure' => $data['ge1_lube_oil_pressure'],
                'ge1_ht_fw_coolant_pressure' => $data['ge1_ht_fw_coolant_pressure'],
                'ge1_lt_fw_coolant_pressure' => $data['ge1_lt_fw_coolant_pressure'],
                'ge1_fuel_oil_pressure' => $data['ge1_fuel_oil_pressure'],
                'ge1_starting_air_pressure' => $data['ge1_starting_air_pressure'],
                'ge1_ht_fw_coolant_temp' => $data['ge1_ht_fw_coolant_temp'],
                'ge1_lube_oil_temp' => $data['ge1_lube_oil_temp'],
                'ge1_charge_air_temp' => $data['ge1_charge_air_temp'],
                'ge1_battery_voltage' => $data['ge1_battery_voltage'],
                'ge1_generator_rpm' => $data['ge1_generator_rpm'],
                'ge1_spare' => $data['ge1_spare'],
                'ge1_spare' => $data['ge1_spare'],
                'ge1_spare' => $data['ge1_spare'],
                'ge1_spare' => $data['ge1_spare'],
                'ge2_lube_oil_pressure' => $data['ge2_lube_oil_pressure'],
                'ge2_ht_fw_coolant_pressure' => $data['ge2_ht_fw_coolant_pressure'],
                'ge2_lt_fw_coolant_pressure' => $data['ge2_lt_fw_coolant_pressure'],
                'ge2_fuel_oil_pressure' => $data['ge2_fuel_oil_pressure'],
                'ge2_starting_air_pressure' => $data['ge2_starting_air_pressure'],
                'ge2_ht_fw_coolant_temp' => $data['ge2_ht_fw_coolant_temp'],
                'ge2_lube_oil_temp' => $data['ge2_lube_oil_temp'],
                'ge2_charge_air_temp' => $data['ge2_charge_air_temp'],
                'ge2_battery_voltage' => $data['ge2_battery_voltage'],
                'ge2_generator_rpm' => $data['ge2_generator_rpm'],
                'ge2_spare' => $data['ge2_spare'],
                'ge2_spare' => $data['ge2_spare'],
                'ge2_spare' => $data['ge2_spare'],
                'ge2_spare' => $data['ge2_spare'],
                'ge3_lube_oil_pressure' => $data['ge3_lube_oil_pressure'],
                'ge3_ht_fw_coolant_pressure' => $data['ge3_ht_fw_coolant_pressure'],
                'ge3_lt_fw_coolant_pressure' => $data['ge3_lt_fw_coolant_pressure'],
                'ge3_fuel_oil_pressure' => $data['ge3_fuel_oil_pressure'],
                'ge3_starting_air_pressure' => $data['ge3_starting_air_pressure'],
                'ge3_ht_fw_coolant_temp' => $data['ge3_ht_fw_coolant_temp'],
                'ge3_lube_oil_temp' => $data['ge3_lube_oil_temp'],
                'ge3_charge_air_temp' => $data['ge3_charge_air_temp'],
                'ge3_battery_voltage' => $data['ge3_battery_voltage'],
                'ge3_generator_rpm' => $data['ge3_generator_rpm'],
                'ge3_spare' => $data['ge3_spare'],
                'ge3_spare' => $data['ge3_spare'],
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