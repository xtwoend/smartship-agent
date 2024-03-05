<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace App\Mqtt\Antasena;

use Carbon\Carbon;
use Hyperf\Utils\Codec\Json;
use Hyperf\Utils\Str;

class Engine
{
    protected string $message;

    protected $mappArray = [
    ];

    public function __construct(string $message)
    {
        $this->message = $message;
    }

    public function extract()
    {
        $data = Json::decode($this->message);
        $data = (array) $data['data1_ecr'];

        return [
            'engine' => [
                'terminal_time' => Carbon::now()->format('Y-m-d H:i:s'),
                'me_rpm' => $data[0],
                'me_exhaust_gas_cyl_1_temp' => $data[1],
                'me_exhaust_gas_cyl_2_temp' => $data[2],
                'me_exhaust_gas_cyl_3_temp' => $data[3],
                'me_exhaust_gas_cyl_4_temp' => $data[4],
                'me_exhaust_gas_cyl_5_temp' => $data[5],
                'me_exhaust_gas_cyl_6_temp' => $data[6],
                'me_exhaust_gas_temp_tc_inlet_no1' => $data[7],
                'me_exhaust_gas_temp_tc_inlet_no2' => $data[8],
                'me_exhaust_gas_temp_tc_outlet' => $data[9],
                'me_fuel_oil_temp_inlet' => $data[10],
                'me_lube_oil_temp_inlet' => $data[11],
                'me_tc_lube_oil_temp_outlet' => $data[12],
                'me_cool_fw_temp_outlet_cyl_no1' => $data[13],
                'me_cool_fw_temp_outlet_cyl_no2' => $data[14],
                'me_cool_fw_temp_outlet_cyl_no3' => $data[15],
                'me_cool_fw_temp_outlet_cyl_no4' => $data[16],
                'me_cool_fw_temp_outlet_cyl_no5' => $data[17],
                'me_cool_fw_temp_outlet_cyl_no6' => $data[18],
                'me_cool_fw_temp_inlet' => $data[19],
                'me_cool_sw_temp_inlet' => $data[20],
                'me_boost_air_temp_inlet' => $data[21],
                'me_starting_air_pressure' => $data[22],
                'me_control_air_pressure' => $data[23],
                'ge1_lube_oil_pressure' => $data[24],
                'ge1_ht_fw_coolant_pressure' => $data[25],
                'ge1_lt_fw_coolant_pressure' => $data[26],
                'ge1_fuel_oil_pressure' => $data[27],
                'ge1_starting_air_pressure' => $data[28],
                'ge1_ht_fw_coolant_temp' => $data[29],
                'ge1_lube_oil_temp' => $data[30],
                'ge1_charge_air_temp' => $data[31],
                'ge1_battery_voltage' => $data[32],
                'ge1_generator_rpm' => $data[33],
                'ge1_spare_1' => $data[34],
                'ge1_spare_2' => $data[35],
                'ge1_spare_3' => $data[36],
                'ge1_spare_4' => $data[37],
                'ge2_lube_oil_pressure' => $data[38],
                'ge2_ht_fw_coolant_pressure' => $data[39],
                'ge2_lt_fw_coolant_pressure' => $data[40],
                'ge2_fuel_oil_pressure' => $data[41],
                'ge2_starting_air_pressure' => $data[42],
                'ge2_ht_fw_coolant_temp' => $data[43],
                'ge2_lube_oil_temp' => $data[44],
                'ge2_charge_air_temp' => $data[45],
                'ge2_battery_voltage' => $data[46],
                'ge2_generator_rpm' => $data[47],
                'ge2_spare_1' => $data[48],
                'ge2_spare_2' => $data[49],
                'ge2_spare_3' => $data[50],
                'ge2_spare_4' => $data[51],
                'ge3_lube_oil_pressure' => $data[52],
                'ge3_ht_fw_coolant_pressure' => $data[53],
                'ge3_lt_fw_coolant_pressure' => $data[54],
                'ge3_fuel_oil_pressure' => $data[55],
                'ge3_starting_air_pressure' => $data[56],
                'ge3_ht_fw_coolant_temp' => $data[57],
                'ge3_lube_oil_temp' => $data[58],
                'ge3_charge_air_temp' => $data[59],
                'ge3_battery_voltage' => $data[60],
                'ge3_generator_rpm' => $data[61],
                'ge3_spare_1' => $data[62],
                'ge3_spare_2' => $data[63],
            ],
        ];
    }

    public function arrayToSnake(): array
    {
        $snake = [];
        foreach ($this->mappArray as $in => $val) {
            if (is_null($val)) {
                continue;
            }
            $key = Str::snake(strtolower($val));
            $snake[$key] = $val;
        }
        return $snake;
    }
}
