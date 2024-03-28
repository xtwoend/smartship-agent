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
namespace App\Mqtt\Kakap;

use Carbon\Carbon;
use Hyperf\Utils\Codec\Json;
use Hyperf\Utils\Str;

class Hanla
{
    protected string $message;

    protected $mappArray = [
        'NO_1_CARGO_TANK_P',
        'TEMP_1CTP',
        'NO_1_CARGO_TANK_S',
        'TEMP_1CTS',
        'NO_2_CARGO_TANK_P',
        'TEMP_2CTP',
        'NO_2_CARGO_TANK_S',
        'TEMP_2CTS',
        'NO_3_CARGO_TANK_P',
        'TEMP_3CTP',
        'NO_3_CARGO_TANK_S',
        'TEMP_3CTM',
        'NO_4_CARGO_TANK_P',
        'TEMP_4CTP',
        'NO_4_CARGO_TANK_S',
        'TEMP_4CTS',
        'NO_5_CARGO_TANK_P',
        'TEMP_5CTP',
        'NO_5_CARGO_TANK_S',
        'TEMP_5CTS',
        'SLOP_TANK_P',
        'TEMP_STP',
        'SLOP_TANK_S',
        'TEMP_STS',
    ];

    public function __construct(string $message)
    {
        $this->message = $message;
    }

    public function extract()
    {
        $data = Json::decode($this->message);

        return [
            'cargo' => [
                'terminal_time' => Carbon::now()->format('Y-m-d H:i:s'),
                'no_1_cargo_tank_p' => (float) $data['NO_1_CARGO_TANK_P'],
                'temp_1ctp' => (float) $data['TEMP_1CTP'],
                'no_1_cargo_tank_s' => (float) $data['NO_1_CARGO_TANK_S'],
                'temp_1cts' => (float) $data['TEMP_1CTS'],
                'no_2_cargo_tank_p' => (float) $data['NO_2_CARGO_TANK_P'],
                'temp_2ctp' => (float) $data['TEMP_2CTP'],
                'no_2_cargo_tank_s' => (float) $data['NO_2_CARGO_TANK_S'],
                'temp_2cts' => (float) $data['TEMP_2CTS'],
                'no_3_cargo_tank_p' => (float) $data['NO_3_CARGO_TANK_P'],
                'temp_3ctp' => (float) $data['TEMP_3CTP'],
                'no_3_cargo_tank_s' => (float) $data['NO_3_CARGO_TANK_S'],
                'temp_3ctm' => (float) $data['TEMP_3CTM'],
                'no_4_cargo_tank_p' => (float) ($data['NO_4_CARGO_TANK_P'] / 100000),
                'temp_4ctp' => (float) $data['TEMP_4CTP'],
                'no_4_cargo_tank_s' => (float) ($data['NO_4_CARGO_TANK_S'] / 100000),
                'temp_4cts' => (float) $data['TEMP_4CTS'],
                'no_5_cargo_tank_p' => (float) $data['NO_5_CARGO_TANK_P'],
                'temp_5ctp' => (float) $data['TEMP_5CTP'],
                'no_5_cargo_tank_s' => (float) $data['NO_5_CARGO_TANK_S'],
                'temp_5cts' => (float) $data['TEMP_5CTS'],
                'slop_tank_p' => (float) $data['SLOP_TANK_P'],
                'temp_stp' => (float) $data['TEMP_STP'],
                'slop_tank_s' => (float) ($data['SLOP_TANK_S'] / 100000),
                'temp_sts' => (float) $data['TEMP_STS'],
            ],
        ];
    }

    public function arrayToSnake(): array
    {
        $snake = [];
        foreach ($this->mappArray as $in => $val) {
            if (is_null($val)) {
                continue;
            }
            $key = Str::snake(strtolower($val));
            $snake[$key] = $val;
        }
        return $snake;
    }
}
