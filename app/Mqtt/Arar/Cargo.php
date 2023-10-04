<?php

namespace App\Mqtt\Arar;

use Carbon\Carbon;
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

        return [
            'cargo' => [
                'terminal_time' => Carbon::now()->format('Y-m-d H:i:s'),
                'pressure_tank_tank1' => $data['pressure_tank_tank1'],
                'level_tank1' => $data['level_tank1'],
                'bottom_temp_tank1' => $data['bottom_temp_tank1'],
                'middle_temp_tank1' => $data['middle_temp_tank1'],
                'top_temp_tank1' => $data['top_temp_tank1'],
                'motor_current_tank1' => $data['motor_current_tank1'],
                'sp_low_current_pm5101_tank1' => $data['sp_low_current_pm5101_tank1'],
                'sp_bottom_temp_t5101_tank1' => $data['sp_bottom_temp_t5101_tank1'],
                'pressure_tank_tank2' => $data['pressure_tank_tank2'],
                'level_tank2' => $data['level_tank2'],
                'bottom_temp_tank2' => $data['bottom_temp_tank2'],
                'middle_temp_tank2' => $data['middle_temp_tank2'],
                'top_temp_tank2' => $data['top_temp_tank2'],
                'motor_current_tank2' => $data['motor_current_tank2'],
                'sp_low_current_pm5101_tank2' => $data['sp_low_current_pm5101_tank2'],
                'sp_bottom_temp_t5101_tank2' => $data['sp_bottom_temp_t5101_tank2'],
                'heating_crossover_outloading' => $data['heating_crossover_outloading'],
                'cm1101_motor_current' => $data['cm1101_motor_current'],
                'cm1201_motor_current' => $data['cm1201_motor_current'],
            ]
        ];
    }
}