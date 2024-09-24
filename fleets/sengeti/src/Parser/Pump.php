<?php

namespace Smartship\Sengeti\Parser;

use Carbon\Carbon;
use Hyperf\Codec\Json;

class Pump
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
                'cargo_pump_timestamp' => (string) Carbon::now()->format('Y-m-d H:i:s'),
                'cargo_pump1_run' => (float) $data['cargo_pump1_run'],
                'cargo_pump2_run' => (float) $data['cargo_pump2_run'],
                'cargo_pump3_run' => (float) $data['cargo_pump3_run'],
                'wballast_pump1_run' => (float) $data['wballast_pump1_run'],
                'wballast_pump2_run' => (float) $data['wballast_pump2_run'],
                'tank_cleaning_pump1_run' => (float) $data['tank_cleaning_pump1_run'],
                'tank_cleaning_pump2_run' => (float) $data['tank_cleaning_pump2_run'],
            ],
        ];
    }
}