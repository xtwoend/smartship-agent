<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class Test extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('test', function (Blueprint $table) {
            $table->bigIncrements('id');
                $table->unsignedBigInteger('fleet_id')->index();
                $table->datetime('terminal_time')->index();

                $table->float('no_1_cargo_tank_p', 10, 3)->default(0);
                $table->float('temp_1ctp', 10, 3)->default(0);
                $table->float('no_1_cargo_tank_s', 10, 3)->default(0);
                $table->float('temp_1cts', 10, 3)->default(0);
                $table->float('no_2_cargo_tank_p', 10, 3)->default(0);
                $table->float('temp_2ctp', 10, 3)->default(0);
                $table->float('no_2_cargo_tank_s', 10, 3)->default(0);
                $table->float('temp_2cts', 10, 3)->default(0);
                $table->float('no_3_cargo_tank_p', 10, 3)->default(0);
                $table->float('temp_3ctp', 10, 3)->default(0);
                $table->float('no_3_cargo_tank_s', 10, 3)->default(0);
                $table->float('temp_3ctm', 10, 3)->default(0);
                $table->float('no_4_cargo_tank_p', 10, 3)->default(0);
                $table->float('temp_4ctp', 10, 3)->default(0);
                $table->float('no_4_cargo_tank_s', 10, 3)->default(0);
                $table->float('temp_4cts', 10, 3)->default(0);
                $table->float('no_5_cargo_tank_p', 10, 3)->default(0);
                $table->float('temp_5ctp', 10, 3)->default(0);
                $table->float('no_5_cargo_tank_s', 10, 3)->default(0);
                $table->float('temp_5cts', 10, 3)->default(0);
                $table->float('slop_tank_p', 10, 3)->default(0);
                $table->float('temp_stp', 10, 3)->default(0);
                $table->float('slop_tank_s', 10, 3)->default(0);
                $table->float('temp_sts', 10, 3)->default(0);

                // pump status
                $table->datetime('pump_timestamp')->nullable();
                $table->boolean('cargo_pump1_run')->nullable();
                $table->boolean('cargo_pump2_run')->nullable();
                $table->boolean('cargo_pump3_run')->nullable();
                $table->boolean('wballast_pump1_run')->nullable();
                $table->boolean('wballast_pump2_run')->nullable();
                $table->boolean('tank_cleanning_pump_run')->nullable();
                $table->boolean('stripping_pump1_run')->nullable();
                $table->boolean('stripping_pump2_run')->nullable();

                // cargo 
                $table->datetime('cargo_timestamp')->nullable();
                $table->float('bp1_casing_temp', 10, 3)->default(0);
                $table->float('bp1_transmission_brg_temp', 10, 3)->default(0);
                $table->float('bp1_drive_end_bearing_temp', 10, 3)->default(0);
                $table->float('bp1_nondrive_end_bearing_temp', 10, 3)->default(0);
                $table->float('bp1_transmission_seal_temp', 10, 3)->default(0);
                $table->float('bp2_drive_end_bearing_temp', 10, 3)->default(0);
                $table->float('bp2_casing_temp', 10, 3)->default(0);
                $table->float('bp2_transmission_brg_temp', 10, 3)->default(0);
                $table->float('bp2_nondrive_end_bearing_temp', 10, 3)->default(0);
                $table->float('bp2_transmission_seal_temp', 10, 3)->default(0);
                $table->float('cp1_casing_temp', 10, 3)->default(0);
                $table->float('cp1_bearing_temp', 10, 3)->default(0);
                $table->float('cp1_transmission_brg_temp', 10, 3)->default(0);
                $table->float('cp1_discharge_pressure', 10, 3)->default(0);
                $table->float('cp1_transmission_seal_temp', 10, 3)->default(0);
                $table->float('cp2_casing_temp', 10, 3)->default(0);
                $table->float('cp2_bearing_temp', 10, 3)->default(0);
                $table->float('cp2_transmission_brg_temp', 10, 3)->default(0);
                $table->float('cp2_discharge_pressure', 10, 3)->default(0);
                $table->float('cp2_transmission_seal_temp', 10, 3)->default(0);
                $table->float('cp3_bearing_temp', 10, 3)->default(0);
                $table->float('cp3_casing_temp', 10, 3)->default(0);
                $table->float('cp3_discharge_pressure', 10, 3)->default(0);
                $table->float('cp3_transmission_brg_temp', 10, 3)->default(0);
                $table->float('cp3_transmission_seal_temp', 10, 3)->default(0);
                $table->float('sp1_discharge_pressure', 10, 3)->default(0);
                $table->float('sp1_drive_end_bearing_temp', 10, 3)->default(0);
                $table->float('sp1_casing_temp', 10, 3)->default(0);
                $table->float('sp1_nondrive_end_bearing_temp', 10, 3)->default(0);
                $table->float('sp1_transmission_brg_temp', 10, 3)->default(0);
                $table->float('sp2_casing_temp', 10, 3)->default(0);
                $table->float('sp1_transmission_seal_temp', 10, 3)->default(0);
                $table->float('sp2_discharge_pressure', 10, 3)->default(0);
                $table->float('sp2_drive_end_bearing_temp', 10, 3)->default(0);
                $table->float('sp2_nondrive_end_bearing_temp', 10, 3)->default(0);
                $table->float('sp2_transmission_brg_temp', 10, 3)->default(0);
                $table->float('sp2_transmission_seal_temp', 10, 3)->default(0);
                $table->float('tcp_casing_temp', 10, 3)->default(0);
                $table->float('tcp_discharge_pressure', 10, 3)->default(0);
                $table->float('tcp_nondrive_end_bearing_temp', 10, 3)->default(0);
                $table->float('tcp_drive_end_bearing_temp', 10, 3)->default(0);
                $table->float('tcp_transmission_brg_temp', 10, 3)->default(0);
                $table->float('tcp_transmission_seal_temp', 10, 3)->default(0);
            
                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test');
    }
}
