<?php

namespace App\Mqtt\Arimbi;

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
                'terminal_time' => (string) Carbon::now()->format('Y-m-d H:i:s'),
                'temp_tank_upper_no1' => (float) $data['temp_tank_upper_no1'],
                'temp_tank_upper_no2' => (float) $data['temp_tank_upper_no2'],
                'temp_comp_outlet_no1' => (float) $data['temp_comp_outlet_no1'],
                'pressure_tank_no1' => (float) $data['pressure_tank_no1'],
                'tamp_tank_middle_no1' => (float) $data['tamp_tank_middle_no1'],
                'tamp_tank_middle_no2' => (float) $data['tamp_tank_middle_no2'],
                'temp_comp_outlet_no2' => (float) $data['temp_comp_outlet_no2'],
                'pressure_tank_no2' => (float) $data['pressure_tank_no2'],
                'tamp_tank_bottom_no1' => (float) $data['tamp_tank_bottom_no1'],
                'tamp_tank_bottom_no2' => (float) $data['tamp_tank_bottom_no2'],
                'pressure_comp_inlet' => (float) $data['pressure_comp_inlet'],
                'pressure_comp_outlet' => (float) $data['pressure_comp_outlet'],
                'ullage_cargo_no1' => (float) $data['ullage_cargo_no1'],
                'ullage_cargo_no2' => (float) $data['ullage_cargo_no2'],
                'data15' => (float) $data['data15'],
                'data16' => (float) $data['data16'],
                'cargo_pump1_run' => (float) $data['cargo_pump1_run'],
                'cargo_pump2_run' => (float) $data['cargo_pump2_run'],
                'compressor_no1_run' => (float) $data['compressor_no1_run'],
                'compressor_no2_run' => (float) $data['compressor_no2_run'],
            ]
        ];
    }
}