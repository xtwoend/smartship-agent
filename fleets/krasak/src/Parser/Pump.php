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
                'terminal_time' => (string) Carbon::now()->format('Y-m-d H:i:s'),
                'cargo_pump_timestamp' => (string) Carbon::now()->format('Y-m-d H:i:s'),
                'cleannig_pump_run' => (int) $data['CLEANNIG_PUMP_RUN'],
                'stripping2_pump_port_run' => (int) $data['STRIPPING2_PUMP_PORT_RUN'],
                'strriping1_pump_stbd_run' => (int) $data['STRRIPING1_PUMP_STBD_RUN'],
                'cargo3_pump_port_run' => (int) $data['CARGO3_PUMP_PORT_RUN'],
                'cargo2_pump_center_run' => (int) $data['CARGO2_PUMP_CENTER_RUN'],
                'cargo1_pump_stbd_run' => (int) $data['CARGO1_PUMP_STBD_RUN'],
                'ballast2_pump_port_run' => (int) $data['BALLAST2_PUMP_PORT_RUN'],
                'ballast1_pump_stbd_run' => (int) $data['BALLAST1_PUMP_STBD_RUN'],
            ],
        ];
    }
}