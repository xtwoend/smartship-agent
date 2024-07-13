<?php

namespace Smartship\Aquila\Parser;

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
                'cargo_pump1_run' => (int) $data['cargo_pump1_run'],
                'cargo_pump2_run' => (int) $data['cargo_pump2_run'],
                'cargo_pump3_run' => (int) $data['cargo_pump3_run'],
                'stripping_pump1_run' => (int) $data['stripping_pump1_run'],
                'stripping_pump2_run' => (int) $data['stripping_pump2_run'],
                'ballast_pump_run' => (int) $data['ballast_pump_run'],
            ],
        ];
    }
}