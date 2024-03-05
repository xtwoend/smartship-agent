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
namespace App\Mqtt\Parigi;

use Carbon\Carbon;
use Hyperf\Utils\Codec\Json;

class Bunker
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
                'bunker_timestamp' => Carbon::now()->format('Y-m-d H:i:s'),
                'mdo_tank_1p' => (float) $data['mdo_tank_1p'],
                'mdo_tank_2p' => (float) $data['mdo_tank_2p'],
                'mdo_day_tank_1p' => (float) $data['mdo_day_tank_1p'],
                'mdo_day_tank_2s' => (float) $data['mdo_day_tank_2s'],
                'hfo_tank_1p' => (float) $data['hfo_tank_1p'],
                'hfo_tank_2s' => (float) $data['hfo_tank_2s'],
                'hfo_day_tank_1p' => (float) $data['hfo_day_tank_1p'],
                'hfo_day_tank_2s' => (float) $data['hfo_day_tank_2s'],
                'hfo_setting_tank' => (float) $data['hfo_setting_tank'],
                'mdo_setting_tank' => (float) $data['mdo_setting_tank'],
            ],
        ];
    }
}
