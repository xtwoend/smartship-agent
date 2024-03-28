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
namespace App\Mqtt\Walio\ECR;

use Carbon\Carbon;
use Hyperf\Utils\Codec\Json;

class Engine
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
                'terminal_time' => Carbon::now()->format('Y-m-d H:i:s'),
                'me_tc_rpm_indicator' => (float) $data['me_tc_rpm_indicator'],
                'ai_hfo_bunker' => (float) $data['ai_hfo_bunker'],
                'ai_fwd_hfo_bunker' => (float) $data['ai_fwd_hfo_bunker'],
                'ai_ls_hfo_bunker' => (float) $data['ai_ls_hfo_bunker'],
                'ai_hfo_service' => (float) $data['ai_hfo_service'],
                'ai_hfo_settling' => (float) $data['ai_hfo_settling'],
                'ai_ls_hfo_settling' => (float) $data['ai_ls_hfo_settling'],
                'ai_mdo_storage' => (float) $data['ai_mdo_storage'],
                'ai_mdo_service' => (float) $data['ai_mdo_service'],
                'ai_igg_fuel' => (float) $data['ai_igg_fuel'],
                'me_fo_inlet_engine' => (float) $data['me_fo_inlet_engine'],
                'me_lo_inlet_press' => (float) $data['me_lo_inlet_press'],
                'me_scav_air_inlet_press' => (float) $data['me_scav_air_inlet_press'],
                'me_jcfw_inlet_press' => (float) $data['me_jcfw_inlet_press'],
                'me_starting_air_inlet_press' => (float) $data['me_starting_air_inlet_press'],
                'me_cont_air_inlet_press' => (float) $data['me_cont_air_inlet_press'],
                'hfo_bunker_tank' => (float) $data['hfo_bunker_tank'],
                'fwd_hfo_bunker_tank' => (float) $data['fwd_hfo_bunker_tank'],
                'ls_hfo_bunker_tank' => (float) $data['ls_hfo_bunker_tank'],
                'hfo_service_tank' => (float) $data['hfo_service_tank'],
                'ls_hfo_service_tank' => (float) $data['ls_hfo_service_tank'],
                'hfo_settling_tank' => (float) $data['hfo_settling_tank'],
                'ls_hfo_settling_tank' => (float) $data['ls_hfo_settling_tank'],
                'mdo_storage_tank' => (float) $data['mdo_storage_tank'],
                'mdo_service_tank' => (float) $data['mdo_service_tank'],
                'igg_fuel_tank' => (float) $data['igg_fuel_tank'],
                'rpm_me' => (float) $data['rpm_me'],
            ],
        ];
    }
}
