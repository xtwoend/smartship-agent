<?php

declare(strict_types=1);

namespace App\Model\Cargo;

use Hyperf\Database\Schema\Schema;
use Hyperf\DbConnection\Model\Model;
use Hyperf\Database\Schema\Blueprint;
use Carbon\Carbon;

class WalioLog extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'cargo_log';

    /**
     * The connection name for the model.
     */
    protected ?string $connection = 'default';

    /**
     * all 
     */
    protected array $guarded = ['id']; 

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = [
        'terminal_time' => 'datetime',
    ];

    // create table cargo if not found table
    public static function table($fleetId, $date = null)
    {
        $date = is_null($date) ? date('Ym'): Carbon::parse($date)->format('Ym');
        $model = new self;
        $tableName = $model->getTable() . "_{$fleetId}_{$date}";
        
        if(! Schema::hasTable($tableName)) {
            Schema::create($tableName, function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('fleet_id')->index();
                $table->datetime('terminal_time')->unique();
                $table->float('dw_pump_1_stb_current_transmitter', 10, 3)->default(0);
                $table->float('dwp_1_port_current_transmitter', 10, 3)->default(0);
                $table->float('level_cargo_1_stb', 10, 3)->default(0);
                $table->float('level_cargo_1_port', 10, 3)->default(0);
                $table->float('disch_pressure_dw_pump_1_stb_pressure', 10, 3)->default(0);
                $table->float('disch_pressure_dw_pump_1_port_pressure', 10, 3)->default(0);
                $table->float('stb_pressure_cargo_tank_1', 10, 3)->default(0);
                $table->float('port_pressure_cargo_tank_1', 10, 3)->default(0);
                $table->float('temperatur_in_sump_cargo_tank_1_stb', 10, 3)->default(0);
                $table->float('temperatur_at_50_cargo_tank_1_stb', 10, 3)->default(0);
                $table->float('temperatur_at_95_cargo_tank_1_stb', 10, 3)->default(0);
                $table->float('temperature_vapour_cargo_tank_1', 10, 3)->default(0);
                $table->float('temperature_in_sump_cargo_tank_1_port', 10, 3)->default(0);
                $table->float('tempertaure_at_50_cargo_tank_1_port', 10, 3)->default(0);
                $table->float('temperatur_at_95_cargo_tank_1_port', 10, 3)->default(0);
                $table->float('liq_fill_valve_cargo_tank_1_stb_positioner_transmitter', 10, 3)->default(0);
                $table->float('disch_valve_dw_pump_1_stb_positioner_transmitter', 10, 3)->default(0);
                $table->float('disc_valve_dw_pump_1_port_positioner_transmitter', 10, 3)->default(0);
                $table->float('liq_fill_valve_cargo_tank_1_port_positioner_transmitter', 10, 3)->default(0);
                $table->float('pressure_hold_space_1', 10, 3)->default(0);

                $table->float('dw_pump_2_stb_current_transmitter', 10, 3)->default(0);
                $table->float('dwp_2_port_current_transmitter', 10, 3)->default(0);
                $table->float('level_cargo_2_stb', 10, 3)->default(0);
                $table->float('level_cargo_2_port', 10, 3)->default(0);
                $table->float('disch_pressure_dw_pump_2_stb_pressure', 10, 3)->default(0);
                $table->float('disch_pressure_dw_pump_2_port_pressure', 10, 3)->default(0);
                $table->float('stb_pressure_cargo_tank_2', 10, 3)->default(0);
                $table->float('port_pressure_cargo_tank_2', 10, 3)->default(0);
                $table->float('temperatur_in_sump_cargo_tank_2_stb', 10, 3)->default(0);
                $table->float('temperatur_at_50_cargo_tank_2_stb', 10, 3)->default(0);
                $table->float('temperatur_at_95_cargo_tank_2_stb', 10, 3)->default(0);
                $table->float('temperature_vapour_cargo_tank_2', 10, 3)->default(0);
                $table->float('temperature_in_sump_cargo_tank_2_port', 10, 3)->default(0);
                $table->float('tempertaure_at_50_cargo_tank_2_port', 10, 3)->default(0);
                $table->float('temperatur_at_95_cargo_tank_2_port', 10, 3)->default(0);
                $table->float('liq_fill_valve_cargo_tank_2_stb_positioner_transmitter', 10, 3)->default(0);
                $table->float('disch_valve_dw_pump_2_stb_positioner_transmitter', 10, 3)->default(0);
                $table->float('disc_valve_dw_pump_2_port_positioner_transmitter', 10, 3)->default(0);
                $table->float('liq_fill_valve_cargo_tank_2_port_positioner_transmitter', 10, 3)->default(0);
                $table->float('pressure_hold_space_2', 10, 3)->default(0);    

                $table->float('dw_pump_3_stb_current_transmitter', 10, 3)->default(0);
                $table->float('dwp_3_port_current_transmitter', 10, 3)->default(0);
                $table->float('level_cargo_3_stb', 10, 3)->default(0);
                $table->float('level_cargo_3_port', 10, 3)->default(0);
                $table->float('disch_pressure_dw_pump_3_stb_pressure', 10, 3)->default(0);
                $table->float('disch_pressure_dw_pump_3_port_pressure', 10, 3)->default(0);
                $table->float('stb_pressure_cargo_tank_3', 10, 3)->default(0);
                $table->float('port_pressure_cargo_tank_3', 10, 3)->default(0);
                $table->float('temperatur_in_sump_cargo_tank_3_stb', 10, 3)->default(0);
                $table->float('temperatur_at_50_cargo_tank_3_stb', 10, 3)->default(0);
                $table->float('temperatur_at_95_cargo_tank_3_stb', 10, 3)->default(0);
                $table->float('temperature_vapour_cargo_tank_3', 10, 3)->default(0);
                $table->float('temperature_in_sump_cargo_tank_3_port', 10, 3)->default(0);
                $table->float('tempertaure_at_50_cargo_tank_3_port', 10, 3)->default(0);
                $table->float('temperatur_at_95_cargo_tank_3_port', 10, 3)->default(0);
                $table->float('liq_fill_valve_cargo_tank_3_stb_positioner_transmitter', 10, 3)->default(0);
                $table->float('disch_valve_dw_pump_3_stb_positioner_transmitter', 10, 3)->default(0);
                $table->float('disc_valve_dw_pump_3_port_positioner_transmitter', 10, 3)->default(0);
                $table->float('liq_fill_valve_cargo_tank_3_port_positioner_transmitter', 10, 3)->default(0);
                $table->float('pressure_hold_space_3', 10, 3)->default(0);

                $table->float('presure_deck_tank_1', 10, 3)->default(0);
                $table->float('level_deck_tank_1', 10, 3)->default(0);
                $table->float('temperature_top_deck_tank_1', 10, 3)->default(0);
                $table->float('temperature_bottom_deck_tank_1', 10, 3)->default(0);

                $table->float('presure_deck_tank_2', 10, 3)->default(0);
                $table->float('level_deck_tank_2', 10, 3)->default(0);
                $table->float('temperature_top_deck_tank_2', 10, 3)->default(0);
                $table->float('temperature_bottom_deck_tank_2', 10, 3)->default(0);

                $table->float('compressor_reliq_1_current', 10, 3)->default(0);
                $table->float('suction_pressure_1_stage_reliq_1', 10, 3)->default(0);
                $table->float('disch_presure_1_stage_reliq_1', 10, 3)->default(0);
                $table->float('suction_pressure_2_stage_reliq_1', 10, 3)->default(0);
                $table->float('disch_pressure_2_stage_reliq_1', 10, 3)->default(0);
                $table->float('pressure_receiver_reliq_1', 10, 3)->default(0);
                $table->float('temperature_bulkhead_reliq_1', 10, 3)->default(0);
                $table->float('suction_temperature_1_stage_reliq_1', 10, 3)->default(0);
                $table->float('disch_temperature_1_stage_reliq_1', 10, 3)->default(0);
                $table->float('suction_temperature_2_stage_reliq_1', 10, 3)->default(0);
                $table->float('disch_temperature_2_stage_reliq_1', 10, 3)->default(0);
                $table->float('pressure_condensate_reliq_1_to_header', 10, 3)->default(0);
                $table->float('temperature_glycol_to_compressor_reliq_1', 10, 3)->default(0);
                $table->float('lubeoil_pressure_compressor_reliq_1', 10, 3)->default(0);
                $table->float('disch_presure_1_suction_pressure_1_stage_reliq_1', 10, 3)->default(0);
                $table->float('disch_presure_2_suction_pressure_2_stage_reliq_1', 10, 3)->default(0);
                $table->float('level_intercooler_reliq_1', 10, 3)->default(0);
                $table->float('level_receiver_reliq_1', 10, 3)->default(0);

                $table->float('compressor_reliq_2_current', 10, 3)->default(0);
                $table->float('suction_pressure_1_stage_reliq_2', 10, 3)->default(0);
                $table->float('disch_presure_1_stage_reliq_2', 10, 3)->default(0);
                $table->float('suction_pressure_2_stage_reliq_2', 10, 3)->default(0);
                $table->float('disch_pressure_2_stage_reliq_2', 10, 3)->default(0);
                $table->float('pressure_receiver_reliq_2', 10, 3)->default(0);
                $table->float('temperature_bulkhead_reliq_2', 10, 3)->default(0);
                $table->float('suction_temperature_1_stage_reliq_2', 10, 3)->default(0);
                $table->float('disch_temperature_1_stage_reliq_2', 10, 3)->default(0);
                $table->float('suction_temperature_2_stage_reliq_2', 10, 3)->default(0);
                $table->float('disch_temperature_2_stage_reliq_2', 10, 3)->default(0);
                $table->float('pressure_condensate_reliq_2_to_header', 10, 3)->default(0);
                $table->float('temperature_glycol_to_compressor_reliq_2', 10, 3)->default(0);
                $table->float('lubeoil_pressure_compressor_reliq_2', 10, 3)->default(0);
                $table->float('disch_presure_1_suction_pressure_1_stage_reliq_2', 10, 3)->default(0);
                $table->float('disch_presure_2_suction_pressure_2_stage_reliq_2', 10, 3)->default(0);
                $table->float('level_intercooler_reliq_2', 10, 3)->default(0);
                $table->float('level_receiver_reliq_2', 10, 3)->default(0);

                $table->float('compressor_reliq_3_current', 10, 3)->default(0);
                $table->float('suction_pressure_1_stage_reliq_3', 10, 3)->default(0);
                $table->float('disch_presure_1_stage_reliq_3', 10, 3)->default(0);
                $table->float('suction_pressure_2_stage_reliq_3', 10, 3)->default(0);
                $table->float('disch_pressure_2_stage_reliq_3', 10, 3)->default(0);
                $table->float('pressure_receiver_reliq_3', 10, 3)->default(0);
                $table->float('temperature_bulkhead_reliq_3', 10, 3)->default(0);
                $table->float('suction_temperature_1_stage_reliq_3', 10, 3)->default(0);
                $table->float('disch_temperature_1_stage_reliq_3', 10, 3)->default(0);
                $table->float('suction_temperature_2_stage_reliq_3', 10, 3)->default(0);
                $table->float('disch_temperature_2_stage_reliq_3', 10, 3)->default(0);
                $table->float('pressure_condensate_reliq_3_to_header', 10, 3)->default(0);
                $table->float('temperature_glycol_to_compressor_reliq_3', 10, 3)->default(0);
                $table->float('lubeoil_pressure_compressor_reliq_3', 10, 3)->default(0);
                $table->float('disch_presure_1_suction_pressure_1_stage_reliq_3', 10, 3)->default(0);
                $table->float('disch_presure_2_suction_pressure_2_stage_reliq_3', 10, 3)->default(0);
                $table->float('level_intercooler_reliq_3', 10, 3)->default(0);
                $table->float('level_receiver_reliq_3', 10, 3)->default(0);

                $table->float('pressure_difference_seawater', 10, 3)->default(0);
                $table->float('temperatur_seawater_outlet', 10, 3)->default(0);
                $table->float('inert_gas_generator_oxygen', 10, 3)->default(0);
                $table->float('inert_gas_generator_delivery', 10, 3)->default(0);
                $table->float('inert_gas_generator_pressure', 10, 3)->default(0);
                $table->float('esd_air_supply_pressure', 10, 3)->default(0);
                $table->float('glycol_cooling_temp_to_cargo_compressors', 10, 3)->default(0);
                $table->float('pressure_flydrelic_power_pack', 10, 3)->default(0);

                $table->float('pressure_booster_pump_2', 10, 3)->default(0);
                $table->float('pressure_cargo_heater_outlet_to_vapour_header', 10, 3)->default(0);
                $table->float('cargo_heater_outlet_temperature', 10, 3)->default(0);

                $table->float('pressure_vapour_line_cross_over_1', 10, 3)->default(0);
                $table->float('pressure_vapour_line_cross_over_2', 10, 3)->default(0);
                $table->float('pressure_liq_cross_over_1', 10, 3)->default(0);
                $table->float('pressure_liq_cross_over_2', 10, 3)->default(0);
                $table->float('temperature_liq_cross_over_1', 10, 3)->default(0);
                $table->float('temperature_liq_cross_over_2', 10, 3)->default(0);
                
                $table->timestamps();
            });
        }
        
        return $model->setTable($tableName);
    }
}
