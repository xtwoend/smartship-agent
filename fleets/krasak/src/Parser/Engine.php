<?php

namespace Smartship\Krasak\Parser;

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
                'me_fo_inlet_press' => (float) $data['me_fo_inlet_press'],
                'no1_main_air_reservoir' => (float) $data['no1_main_air_reservoir'],
                'no2_main_air_reservoir' => (float) $data['no2_main_air_reservoir'],
                'me_lub_oil_inlet' => (float) $data['me_lub_oil_inlet'],
                'me_control_air' => (float) $data['me_control_air'],
                'me_starting_air' => (float) $data['me_starting_air'],
                'me_charge_air_cylinder_inlet' => (float) $data['me_charge_air_cylinder_inlet'],
                'me_cooling_sea_water_inlet' => (float) $data['me_cooling_sea_water_inlet'],
                'me_cooling_fresh_water_inlet' => (float) $data['me_cooling_fresh_water_inlet'],
            ]
        ];
    }
}
