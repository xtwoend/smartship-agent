<?php

namespace App\Mqtt\Walio\CCR;

use Carbon\Carbon;
use Hyperf\Utils\Codec\Json;


class Cargo
{
    protected string $message;

    public function __construct(string $message) {
        $this->message = $message;
    }

    public function extract()
    {
        $data = Json::decode($this->message);
        
        $signal = $data['signal'];
        $value = $data['value'];
        if($signal === 'cargo_tank1') {
            $cargo_data = [
                // Tank 1
                'dw_pump_1_stb_current_transmitter' => (float) $value[0] ?: 0,
                'dwp_1_port_current_transmitter' => (float) $value[1] ?: 0,
                'level_cargo_1_stb' => (float) $value[2] ?: 0,
                'level_cargo_1_port' => (float) $value[3] ?: 0,
                'disch_pressure_dw_pump_1_stb_pressure' => (float) $value[4] ?: 0,
                'disch_pressure_dw_pump_1_port_pressure' => (float) $value[5] ?: 0,
                'stb_pressure_cargo_tank_1' => (float) $value[6] ?: 0,
                'port_pressure_cargo_tank_1' => (float) $value[7] ?: 0,
                'temperatur_in_sump_cargo_tank_1_stb' => (float) $value[8] ?: 0,
                'temperatur_at_50_cargo_tank_1_stb' => (float) $value[9] ?: 0,
                'temperatur_at_95_cargo_tank_1_stb' => (float) $value[10 ?: 0],
                'temperature_vapour_cargo_tank_1' => (float) $value[11 ?: 0],
                'temperature_in_sump_cargo_tank_1_port' => (float) $value[12 ?: 0],
                'tempertaure_at_50_cargo_tank_1_port' => (float) $value[13 ?: 0],
                'temperatur_at_95_cargo_tank_1_port' => (float) $value[14 ?: 0],
                'liq_fill_valve_cargo_tank_1_stb_positioner_transmitter' => (float) $value[15 ?: 0],
                'disch_valve_dw_pump_1_stb_positioner_transmitter' => (float) $value[16 ?: 0],
                'disc_valve_dw_pump_1_port_positioner_transmitter' => (float) $value[17 ?: 0],
                'liq_fill_valve_cargo_tank_1_port_positioner_transmitter' => (float) $value[18 ?: 0],
                'pressure_hold_space_1' => (float) $value[19 ?: 0],
            ];
        }elseif ($signal == 'cargo_tank2') {
            $cargo_data = [
                // Tank 2
                'dw_pump_2_stb_current_transmitter' => (float) $value[0] ?: 0,
                'dwp_2_port_current_transmitter' => (float) $value[1] ?: 0,
                'level_cargo_2_stb' => (float) $value[2] ?: 0,
                'level_cargo_2_port' => (float) $value[3] ?: 0,
                'disch_pressure_dw_pump_2_stb_pressure' => (float) $value[4] ?: 0,
                'disch_pressure_dw_pump_2_port_pressure' => (float) $value[5] ?: 0,
                'stb_pressure_cargo_tank_2' => (float) $value[6] ?: 0,
                'port_pressure_cargo_tank_2' => (float) $value[7] ?: 0,
                'temperatur_in_sump_cargo_tank_2_stb' => (float) $value[8] ?: 0,
                'temperatur_at_50_cargo_tank_2_stb' => (float) $value[9] ?: 0,
                'temperatur_at_95_cargo_tank_2_stb' => (float) $value[10 ?: 0],
                'temperature_vapour_cargo_tank_2' => (float) $value[11 ?: 0],
                'temperature_in_sump_cargo_tank_2_port' => (float) $value[12 ?: 0],
                'tempertaure_at_50_cargo_tank_2_port' => (float) $value[13 ?: 0],
                'temperatur_at_95_cargo_tank_2_port' => (float) $value[14 ?: 0],
                'liq_fill_valve_cargo_tank_2_stb_positioner_transmitter' => (float) $value[15 ?: 0],
                'disch_valve_dw_pump_2_stb_positioner_transmitter' => (float) $value[16 ?: 0],
                'disc_valve_dw_pump_2_port_positioner_transmitter' => (float) $value[17 ?: 0],
                'liq_fill_valve_cargo_tank_2_port_positioner_transmitter' => (float) $value[18 ?: 0],
                'pressure_hold_space_2' => (float) $value[19 ?: 0],
            ];
        }elseif ($signal == 'cargo_tank3') {
            $cargo_data = [
                // Tank 3
                'dw_pump_3_stb_current_transmitter' => (float) $value[0] ?: 0,
                'dwp_3_port_current_transmitter' => (float) $value[1] ?: 0,
                'level_cargo_3_stb' => (float) $value[2] ?: 0,
                'level_cargo_3_port' => (float) $value[3] ?: 0,
                'disch_pressure_dw_pump_3_stb_pressure' => (float) $value[4] ?: 0,
                'disch_pressure_dw_pump_3_port_pressure' => (float) $value[5] ?: 0,
                'stb_pressure_cargo_tank_3' => (float) $value[6] ?: 0,
                'port_pressure_cargo_tank_3' => (float) $value[7] ?: 0,
                'temperatur_in_sump_cargo_tank_3_stb' => (float) $value[8] ?: 0,
                'temperatur_at_50_cargo_tank_3_stb' => (float) $value[9] ?: 0,
                'temperatur_at_95_cargo_tank_3_stb' => (float) $value[10 ?: 0],
                'temperature_vapour_cargo_tank_3' => (float) $value[11 ?: 0],
                'temperature_in_sump_cargo_tank_3_port' => (float) $value[12 ?: 0],
                'tempertaure_at_50_cargo_tank_3_port' => (float) $value[13 ?: 0],
                'temperatur_at_95_cargo_tank_3_port' => (float) $value[14 ?: 0],
                'liq_fill_valve_cargo_tank_3_stb_positioner_transmitter' => (float) $value[15 ?: 0],
                'disch_valve_dw_pump_3_stb_positioner_transmitter' => (float) $value[16 ?: 0],
                'disc_valve_dw_pump_3_port_positioner_transmitter' => (float) $value[17 ?: 0],
                'liq_fill_valve_cargo_tank_3_port_positioner_transmitter' => (float) $value[18 ?: 0],
                'pressure_hold_space_3' => (float) $value[19 ?: 0],
            ];
        }elseif($signal == 'deck_tank1') {
            $cargo_data = [
                // Deck 1
                'presure_deck_tank_1'=> (float) $value[0] ?: 0,
                'level_deck_tank_1'=> (float) $value[1] ?: 0,
                'temperature_top_deck_tank_1'=> (float) $value[2] ?: 0,
                'temperature_bottom_deck_tank_1'=> (float) $value[3] ?: 0,
            ];
        }elseif($signal == 'deck_tank2') {
            $cargo_data = [
                // Deck 2
                'presure_deck_tank_2'=> (float) $value[0] ?: 0,
                'level_deck_tank_2'=> (float) $value[1] ?: 0,
                'temperature_top_deck_tank_2'=> (float) $value[2] ?: 0,
                'temperature_bottom_deck_tank_2'=> (float) $value[3] ?: 0,
            ];
        }elseif($signal == 'reliq_1') {
            $cargo_data = [
                // Reliq 1
                'compressor_reliq_1_current' => (float) $value[0] ?: 0,
                'suction_pressure_1_stage_reliq_1' => (float) $value[1] ?: 0,
                'disch_presure_1_stage_reliq_1' => (float) $value[2] ?: 0,
                'suction_pressure_2_stage_reliq_1' => (float) $value[3] ?: 0,
                'disch_pressure_2_stage_reliq_1' => (float) $value[4] ?: 0,
                'pressure_receiver_reliq_1' => (float) $value[5] ?: 0,
                'temperature_bulkhead_reliq_1' => (float) $value[6] ?: 0,
                'suction_temperature_1_stage_reliq_1' => (float) $value[7] ?: 0,
                'disch_temperature_1_stage_reliq_1' => (float) $value[8] ?: 0,
                'suction_temperature_2_stage_reliq_1' => (float) $value[9] ?: 0,
                'disch_temperature_2_stage_reliq_1' => (float) $value[10 ?: 0],
                'pressure_condensate_reliq_1_to_header' => (float) $value[11 ?: 0],
                'temperature_glycol_to_compressor_reliq_1' => (float) $value[12 ?: 0],
                'lubeoil_pressure_compressor_reliq_1' => (float) $value[13 ?: 0],
                'disch_presure_1_suction_pressure_1_stage_reliq_1' => (float) $value[14 ?: 0],
                'disch_presure_2_suction_pressure_2_stage_reliq_1' => (float) $value[15 ?: 0],
                'level_intercooler_reliq_1' => (float) $value[17 ?: 0],
                'level_receiver_reliq_1' => (float) $value[18 ?: 0],
            ];
        }elseif($signal == 'reliq_1') {
            $cargo_data = [
                // Reliq 2
                'compressor_reliq_2_current' => (float) $value[0] ?: 0,
                'suction_pressure_1_stage_reliq_2' => (float) $value[1] ?: 0,
                'disch_presure_1_stage_reliq_2' => (float) $value[2] ?: 0,
                'suction_pressure_2_stage_reliq_2' => (float) $value[3] ?: 0,
                'disch_pressure_2_stage_reliq_2' => (float) $value[4] ?: 0,
                'pressure_receiver_reliq_2' => (float) $value[5] ?: 0,
                'temperature_bulkhead_reliq_2' => (float) $value[6] ?: 0,
                'suction_temperature_1_stage_reliq_2' => (float) $value[7] ?: 0,
                'disch_temperature_1_stage_reliq_2' => (float) $value[8] ?: 0,
                'suction_temperature_2_stage_reliq_2' => (float) $value[9] ?: 0,
                'disch_temperature_2_stage_reliq_2' => (float) $value[10 ?: 0],
                'pressure_condensate_reliq_1_to_header' => (float) $value[11 ?: 0],
                'temperature_glycol_to_compressor_reliq_2' => (float) $value[12 ?: 0],
                'lubeoil_pressure_compressor_reliq_2' => (float) $value[13 ?: 0],
                'disch_presure_1_suction_pressure_1_stage_reliq_2' => (float) $value[14 ?: 0],
                'disch_presure_2_suction_pressure_2_stage_reliq_2' => (float) $value[15 ?: 0],
                'level_intercooler_reliq_2' => (float) $value[17 ?: 0],
                'level_receiver_reliq_2' => (float) $value[18 ?: 0],
            ];
        }elseif($signal == 'reliq_1') {
            $cargo_data = [
                // Reliq 3
                'compressor_reliq_3_current' => (float) $value[0] ?: 0,
                'suction_pressure_1_stage_reliq_3' => (float) $value[1] ?: 0,
                'disch_presure_1_stage_reliq_3' => (float) $value[2] ?: 0,
                'suction_pressure_2_stage_reliq_3' => (float) $value[3] ?: 0,
                'disch_pressure_2_stage_reliq_3' => (float) $value[4] ?: 0,
                'pressure_receiver_reliq_3' => (float) $value[5] ?: 0,
                'temperature_bulkhead_reliq_3' => (float) $value[6] ?: 0,
                'suction_temperature_1_stage_reliq_3' => (float) $value[7] ?: 0,
                'disch_temperature_1_stage_reliq_3' => (float) $value[8] ?: 0,
                'suction_temperature_2_stage_reliq_3' => (float) $value[9] ?: 0,
                'disch_temperature_2_stage_reliq_3' => (float) $value[10 ?: 0],
                'pressure_condensate_reliq_1_to_header' => (float) $value[11 ?: 0],
                'temperature_glycol_to_compressor_reliq_3' => (float) $value[12 ?: 0],
                'lubeoil_pressure_compressor_reliq_3' => (float) $value[13 ?: 0],
                'disch_presure_1_suction_pressure_1_stage_reliq_3' => (float) $value[14 ?: 0],
                'disch_presure_2_suction_pressure_2_stage_reliq_3' => (float) $value[15 ?: 0],
                'level_intercooler_reliq_3' => (float) $value[17 ?: 0],
                'level_receiver_reliq_3' => (float) $value[18 ?: 0],
            ];
        }elseif($signal == 'gy_cool') {
            $cargo_data = [
                // Gycool
                'pressure_difference_seawater' => (float) $value[0] ?: 0,
                'temperatur_seawater_outlet' => (float) $value[1] ?: 0,
                'inert_gas_generator_oxygen' => (float) $value[2] ?: 0,
                'inert_gas_generator_delivery' => (float) $value[3] ?: 0,
                'inert_gas_generator_pressure' => (float) $value[4] ?: 0,
                'esd_air_supply_pressure' => (float) $value[5] ?: 0,
                'glycol_cooling_temp_to_cargo_compressors' => (float) $value[6] ?: 0,
                'pressure_flydrelic_power_pack' => (float) $value[7] ?: 0,
            ];
        }elseif($signal == 'booster') {
            $cargo_data = [
                // booster
                'pressure_booster_pump_2' => (float) $value[4] ?: 0,
                'pressure_cargo_heater_outlet_to_vapour_header' => (float) $value[5] ?: 0,
                'cargo_heater_outlet_temperature' => (float) $value[6] ?: 0,
            ];
        }elseif($signal == 'cross_over') {
            $cargo_data = [
                // Crossover
                'pressure_vapour_line_cross_over_1' => (float) $value[0] ?: 0,
                'pressure_vapour_line_cross_over_2' => (float) $value[1] ?: 0,
                'pressure_liq_cross_over_1' => (float) $value[2] ?: 0,
                'pressure_liq_cross_over_2' => (float) $value[3] ?: 0,
                'temperature_liq_cross_over_1' => (float) $value[4] ?: 0,
                'temperature_liq_cross_over_2' => (float) $value[5] ?: 0,
            ];
        }

        $cargo_data['terminal_time'] = Carbon::now()->format('Y-m-d H:i:s');
       
        return [
            'cargo' => $cargo_data
        ];
    }
}