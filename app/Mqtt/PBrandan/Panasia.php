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

class Panasia
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
                'terminal_time' => Carbon::now()->format('Y-m-d H:i:s'),
                'no1_cotp_ullage' => $data['no1_cotp_ullage'],
                'no1_cotp_temp' => $data['no1_cotp_temp'],
                'no1_cots_ullage' => $data['no1_cots_ullage'],
                'no1_cots_temp' => $data['no1_cots_temp'],
                'no2_cotp_ullage' => $data['no2_cotp_ullage'],
                'no2_cotp_temp' => $data['no2_cotp_temp'],
                'no2_cots_ullage' => $data['no2_cots_ullage'],
                'no2_cots_temp' => $data['no2_cots_temp'],
                'no3_cotp_ullage' => $data['no3_cotp_ullage'],
                'no3_cotp_temp' => $data['no3_cotp_temp'],
                'no3_cots_ullage' => $data['no3_cots_ullage'],
                'no3_cots_temp' => $data['no3_cots_temp'],
                'no4_cotp_ullage' => $data['no4_cotp_ullage'],
                'no4_cotp_temp' => $data['no4_cotp_temp'],
                'no4_cots_ullage' => $data['no4_cots_ullage'],
                'no4_cots_temp' => $data['no4_cots_temp'],
                'no5_cotp_ullage' => $data['no5_cotp_ullage'],
                'no5_cotp_temp' => $data['no5_cotp_temp'],
                'no5_cots_ullage' => $data['no5_cots_ullage'],
                'no5_cots_temp' => $data['no5_cots_temp'],
                'slop_tank_p_ullage' => $data['slop_tank_p_ullage'],
                'slop_tank_p_temp' => $data['slop_tank_p_temp'],
                'slop_tank_s_ullage' => $data['slop_tank_s_ullage'],
                'slop_tank_s_temp' => $data['slop_tank_s_temp'],
                'no1_wbtp__level' => $data['no1_wbtp__level'],
                'no1_wbts_level' => $data['no1_wbts_level'],
                'no2_wbtp_level' => $data['no2_wbtp_level'],
                'no2_wbts_level' => $data['no2_wbts_level'],
                'no3_wbtp_level' => $data['no3_wbtp_level'],
                'no3_wbts_level' => $data['no3_wbts_level'],
                'no4_wbtp_level' => $data['no4_wbtp_level'],
                'no4_wbts_level' => $data['no4_wbts_level'],
                'no5_wbtp_level' => $data['no5_wbtp_level'],
                'no5_wbts_level' => $data['no5_wbts_level'],
                'no6_wbtp_level' => $data['no6_wbtp_level'],
                'no6_wbts_level' => $data['no6_wbts_level'],
                'fptk' => $data['fptk'],
                'aptk' => $data['aptk'],
            ],
        ];
    }
}
