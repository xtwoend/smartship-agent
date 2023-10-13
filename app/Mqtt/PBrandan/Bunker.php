<?php

namespace App\Mqtt\PBrandan;

use Carbon\Carbon;
use Hyperf\Utils\Codec\Json;

class Bunker
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
                'bunker_timestamp' => $data['_terminalTime'] ?? Carbon::now()->format('Y-m-d H:i:s'),
                'hfo_storage_tank_1p' => (float) $data['hfo_storage_tank_1p'],
                'hfo_storage_tank_1s' => (float) $data['hfo_storage_tank_1s'],
                'hfo_storage_tank_2p' => (float) $data['hfo_storage_tank_2p'],
                'hfo_storage_tank_2s' => (float) $data['hfo_storage_tank_2s'],
                'hfo_setting_tank' => (float) $data['hfo_setting_tank'],
                'hfo_service_tank_1' => (float) $data['hfo_service_tank_1'],
                'hfo_service_tank_2' => (float) $data['hfo_service_tank_2'],
                'mdo_storage_tank_p' => (float) $data['mdo_storage_tank_p'],
                'mdo_storage_tank_s' => (float) $data['mdo_storage_tank_s'],
                'mdo_setting_tank' => (float) $data['mdo_setting_tank'],
                'mdo_service_tank_1' => (float) $data['mdo_service_tank_1'],
                'mdo_service_tank_2' => (float) $data['mdo_service_tank_2'],
            ]
        ];
    }
}