<?php

namespace App\Mqtt\Arar;

use Carbon\Carbon;
use Hyperf\Utils\Codec\Json;

class CargoPump
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
                'pump_latest_update_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'esd_ca_board' => $data['esd_ca_board'],
                'esd_wheel_house' => $data['esd_wheel_house'],
                'esd_compressor_room' => $data['esd_compressor_room'],
                'esd_tank_5100' => $data['esd_tank_5100'],
                'esd_tank_5200' => $data['esd_tank_5200'],
                'esd_cross_over_1' => $data['esd_cross_over_1'],
                'esd_cross_over_2' => $data['esd_cross_over_2'],
                'fire_air_system' => $data['fire_air_system'],
                'esd_relais' => $data['esd_relais'],
                '98_tank_t5100' => $data['98%_tank_t5100'],
                'L1101' => $data['L1101'],
                'P9801' => $data['P9801'],
                'P1102' => $data['P1102'],
                'T1102' => $data['T1102'],
                'PD1103' => $data['PD1103'],
                'CM1101_HSH_start' => $data['CM1101_HSH_start'],
                'CM1101_HSH_stop' => $data['CM1101_HSH_stop'],
                'not_used' => $data['not_used'],
                'cm1101_run' => $data['cm1101_run'],
                'cm1101_fault' => $data['cm1101_fault'],
                'cm101_winding_temp' => $data['cm101_winding_temp'],
                'pm5101_hsh_start' => $data['pm5101_hsh_start'],
                'pm5101_hsl_start' => $data['pm5101_hsl_start'],
                'pm5101_power_avail' => $data['pm5101_power_avail'],
                'pm5101_run' => $data['pm5101_run'],
                'pm5101_fault' => $data['pm5101_fault'],
                'pm5101_winding_temp' => $data['pm5101_winding_temp'],
                'L5102' => $data['L5102'],
                'P5103_al' => $data['P5103_al'],
                'p5103_ah_vcm' => $data['p5103_ah_vcm'],
                'p5102_ah_standard' => $data['p5102_ah_standard'],
                'l5104' => $data['l5104'],
                '98_tank_5200' => $data['98%_tank_5200'],
                'P9803' => $data['P9803'],
                'cm1201_hsh_start' => $data['cm1201_hsh_start'],
                'cm1201_hsl_stop' => $data['cm1201_hsl_stop'],
                'cm1201_run' => $data['cm1201_run'],
                'cm1201_fault' => $data['cm1201_fault'],
                'cm1201_winding_temp' => $data['cm1201_winding_temp'],
                'pm5201_hsh_start' => $data['pm5201_hsh_start'],
                'pm5201_hsl_stop' => $data['pm5201_hsl_stop'],
                'pm5201_run' => $data['pm5201_run'],
                'pm5201_fault' => $data['pm5201_fault'],
                'pm5201_winding_temp' => $data['pm5201_winding_temp'],
            ]
        ];
    }
}