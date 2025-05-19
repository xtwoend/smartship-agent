<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace App\Mqtt\Pasaman;

use Carbon\Carbon;
use Hyperf\Utils\Codec\Json;

class PowerMeter
{
    protected string $message;

    public function __construct(string $message)
    {
        $this->message = $message;
    }

    public function extract()
    {
        $data = Json::decode($this->message);
        $rows = [];
        foreach($this->data() as $key) {
            $rows[$key] = $data[$key];
        }

        return [
            'power_meter' => array_merge([
                'terminal_time' => Carbon::now()->format('Y-m-d H:i:s'),
            ], $rows),
        ];
    }


    public function data() {
        $json = '{"phase_voltage_a": "0",
                "phase_voltage_b": "0",
                "phase_voltage_c": "0",
                "line_voltage_ab": "0",
                "line_voltage_bc": "0",
                "line_voltage_ca": "0",
                "phase_current_a": "0",
                "phase_current_b": "0",
                "phase_current_c": "0",
                "total_active_power": "0",
                "total_reactive_power": "0",
                "total_apperent_power": "0",
                "total_power_factor": "0",
                "frequency": "0",
                "total_kwh": "0",
                "total_kvarh": "0",
                "forward_kwh": "0",
                "backward_kwh": "0",
                "forward_kvarh": "0",
                "backward_kvarh": "0"}';

        $toarray = json_decode($json, true);
        $keys = array_keys($toarray);

        return $keys;
    }
}
