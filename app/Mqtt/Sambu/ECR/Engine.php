<?php

namespace App\Mqtt\Sambu\ECR;

use Carbon\Carbon;
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
                'terminal_time' => (string) $data['_terminalTime'] ?: Carbon::now()->format('Y-m-d H:i:s'),
                'control_air_inlet' => (float) ($data['RIO_AI1_3X16'] * 10) ?: 0,
                'me_ac_cw_inlet_cooler' => (float) ($data['RIO_AI1_3X17'] * 4) ?: 0,
                'jcw_inlet' => (float) ($data['RIO_AI1_3X18'] * 6) ?: 0,
                'me_lo_inlet' => (float) ($data['RIO_AI1_3X19'] * 6) ?: 0,
                'scav_air_receiver' => (float) ($data['RIO_AI1_3X20'] * 6) ?: 0,
                'start_air_inlet' => (float) ($data['RIO_AI1_3X21'] * 40 ) ?: 0,
                'main_lub_oil' => (float) ($data['RIO_AI1_3X22'] * 6) ?: 0,
                'me_fo_inlet_engine' => (float) ($data['RIO_AI1_3X23'] * 16) ?: 0,
                'turbo_charger_speed_no_1' => (float) ($data['RIO_AI2_3X16'] * 94000) ?: 0,
                'turbo_charger_speed_no_2' => (float) ($data['RIO_AI2_3X17'] * 94000) ?: 0,
                'turbo_charger_speed_no_3' => (float) ($data['RIO_AI2_3X18'] * 94000) ?: 0,
                'tachometer_turbocharge' => (float) 0,
                'main_engine_speed' => (float) isset($data['MP5W_RPM_PV'])? $data['MP5W_RPM_PV'] : 0,
            ]
        ];
    }
}