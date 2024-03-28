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
namespace App\Mqtt\Gerong\CCR;

use Hyperf\Utils\Codec\Json;

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
                'cargo_pump1_run' => (bool) isset($data['cargo_pump1_run']) ? $data['cargo_pump1_run'] : false,
                'cargo_pump1_alarm' => (bool) isset($data['cargo_pump1_alarm']) ? $data['cargo_pump1_alarm'] : false,
                'cargo_pump2_run' => (bool) isset($data['cargo_pump2_run']) ? $data['cargo_pump2_run'] : false,
                'cargo_pump2_alarm' => (bool) isset($data['cargo_pump2_alarm']) ? $data['cargo_pump2_alarm'] : false,
                'cargo_pump3_run' => (bool) isset($data['cargo_pump3_run']) ? $data['cargo_pump3_run'] : false,
                'cargo_pump3_alarm' => (bool) isset($data['cargo_pump3_alarm']) ? $data['cargo_pump3_alarm'] : false,

                'ballast_pump1_run' => (bool) isset($data['ballast_pump1_run']) ? $data['ballast_pump1_run'] : false,
                'ballast_pump1_alarm' => (bool) isset($data['ballast_pump1_alarm']) ? $data['ballast_pump1_alarm'] : false,
                'ballast_pump2_run' => (bool) isset($data['ballast_pump2_run']) ? $data['ballast_pump2_run'] : false,
                'ballast_pump2_alarm' => (bool) isset($data['ballast_pump2_alarm']) ? $data['ballast_pump2_alarm'] : false,

                'stripping_pump_run' => (bool) isset($data['stripping_pump_run']) ? $data['stripping_pump_run'] : false,
                'stripping_pump_alarm' => (bool) isset($data['stripping_pump_alarm']) ? $data['stripping_pump_alarm'] : false,
            ],
        ];
    }
}
