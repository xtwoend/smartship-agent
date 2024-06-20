<?php

namespace Smartship\Krasak\Parser;

use Carbon\Carbon;
use Hyperf\Codec\Json;

class Cargo
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
            'cargo' => [
                'cargo_timestamp' => (string) Carbon::now()->format('Y-m-d H:i:s'),
                'temp_ballast1_driver_end_bearing_port' => (float) $data['temp_ballast1_driver_end_bearing_port'],
                'temp_ballast1_trans_bearing_port' => (float) $data['temp_ballast1_trans_bearing_port'],
                'temp_ballast2_driver_end_bearing_starboard' => (float) $data['temp_ballast2_driver_end_bearing_starboard'],
                'temp_ballast2_trans_bearing_starboard' => (float) $data['temp_ballast2_trans_bearing_starboard'],
                'temp_cargo2_pump_casing_center' => (float) $data['temp_cargo2_pump_casing_center'],
                'temp_cargo2_driver_end_bearing_center' => (float) $data['temp_cargo2_driver_end_bearing_center'],
                'temp_cargo2_trans_bearing_center' => (float) $data['temp_cargo2_trans_bearing_center'],
                'temp_cargo1_pump_casing_port' => (float) $data['temp_cargo1_pump_casing_port'],
                'temp_cargo1_driver_end_beearing_port' => (float) $data['temp_cargo1_driver_end_beearing_port'],
                'temp_cargo1_trans_bearing_port' => (float) $data['temp_cargo1_trans_bearing_port'],
                'temp_cargo3_pump_casing_starboard' => (float) $data['temp_cargo3_pump_casing_starboard'],
                'temp_cargo3_driver_end_bearing_startboard' => (float) $data['temp_cargo3_driver_end_bearing_startboard'],
                'temp_cargo3_trans_bearing_port' => (float) $data['temp_cargo3_trans_bearing_port'],
                'temp_stripping1_end_bearing_port' => (float) $data['temp_stripping1_end_bearing_port'],
                'temp_stripping1_driver_end_bearing_port' => (float) $data['temp_stripping1_driver_end_bearing_port'],
                'temp_stripping1_trans_bearing_port' => (float) $data['temp_stripping1_trans_bearing_port'],
                'temp_stripping2_end_bearing_startboard' => (float) $data['temp_stripping2_end_bearing_startboard'],
                'temp_stripping2_driver_end_bearing_startboard' => (float) $data['temp_stripping2_driver_end_bearing_startboard'],
                'temp_stripping2_trans_bearing_startboard' => (float) $data['temp_stripping2_trans_bearing_startboard'],
                'temp_cleanning_driver_end_bearing_port' => (float) $data['temp_cleanning_driver_end_bearing_port'],
                'temp_cleanning_trans_bearing_port' => (float) $data['temp_cleanning_trans_bearing_port'],
            ],
        ];
    }
}