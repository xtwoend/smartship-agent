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
namespace App\Mqtt\Pagerungan;

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
            'engine' => [
                // 'terminal_time' => Carbon::now()->format('Y-m-d H:i:s'),
                'hfo_storage_tank_1p' => $data['hfo_storage_tank_1p'],
                'hfo_storage_tank_1s' => $data['hfo_storage_tank_1s'],
                'hfo_storage_tank_2p' => $data['hfo_storage_tank_2p'],
                'hfo_storage_tank_2s' => $data['hfo_storage_tank_2s'],
                'hfo_setting_tank' => $data['hfo_setting_tank'],
                'hfo_service_tank_1' => $data['hfo_service_tank_1'],
                'hfo_service_tank_2' => $data['hfo_service_tank_2'],
                'mdo_storage_tank_p' => $data['mdo_storage_tank_p'],
                'mdo_storage_tank_s' => $data['mdo_storage_tank_s'],
                'mdo_setting_tank' => $data['mdo_setting_tank'],
                'mdo_service_tank_1' => $data['mdo_service_tank_1'],
                'mdo_service_tank_2' => $data['mdo_service_tank_2'],
            ],
        ];
    }
}
