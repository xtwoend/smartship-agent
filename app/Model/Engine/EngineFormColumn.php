<?php

namespace App\Model\Engine;

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;

trait EngineFormColumn
{
    public function addColumn($tableName)
    {
        if(Schema::hasTable($tableName) && ! Schema::hasColumn($tableName, 'engine_type'))
        {
            if(! Schema::hasColumn($tableName, 'me_rpm')){
                Schema::table($tableName, function (Blueprint $table) {
                    $table->float('me_rpm', 10, 3)->default(0);
                });
            }

            Schema::table($tableName, function (Blueprint $table) {
                $table->string('engine_type')->nullable();
                $table->string('voyage_number')->nullable();
                $table->string('from_port')->nullable();
                $table->string('to_port')->nullable();
                $table->string('engine_output')->nullable();
                $table->string('cyl_bore')->nullable();
                $table->string('mep')->nullable();
                $table->string('engine_rpm')->nullable();
                $table->string('piston_stroke')->nullable();
                $table->float('temp_engine_room', 10, 3)->default(0);
                $table->float('speed', 10, 3)->default(0);
                $table->float('propeller_speed', 10, 3)->default(0);
                $table->float('me_running_hours', 10, 3)->default(0);
                $table->float('me_ht_water_cooling', 10, 3)->default(0);
                $table->float('me_lt_water_cooling', 10, 3)->default(0);
                $table->float('me_sea_water_cooling', 10, 3)->default(0);
                $table->float('me_engine_load', 10, 3)->default(0);
                $table->float('me_pressure_lo_inlet_tc', 10, 3)->default(0);
                $table->float('me_temp_lo_outlet_tc', 10, 3)->default(0);
                $table->float('me_pressure_lo_inlet_engine', 10, 3)->default(0);
                $table->float('me_temp_lo_inlet_engine', 10, 3)->default(0);
                $table->float('me_starting_air_engine_inlet', 10, 3)->default(0);
                $table->float('me_pressure_fo_engine_inlet', 10, 3)->default(0);
                $table->float('me_fo_engine_inlet_temp', 10, 3)->default(0);
                $table->float('tc_turbo_blower_speed', 10, 3)->default(0);
                $table->float('tc_blower_filter_pressure', 10, 3)->default(0);
                $table->float('tc_air_cooler_back_pressure', 10, 3)->default(0);
                $table->float('tc_scavenge_manifold_pressure', 10, 3)->default(0);
                $table->float('tc_exh_gas_pressure_aft_tc', 10, 3)->default(0);
                $table->float('temp_scaving_air_inlet_cooler', 10, 3)->default(0);
                $table->float('temp_scaving_air_outlet_cooler', 10, 3)->default(0);
                $table->float('temp_exh_gas_turbin_inlet', 10, 3)->default(0);
                $table->float('temp_exh_gas_turbin_outlet', 10, 3)->default(0);
                $table->float('temp_fo_specific_grafity', 10, 3)->default(0);
                $table->float('temp_fo_viscosity_118', 10, 3)->default(0);
                $table->float('gb_operating_pressure', 10, 3)->default(0);
                $table->float('gb_shaftbrake_pressure', 10, 3)->default(0);
                $table->float('gb_temp_after_oil_cooler', 10, 3)->default(0);
                $table->float('gb_temp_thrust_bearing', 10, 3)->default(0);
                $table->float('cr_fuel_command', 10, 3)->default(0);
                $table->float('cr_injection_time', 10, 3)->default(0);
                $table->float('cr_qty_piston_return', 10, 3)->default(0);
                $table->float('cr_exh_valve_oc_angel', 10, 3)->default(0);
                $table->float('cr_exh_valve_oc_dead_t', 10, 3)->default(0);
                $table->float('cr_servo_oil_pressure_sp', 10, 3)->default(0);
                $table->float('cr_fuel_rail_pressure_act', 10, 3)->default(0);
                $table->float('cr_vit', 10, 3)->default(0);

                $table->float('cyl_pressure_max_c1', 10, 3)->default(0);
                $table->float('cyl_pressure_max_c2', 10, 3)->default(0);
                $table->float('cyl_pressure_max_c3', 10, 3)->default(0);
                $table->float('cyl_pressure_max_c4', 10, 3)->default(0);
                $table->float('cyl_pressure_max_c5', 10, 3)->default(0);
                $table->float('cyl_pressure_max_c6', 10, 3)->default(0);
                $table->float('cyl_pressure_max_c7', 10, 3)->default(0);
                $table->float('cyl_pressure_max_c8', 10, 3)->default(0);
                $table->float('cyl_fuel_pump_index_c1', 10, 3)->default(0);
                $table->float('cyl_fuel_pump_index_c2', 10, 3)->default(0);
                $table->float('cyl_fuel_pump_index_c3', 10, 3)->default(0);
                $table->float('cyl_fuel_pump_index_c4', 10, 3)->default(0);
                $table->float('cyl_fuel_pump_index_c5', 10, 3)->default(0);
                $table->float('cyl_fuel_pump_index_c6', 10, 3)->default(0);
                $table->float('cyl_fuel_pump_index_c7', 10, 3)->default(0);
                $table->float('cyl_fuel_pump_index_c8', 10, 3)->default(0);
                $table->float('cyl_temp_exh_c1', 10, 3)->default(0);
                $table->float('cyl_temp_exh_c2', 10, 3)->default(0);
                $table->float('cyl_temp_exh_c3', 10, 3)->default(0);
                $table->float('cyl_temp_exh_c4', 10, 3)->default(0);
                $table->float('cyl_temp_exh_c5', 10, 3)->default(0);
                $table->float('cyl_temp_exh_c6', 10, 3)->default(0);
                $table->float('cyl_temp_exh_c7', 10, 3)->default(0);
                $table->float('cyl_temp_exh_c8', 10, 3)->default(0);

                $table->float('cyl_temp_jacket_fw_out_c1', 10, 3)->default(0);
                $table->float('cyl_temp_jacket_fw_out_c2', 10, 3)->default(0);
                $table->float('cyl_temp_jacket_fw_out_c3', 10, 3)->default(0);
                $table->float('cyl_temp_jacket_fw_out_c4', 10, 3)->default(0);
                $table->float('cyl_temp_jacket_fw_out_c5', 10, 3)->default(0);
                $table->float('cyl_temp_jacket_fw_out_c6', 10, 3)->default(0);
                $table->float('cyl_temp_jacket_fw_out_c7', 10, 3)->default(0);
                $table->float('cyl_temp_jacket_fw_out_c8', 10, 3)->default(0);

                $table->float('cyl_temp_crankcase_c1', 10, 3)->default(0);
                $table->float('cyl_temp_crankcase_c2', 10, 3)->default(0);
                $table->float('cyl_temp_crankcase_c3', 10, 3)->default(0);
                $table->float('cyl_temp_crankcase_c4', 10, 3)->default(0);
                $table->float('cyl_temp_crankcase_c5', 10, 3)->default(0);
                $table->float('cyl_temp_crankcase_c6', 10, 3)->default(0);
                $table->float('cyl_temp_crankcase_c7', 10, 3)->default(0);
                $table->float('cyl_temp_crankcase_c8', 10, 3)->default(0);

                $table->float('fo_comsumtion', 10, 3)->default(0);
                $table->string('fo_grade')->nullable();
                $table->float('lubricant_lo_system', 10, 3)->nullable();
                $table->string('lubricant_lo_system_grade')->nullable();
                $table->float('lubricant_gearbox', 10, 3)->nullable();
                $table->string('lubricant_gearbox_grade')->nullable();
            });
        }
    }
}