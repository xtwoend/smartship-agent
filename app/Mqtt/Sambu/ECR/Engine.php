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
namespace App\Mqtt\Sambu\ECR;

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
                'control_air_inlet' => (float) (($data['control_air_inlet'] / 27648) * 10) ?: 0,
                'me_ac_cw_inlet_cooler' => (float) (($data['me_ac_cw_inlet_cooler'] / 27648) * 4) ?: 0,
                'jcw_inlet' => (float) (($data['jcw_inlet'] / 27648) * 6) ?: 0,
                'me_lo_inlet' => (float) (($data['me_lo_inlet_to_turb'] / 27648) * 6) ?: 0,
                'scav_air_receiver' => (float) (($data['scav_air_receiver'] / 27648) * 6) ?: 0,
                'start_air_inlet' => (float) (($data['start_air_inlet'] / 27648) * 40) ?: 0,
                'main_lub_oil' => (float) (($data['main_lub_oil'] / 27648) * 6) ?: 0,
                'me_fo_inlet_engine' => (float) (($data['me_fo_inlet_engine'] / 27648) * 16) ?: 0,
                'turbo_charger_speed_no_1' => (float) (($data['no1_dg_turbo_charger_speed'] / 27648) * 94000) ?: 0,
                'turbo_charger_speed_no_2' => (float) (($data['no2_dg_turbo_charger_speed'] / 27648) * 94000) ?: 0,
                'turbo_charger_speed_no_3' => (float) (($data['no3_dg_turbo_charger_speed'] / 27648) * 94000) ?: 0,
                'tachometer_turbocharge' => (float) $data['tachometer_turbocharge'] ?: 0,
                'main_engine_speed' => (float) isset($data['RIO_AI2_3X23']) ? $data['RIO_AI2_3X23'] : 0,
            ],
        ];
    }
}
