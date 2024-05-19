<?php

namespace Smartship\Taurus\Parser;

use Carbon\Carbon;
use Hyperf\Codec\Json;

class Engine
{
    protected string $message;

    public function __construct(string $message)
    {
        $this->message = $message;
    }

    public function extract()
    {
        $data = Json::decode($this->message);
        
        return [
            'engine' => [
                'terminal_time' => (string) Carbon::now()->format('Y-m-d H:i:s'),
                'me_lo_press_last_bearing' => (float) $data['me_lo_press_last_bearing'],
                'me_cooliing_water_heater_inlet_pressure' => (float) $data['me_cooliing_water_heater_inlet_pressure'],
                'gearbox_lo_pressure' => (float) $data['gearbox_lo_pressure'],
                'me_starting_air_pressure' => (float) $data['me_starting_air_pressure'],
                'me_fo_inlet_pressure' => (float) $data['me_fo_inlet_pressure'],
                'me_cooling_water_lt_inlet_pressure' => (float) $data['me_cooling_water_lt_inlet_pressure'],
                'gearbox_working_oil_pressure' => (float) $data['gearbox_working_oil_pressure'],
            ]
        ];
    }
}
