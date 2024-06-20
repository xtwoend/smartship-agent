<?php

namespace Smartship\Krasak\Parser;

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
                'cleannig_pump_run' => (int) $data['cleannig_pump_run'],
                'stripping2_pump_port_run' => (int) $data['stripping2_pump_port_run'],
                'strriping1_pump_stbd_run' => (int) $data['strriping1_pump_stbd_run'],
                'cargo3_pump_port_run' => (int) $data['cargo3_pump_port_run'],
                'cargo2_pump_center_run' => (int) $data['cargo2_pump_center_run'],
                'cargo1_pump_stbd_run' => (int) $data['cargo1_pump_stbd_run'],
                'ballast2_pump_port_run' => (int) $data['ballast2_pump_port_run'],
                'ballast1_pump_stbd_run' => (int) $data['ballast1_pump_stbd_run'],
            ],
        ];
    }
}