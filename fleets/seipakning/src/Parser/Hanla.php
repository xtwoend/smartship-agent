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
namespace Smartship\Seipakning\Parser;

use Carbon\Carbon;
use Hyperf\Utils\Codec\Json;

class Hanla
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
                'terminal_time' => (string) Carbon::now()->format('Y-m-d H:i:s'),
                'tank_1_port' => (float) $data['NO_1_CARGO_TANK_P'],
                'tank_1_port_temp' => (float) $data['TEMP_1CTP'],
                'tank_1_stb' => (float) $data['NO_1_CARGO_TANK_S'],
                'tank_1_stb_temp' => (float) $data['TEMP_1CTS'],
                'tank_2_port' => (float) $data['NO_2_CARGO_TANK_P'],
                'tank_2_port_temp' => (float) $data['TEMP_2CTP'],
                'tank_2_stb' => (float) $data['NO_2_CARGO_TANK_S'],
                'tank_2_stb_temp' => (float) $data['TEMP_2CTS'],
                'tank_3_port' => (float) $data['NO_3_CARGO_TANK_P'],
                'tank_3_port_temp' => (float) $data['TEMP_3CTP'],
                'tank_3_stb' => (float) $data['NO_3_CARGO_TANK_S'],
                'tank_3_stb_temp' => (float) $data['TEMP_3CTS'],
                'tank_4_port' => (float) $data['NO_4_CARGO_TANK_P'],
                'tank_4_port_temp' => (float) $data['TEMP_4CTP'],
                'tank_4_stb' => (float) $data['NO_4_CARGO_TANK_S'],
                'tank_4_stb_temp' => (float) $data['TEMP_4CTS'],
                'tank_5_port' => (float) $data['NO_5_CARGO_TANK_P'],
                'tank_5_port_temp' => (float) $data['TEMP_5CTP'],
                'tank_5_stb' => (float) $data['NO_5_CARGO_TANK_S'],
                'tank_5_stb_temp' => (float) $data['TEMP_5CTS'],
                'tank_6_port' => (float) $data['NO_6_CARGO_TANK_P'],
                'tank_6_port_temp' => (float) $data['TEMP_6CTP'],
                'tank_6_stb' => (float) $data['NO_6_CARGO_TANK_S'],
                'tank_6_stb_temp' => (float) $data['TEMP_6CTS'],
                'slop_port' => (float) $data['SLOP_CARGO_TANK_P'],
                'slop_port_temp' => (float) $data['TEMP_SCTP'],
                'slop_stb' => (float) $data['SLOP_CARGO_TANK_S'],
                'slop_stb_temp' => (float) $data['TEMP_SCTS'],
                'draft_front' => (float) $data['DRAF_DEPAN'],
                'draft_center_left' => (float) $data['DRAF_TENGAH_KIRI'],
                'draft_center_right' => (float) $data['DRAF_TENGAH_KANAN'],
                'draft_rear' => (float) $data['DRAF_BELAKANG'],
                'fore_peak' => (float) $data['F_P_T_C'],
                'water_ballas_1_port' => (float) $data['NO_1_WBT_P'],
                'water_ballas_1_stb' => (float) $data['NO_1_WBT_S'],
                'water_ballas_2_port' => (float) $data['NO_2_WBT_P'],
                'water_ballas_2_stb' => (float) $data['NO_2_WBT_S'],
                'water_ballas_3_port' => (float) $data['NO_3_WBT_P'],
                'water_ballas_3_stb' => (float) $data['NO_3_WBT_S'],
                'water_ballas_4_port' => (float) $data['NO_4_WBT_P'],
                'water_ballas_4_stb' => (float) $data['NO_4_WBT_S'],
                'water_ballas_5_port' => (float) $data['NO_5_WBT_P'],
                'water_ballas_5_stb' => (float) $data['NO_5_WBT_S'],
                'water_ballas_6_port' => (float) $data['NO_6_WBT_P'],
                'water_ballas_6_stb' => (float) $data['NO_6_WBT_S'],
                'after_peak' => (float) $data['A_P_T_C'],

                'fuel_oil_1_port' => (float) $data['NO_1_FOT_P'],
                'fuel_oil_1_stb' => (float) $data['NO_1_FOT_S'],
                'fuel_oil_2_port' => (float) $data['NO_2_FOT_P'],
                'fuel_oil_2_stb' => (float) $data['NO_2_FOT_S'],

                'muel_oil_1_port' => (float) $data['NO_1_MDOT_P'],
                'muel_oil_1_stb' => (float) $data['NO_1_MDOT_S'],
                'muel_oil_2_port' => (float) $data['NO_2_MDOT_P'],

                'do_fuel_oil_service_stb' => (float) $data['D_O_SERV_T_S'],
                'do_fuel_oil_settling_stb' => (float) $data['D_O_SETT_T_S'],
                'fuel_oil_service_port' => (float) $data['FUEL_O_SERV_T_P'],
                'fuel_oil_settling_port' => (float) $data['FUEL_O_SETT_T_P'],
                'ls_fuel_oil_service_port' => (float) $data['LOW_SULP_FUEL_O_SERV_T_P'],
                'ls_fuel_oil_settling_port' => (float) $data['LOW_SULP_FUEL_O_SETT_T_P'],
            ],
        ];
    }
}
