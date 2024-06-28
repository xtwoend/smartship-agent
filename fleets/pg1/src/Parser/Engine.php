<?php

namespace Smartship\Pg1\Parser;

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
                // 
                'me_fo_inlet_pressure' => (float) $data['me_fo_inlet_pressure'],
                'me_scav_air_receiver_press' => (float) $data['me_scav_air_receiver_press'],
                'me_lo_inlet_pressure' => (float) $data['me_lo_inlet_pressure'],
                'me_starting_air_inlet_pressure' => (float) $data['me_starting_air_inlet_pressure'],
                'me_jcw_inlet_pressure' => (float) $data['me_jcw_inlet_pressure'],
                'me_control_air_inlet_pressure' => (float) $data['me_control_air_inlet_pressure'],
            ]
        ];
    }
}
