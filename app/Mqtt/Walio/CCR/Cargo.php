<?php

namespace App\Mqtt\Walio\CCR;

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
                'dw_pump_1_stb_current_transmitter' => $value[0],
                'dwp_1_port_current_transmitter' => $value[1],
                'level_cargo_1_stb' => $value[2],
                'level_cargo_1_port' => $value[3],
                'disch_pressure_dw_pump_1_stb_pressure' => $value[4],
                'disch_pressure_dw_pump_1_port_pressure' => $value[5],
                'stb_pressure_cargo_tank_1' => $value[6],
                'port_pressure_cargo_tank_1' => $value[7],
                'temperatur_in_sump_cargo_tank_1_stb' => $value[8],
                'temperatur_at_50_cargo_tank_1_stb' => $value[9],
                'temperatur_at_95_cargo_tank_1_stb' => $value[10],
                'temperature_vapour_cargo_tank_1' => $value[11],
                'temperature_in_sump_cargo_tank_1_port' => $value[12],
                'tempertaure_at_50_cargo_tank_1_port' => $value[13],
                'temperatur_at_95_cargo_tank_1_port' => $value[14],
                'liq_fill_valve_cargo_tank_1_stb_positioner_transmitter' => $value[15],
                'disch_valve_dw_pump_1_stb_positioner_transmitter' => $value[16],
                'disc_valve_dw_pump_1_port_positioner_transmitter' => $value[17],
                'liq_fill_valve_cargo_tank_1_port_positioner_transmitter' => $value[18],
                'pressure_hold_space_1' => $value[19],
            ];
        }elseif ($signal == 'cargo_tank2') {
            $cargo_data = [
                // Tank 2
                'dw_pump_2_stb_current_transmitter' => $value[0],
                'dwp_2_port_current_transmitter' => $value[1],
                'level_cargo_2_stb' => $value[2],
                'level_cargo_2_port' => $value[3],
                'disch_pressure_dw_pump_2_stb_pressure' => $value[4],
                'disch_pressure_dw_pump_2_port_pressure' => $value[5],
                'stb_pressure_cargo_tank_2' => $value[6],
                'port_pressure_cargo_tank_2' => $value[7],
                'temperatur_in_sump_cargo_tank_2_stb' => $value[8],
                'temperatur_at_50_cargo_tank_2_stb' => $value[9],
                'temperatur_at_95_cargo_tank_2_stb' => $value[10],
                'temperature_vapour_cargo_tank_2' => $value[11],
                'temperature_in_sump_cargo_tank_2_port' => $value[12],
                'tempertaure_at_50_cargo_tank_2_port' => $value[13],
                'temperatur_at_95_cargo_tank_2_port' => $value[14],
                'liq_fill_valve_cargo_tank_2_stb_positioner_transmitter' => $value[15],
                'disch_valve_dw_pump_2_stb_positioner_transmitter' => $value[16],
                'disc_valve_dw_pump_2_port_positioner_transmitter' => $value[17],
                'liq_fill_valve_cargo_tank_2_port_positioner_transmitter' => $value[18],
                'pressure_hold_space_2' => $value[19],
            ];
        }elseif ($signal == 'cargo_tank3') {
            $cargo_data = [
                // Tank 3
                'dw_pump_3_stb_current_transmitter' => $value[0],
                'dwp_3_port_current_transmitter' => $value[1],
                'level_cargo_3_stb' => $value[2],
                'level_cargo_3_port' => $value[3],
                'disch_pressure_dw_pump_3_stb_pressure' => $value[4],
                'disch_pressure_dw_pump_3_port_pressure' => $value[5],
                'stb_pressure_cargo_tank_3' => $value[6],
                'port_pressure_cargo_tank_3' => $value[7],
                'temperatur_in_sump_cargo_tank_3_stb' => $value[8],
                'temperatur_at_50_cargo_tank_3_stb' => $value[9],
                'temperatur_at_95_cargo_tank_3_stb' => $value[10],
                'temperature_vapour_cargo_tank_3' => $value[11],
                'temperature_in_sump_cargo_tank_3_port' => $value[12],
                'tempertaure_at_50_cargo_tank_3_port' => $value[13],
                'temperatur_at_95_cargo_tank_3_port' => $value[14],
                'liq_fill_valve_cargo_tank_3_stb_positioner_transmitter' => $value[15],
                'disch_valve_dw_pump_3_stb_positioner_transmitter' => $value[16],
                'disc_valve_dw_pump_3_port_positioner_transmitter' => $value[17],
                'liq_fill_valve_cargo_tank_3_port_positioner_transmitter' => $value[18],
                'pressure_hold_space_3' => $value[19],
            ];
        }elseif($signal == 'deck_tank1') {
            $cargo_data = [
                // Deck 1
                'presure_deck_tank_1'=> $value[0],
                'level_deck_tank_1'=> $value[1],
                'temperature_top_deck_tank_1'=> $value[2],
                'temperature_bottom_deck_tank_1'=> $value[3],
            ];
        }elseif($signal == 'deck_tank2') {
            $cargo_data = [
                // Deck 2
                'presure_deck_tank_2'=> $value[0],
                'level_deck_tank_2'=> $value[1],
                'temperature_top_deck_tank_2'=> $value[2],
                'temperature_bottom_deck_tank_2'=> $value[3],
            ];
        }elseif($signal == 'reliq_1') {
            $cargo_data = [
                // Reliq 1
                'compressor_reliq_1_current' => $value[0],
                'suction_pressure_1_stage_reliq_1' => $value[1],
                'disch_presure_1_stage_reliq_1' => $value[2],
                'suction_pressure_2_stage_reliq_1' => $value[3],
                'disch_pressure_2_stage_reliq_1' => $value[4],
                'pressure_receiver_reliq_1' => $value[5],
                'temperature_bulkhead_reliq_1' => $value[6],
                'suction_temperature_1_stage_reliq_1' => $value[7],
                'disch_temperature_1_stage_reliq_1' => $value[8],
                'suction_temperature_2_stage_reliq_1' => $value[9],
                'disch_temperature_2_stage_reliq_1' => $value[10],
                'pressure_condensate_reliq_1_to_header' => $value[11],
                'temperature_glycol_to_compressor_reliq_1' => $value[12],
                'lubeoil_pressure_compressor_reliq_1' => $value[13],
                'disch_presure_1_suction_pressure_1_stage_reliq_1' => $value[14],
                'disch_presure_2_suction_pressure_2_stage_reliq_1' => $value[15],
                'level_intercooler_reliq_1' => $value[17],
                'level_receiver_reliq_1' => $value[18],
            ];
        }elseif($signal == 'reliq_1') {
            $cargo_data = [
                // Reliq 2
                'compressor_reliq_2_current' => $value[0],
                'suction_pressure_1_stage_reliq_2' => $value[1],
                'disch_presure_1_stage_reliq_2' => $value[2],
                'suction_pressure_2_stage_reliq_2' => $value[3],
                'disch_pressure_2_stage_reliq_2' => $value[4],
                'pressure_receiver_reliq_2' => $value[5],
                'temperature_bulkhead_reliq_2' => $value[6],
                'suction_temperature_1_stage_reliq_2' => $value[7],
                'disch_temperature_1_stage_reliq_2' => $value[8],
                'suction_temperature_2_stage_reliq_2' => $value[9],
                'disch_temperature_2_stage_reliq_2' => $value[10],
                'pressure_condensate_reliq_1_to_header' => $value[11],
                'temperature_glycol_to_compressor_reliq_2' => $value[12],
                'lubeoil_pressure_compressor_reliq_2' => $value[13],
                'disch_presure_1_suction_pressure_1_stage_reliq_2' => $value[14],
                'disch_presure_2_suction_pressure_2_stage_reliq_2' => $value[15],
                'level_intercooler_reliq_2' => $value[17],
                'level_receiver_reliq_2' => $value[18],
            ];
        }elseif($signal == 'reliq_1') {
            $cargo_data = [
                // Reliq 3
                'compressor_reliq_3_current' => $value[0],
                'suction_pressure_1_stage_reliq_3' => $value[1],
                'disch_presure_1_stage_reliq_3' => $value[2],
                'suction_pressure_2_stage_reliq_3' => $value[3],
                'disch_pressure_2_stage_reliq_3' => $value[4],
                'pressure_receiver_reliq_3' => $value[5],
                'temperature_bulkhead_reliq_3' => $value[6],
                'suction_temperature_1_stage_reliq_3' => $value[7],
                'disch_temperature_1_stage_reliq_3' => $value[8],
                'suction_temperature_2_stage_reliq_3' => $value[9],
                'disch_temperature_2_stage_reliq_3' => $value[10],
                'pressure_condensate_reliq_1_to_header' => $value[11],
                'temperature_glycol_to_compressor_reliq_3' => $value[12],
                'lubeoil_pressure_compressor_reliq_3' => $value[13],
                'disch_presure_1_suction_pressure_1_stage_reliq_3' => $value[14],
                'disch_presure_2_suction_pressure_2_stage_reliq_3' => $value[15],
                'level_intercooler_reliq_3' => $value[17],
                'level_receiver_reliq_3' => $value[18],
            ];
        }elseif($signal == 'gy_cool') {
            $cargo_data = [
                // Gycool
                'pressure_difference_seawater' => $value[0],
                'temperatur_seawater_outlet' => $value[1],
                'inert_gas_generator_oxygen' => $value[2],
                'inert_gas_generator_delivery' => $value[3],
                'inert_gas_generator_pressure' => $value[4],
                'esd_air_supply_pressure' => $value[5],
                'glycol_cooling_temp_to_cargo_compressors' => $value[6],
                'pressure_flydrelic_power_pack' => $value[7],
            ];
        }elseif($signal == 'booster') {
            $cargo_data = [
                // booster
                'pressure_booster_pump_2' => $value[4],
                'pressure_cargo_heater_outlet_to_vapour_header' => $value[5],
                'cargo_heater_outlet_temperature' => $value[6],
            ];
        }elseif($signal == 'cross_over') {
            $cargo_data = [
                // Crossover
                'pressure_vapour_line_cross_over_1' => $value[0],
                'pressure_vapour_line_cross_over_2' => $value[1],
                'pressure_liq_cross_over_1' => $value[2],
                'pressure_liq_cross_over_2' => $value[3],
                'temperature_liq_cross_over_1' => $value[4],
                'temperature_liq_cross_over_2' => $value[5],
            ];
        }

        $cargo_data['terminal_time'] = Carbon::now();

        return [
            'cargo' => $cargo_data
        ];
    }
}