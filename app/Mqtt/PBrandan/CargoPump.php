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
namespace App\Mqtt\PBrandan;

use Carbon\Carbon;
use Hyperf\Utils\Codec\Json;

class CargoPump
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
                'pump_latest_update_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'cargo_pump1_run' => $data['cargo_pump1_run'],
                'cargo_pump1_alarm' => $data['cargo_pump1_alarm'],
                'cargo_pump2_run' => $data['cargo_pump2_run'],
                'cargo_pump2_alarm' => $data['cargo_pump2_alarm'],
                'cargo_pump3_run' => $data['cargo_pump3_run'],
                'cargo_pump3_alarm' => $data['cargo_pump3_alarm'],
                'ballast_pump1_run' => $data['ballast_pump1_run'],
                'ballast_pump1_alarm' => $data['ballast_pump1_alarm'],
                'ballast_pump2_run' => $data['ballast_pump2_run'],
                'ballast_pump2_alarm' => $data['ballast_pump2_alarm'],
                'stripping_pump_run' => $data['stripping_pump_run'],
                'stripping_pump_alarm' => $data['stripping_pump_alarm'],
                'cleaningtank_pump_run' => $data['cleaningtank_pump_run'],
                'cleaningtank_pump_alarm' => $data['cleaningtank_pump_alarm'],
            ],
        ];
    }
}
