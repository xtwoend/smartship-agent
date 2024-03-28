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
use Hyperf\Utils\Str;

class PumpStatus
{
    protected string $message;

    protected $mappArray = [
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
                'pump_latest_update_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'cargo_pump1_run' => $data['cargo_pump1_run'],
                'cargo_pump2_run' => $data['cargo_pump2_run'],
                'cargo_pump3_run' => $data['cargo_pump3_run'],
                'ballast_pump1_run' => $data['wballast_pump1_run'],
                'ballast_pump2_run' => $data['wballast_pump2_run'],
                'tk_cleanning_pump_run' => $data['tank_cleaning_pump_run'],
                'stripping_pump_run' => $data['stripping_pump_run'],
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
