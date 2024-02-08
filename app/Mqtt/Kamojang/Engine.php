<?php

namespace App\Mqtt\Kamojang;

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
        $value = $data['main_engine'];
        return [
            'engine' => [
                'terminal_time' => Carbon::now()->format('Y-m-d H:i:s'),
                'fuel_oil_inlet_pressure' => (float) ($value[0] / 100),
                'fuel_oil_inlet_temperature' => (float) ($value[1] / 10),
                'lube_oil_inlet_pressure' => (float) ($value[5] / 100),
                'lube_oil_inlet_temperature' => (float) ($value[6]/10),
                'lube_oil_filter_differential_pressure' => (float) ($value[8] / 100),
                'lube_oil_turbocharger_pressure' => (float) ($value[9] / 100),
                'lube_oil_turbocharger_outlet_temperature' => (float) ($value[10]/10),
                'starting_air_pressure' => (float) ($value[15] / 100),
                'control_air_pressure' => (float) ($value[16] / 100),
                'h_t_water_pressure_inlet' => (float) ($value[18] / 100),
                'h_t_water_temperature_inlet' => (float) ($value[19]/10),
                'h_t_water_temperature_outlet' => (float) ($value[26]/10),
                'l_t_water_pressure_inlet' => (float) ($value[22] / 100),
                'l_t_water_temperature_inlet' => (float) ($value[23]/10),
                'l_t_water_tempeature_l_o_c_outlet' => (float) ($value[24] / 10),
                'exhaust_gas_temperature_t_c_inlet1' => (float) ($value[27] / 10),
                'exhaust_gas_temperature_t_c_outlet' => (float) ($value[28] / 10),
                'exhaust_gas_temperature_cylinder1' => (float) ($value[29] / 10),
                'exhaust_gas_temperature_cylinder2' => (float) ($value[30] / 10),
                'exhaust_gas_temperature_cylinder3' => (float) ($value[31] / 10),
                'exhaust_gas_temperature_cylinder4' => (float) ($value[32] / 10),
                'exhaust_gas_temperature_cylinder5' => (float) ($value[33] / 10),
                'exhaust_gas_temperature_cylinder6' => (float) ($value[34] / 10),
                'exhaust_gas_temperature_average' => (float) ($value[38] / 10),
                'exhaust_gas_temp_deviation1_a' => (float) ($value[39] / 10),
                'exhaust_gas_temp_deviation2_a' => (float) ($value[40] / 10),
                'exhaust_gas_temp_deviation3_a' => (float) ($value[41] / 10),
                'exhaust_gas_temp_deviation4_a' => (float) ($value[42] / 10),
                'exhaust_gas_temp_deviation5_a' => (float) ($value[43] / 10),
                'exhaust_gas_temp_deviation6_a' => (float) ($value[44] / 10),
                'charge_air_pressure_inlet' => (float) ($value[49] / 100),
                'charge_air_temperature_inlet' => (float) ($value[50] / 10),
                'main_bearing_temp0' => (float) ($value[56] / 10),
                'main_bearing_temp1' => (float) ($value[57] / 10),
                'main_bearing_temp2' => (float) ($value[58] / 10),
                'main_bearing_temp3' => (float) ($value[59] / 10),
                'main_bearing_temp4' => (float) ($value[60] / 10),
                'main_bearing_temp5' => (float) ($value[61] / 10),
                'main_bearing_temp6' => (float) ($value[62] / 10),
                'main_bearing_temp7' => (float) ($value[63] / 10),
                'crankcase_pressure' => (float) ($value[67] / 100),
                'fuel_rack_position' => (float) $value[73],
                'turbocharger_speed' => (float) $value[74],
                'modbus_counter' => (float) $value[75],
                'engine_speed' => (float) $value[76],
                'torsional_vibration_level' => (float) $value[79],
                'cylinder_a1_liner_temperature1' => (float) ($value[80] / 10),
                'cylinder_a1_liner_temperature2' => (float) ($value[81] / 10),
                'cylinder_a2_liner_temperature1' => (float) ($value[82] / 10),
                'cylinder_a2_liner_temperature2' => (float) ($value[83] / 10),
                'cylinder_a3_liner_temperature1' => (float) ($value[84] / 10),
                'cylinder_a3_liner_temperature2' => (float) ($value[85] / 10),
                'cylinder_a4_liner_temperature1' => (float) ($value[86] / 10),
                'cylinder_a4_liner_temperature2' => (float) ($value[87] / 10),
                'cylinder_a5_liner_temperature1' => (float) ($value[88] / 10),
                'cylinder_a5_liner_temperature2' => (float) ($value[89] / 10),
                'cylinder_a6_liner_temperature1' => (float) ($value[90] / 10),
                'cylinder_a6_liner_temperature2' => (float) ($value[91] / 10),
            ]
        ];
    }

    function arrayToSnake() : array {
        $snake = [];
        foreach($this->mappArray as $in => $val) {
            if(is_null($val)) continue;
            $key = Str::snake($val);
            $snake[$key] = $in;
        } 
        return $snake;
    }

    protected $mappArray = [
        'Fuel Oil Inlet Pressure',
        'Fuel Oil Inlet Temperature',
        NULL,
        NULL,
        NULL,
        'Lube Oil Inlet Pressure',
        'Lube Oil Inlet Temperature',
        NULL,
        'Lube Oil Filter Differential Pressure',
        'Lube Oil Turbocharger Pressure',
        'Lube Oil Turbocharger Outlet Temperature',
        NULL,
        NULL,
        NULL,
        NULL,
        'Starting Air Pressure',
        'Control Air Pressure',
        NULL,
        'HT Water Pressure Inlet ',
        'HT Water Temperature Inlet',
        'HT Water Temperature Outlet',
        NULL,
        'LT Water Pressure Inlet',
        'LT Water Temperature Inlet',
        'LT Water Tempeature LOC Outlet',
        NULL,
        'HT Water Temperature Outlet',
        'Exhaust Gas Temperature TC Inlet 1',
        'Exhaust Gas Temperature TC Outlet',
        'Exhaust Gas Temperature Cylinder 1',
        'Exhaust Gas Temperature Cylinder 2',
        'Exhaust Gas Temperature Cylinder 3',
        'Exhaust Gas Temperature Cylinder 4',
        'Exhaust Gas Temperature Cylinder 5',
        'Exhaust Gas Temperature Cylinder 6',
        NULL,
        NULL,
        NULL,
        'Exhaust Gas Temperature Average',
        'Exhaust Gas Temp Deviation 1A',
        'Exhaust Gas Temp Deviation 2A',
        'Exhaust Gas Temp Deviation 3A',
        'Exhaust Gas Temp Deviation 4A',
        'Exhaust Gas Temp Deviation 5A',
        'Exhaust Gas Temp Deviation 6A',
        NULL,
        NULL,
        NULL,
        NULL,
        'Charge Air Pressure  Inlet',
        'Charge Air Temperature Inlet',
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        'Main Bearing Temp 0',
        'Main Bearing Temp 1',
        'Main Bearing Temp 2',
        'Main Bearing Temp 3',
        'Main Bearing Temp 4',
        'Main Bearing Temp 5',
        'Main Bearing Temp 6',
        'Main Bearing Temp 7',
        NULL,
        NULL,
        NULL,
        'Crankcase Pressure',
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        'Fuel Rack Position',
        'Turbocharger Speed',
        'Modbus Counter',
        'Engine Speed',
        NULL,
        NULL,
        'Torsional Vibration Level',
        'Cylinder A1 Liner Temperature 1',
        'Cylinder A1 Liner Temperature 2',
        'Cylinder A2 Liner Temperature 1',
        'Cylinder A2 Liner Temperature 2',
        'Cylinder A3 Liner Temperature 1',
        'Cylinder A3 Liner Temperature 2',
        'Cylinder A4 Liner Temperature 1',
        'Cylinder A4 Liner Temperature 2',
        'Cylinder A5 Liner Temperature 1',
        'Cylinder A5 Liner Temperature 2',
        'Cylinder A6 Liner Temperature 1',
        'Cylinder A6 Liner Temperature 2',
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL
    ];
}