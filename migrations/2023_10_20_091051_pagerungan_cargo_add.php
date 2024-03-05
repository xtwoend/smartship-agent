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
use Hyperf\Database\Migrations\Migration;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Schema\Schema;

class PagerunganCargoAdd extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('cargo_12', function (Blueprint $table) {
            // panasia/hanla
            $table->float('cargo_tank1p_ullage', 10, 3)->default(0);
            $table->float('cargo_tank1s_ullage', 10, 3)->default(0);
            $table->float('cargo_tank2p_ullage', 10, 3)->default(0);
            $table->float('cargo_tank2s_ullage', 10, 3)->default(0);
            $table->float('cargo_tank3p_ullage', 10, 3)->default(0);
            $table->float('cargo_tank3s_ullage', 10, 3)->default(0);
            $table->float('cargo_tank4p_ullage', 10, 3)->default(0);
            $table->float('cargo_tank4s_ullage', 10, 3)->default(0);
            $table->float('cargo_tank5p_ullage', 10, 3)->default(0);
            $table->float('cargo_tank5s_ullage', 10, 3)->default(0);
            $table->float('slop_tank_p_ullage', 10, 3)->default(0);
            $table->float('slop_tank_s_ullage', 10, 3)->default(0);
            $table->float('water_ballast_tank1p_level', 10, 3)->default(0);
            $table->float('water_ballast_tank1s_level', 10, 3)->default(0);
            $table->float('water_ballast_tank2p_level', 10, 3)->default(0);
            $table->float('water_ballast_tank2s_level', 10, 3)->default(0);
            $table->float('water_ballast_tank3p_level', 10, 3)->default(0);
            $table->float('water_ballast_tank3s_level', 10, 3)->default(0);
            $table->float('water_ballast_tank4p_level', 10, 3)->default(0);
            $table->float('water_ballast_tank4s_level', 10, 3)->default(0);
            $table->float('water_ballast_tank5p_level', 10, 3)->default(0);
            $table->float('water_ballast_tank5s_level', 10, 3)->default(0);
            $table->float('water_ballast_tank6p_level', 10, 3)->default(0);
            $table->float('water_ballast_tank6s_level', 10, 3)->default(0);
            $table->float('fore_peak_tank_leve', 10, 3)->default(0);
            $table->float('after_peak_tank_level', 10, 3)->default(0);
            $table->float('no1_fo_tank_p_level', 10, 3)->default(0);
            $table->float('no1_fo_tank_s_level', 10, 3)->default(0);
            $table->float('no2_fo_tank_p_level', 10, 3)->default(0);
            $table->float('no2_fo_tank_s_level', 10, 3)->default(0);
            $table->float('no1_fo_service_tank_level', 10, 3)->default(0);
            $table->float('no2_fo_service_tank_level', 10, 3)->default(0);
            $table->float('fo_settling_tank_level', 10, 3)->default(0);
            $table->float('do_storage_tank_p_level', 10, 3)->default(0);
            $table->float('do_storage_tank_s_level', 10, 3)->default(0);
            $table->float('no1_do_service_tank_level', 10, 3)->default(0);
            $table->float('no2_do_service_tank_level', 10, 3)->default(0);
            $table->float('do_setting_tank_level', 10, 3)->default(0);
            $table->float('draft_sensor_level', 10, 3)->default(0);
            $table->float('draft_mark_level', 10, 3)->default(0);
            $table->float('draft_pp_level', 10, 3)->default(0);
            $table->float('cargo_tank1p_upper_temp', 10, 3)->default(0);
            $table->float('cargo_tank1p_middle_temp', 10, 3)->default(0);
            $table->float('cargo_tank1p_bottom_temp', 10, 3)->default(0);
            $table->float('cargo_tank1p_pressure', 10, 3)->default(0);
            $table->float('cargo_tank1p_volume', 10, 3)->default(0);
            $table->float('cargo_tank1s_upper_temp', 10, 3)->default(0);
            $table->float('cargo_tank1s_middle_temp', 10, 3)->default(0);
            $table->float('cargo_tank1s_bottom_temp', 10, 3)->default(0);
            $table->float('cargo_tank1s_pressure', 10, 3)->default(0);
            $table->float('cargo_tank1s_volume', 10, 3)->default(0);
            $table->float('cargo_tank2p_upper_temp', 10, 3)->default(0);
            $table->float('cargo_tank2p_middle_temp', 10, 3)->default(0);
            $table->float('cargo_tank2p_bottom_temp', 10, 3)->default(0);
            $table->float('cargo_tank2p_pressure', 10, 3)->default(0);
            $table->float('cargo_tank2p_volume', 10, 3)->default(0);
            $table->float('cargo_tank2s_upper_temp', 10, 3)->default(0);
            $table->float('cargo_tank2s_middle_temp', 10, 3)->default(0);
            $table->float('cargo_tank2s_bottom_temp', 10, 3)->default(0);
            $table->float('cargo_tank2s_pressure', 10, 3)->default(0);
            $table->float('cargo_tank2s_volume', 10, 3)->default(0);
            $table->float('cargo_tank3p_upper_temp', 10, 3)->default(0);
            $table->float('cargo_tank3p_middle_temp', 10, 3)->default(0);
            $table->float('cargo_tank3p_bottom_temp', 10, 3)->default(0);
            $table->float('cargo_tank3p_pressure', 10, 3)->default(0);
            $table->float('cargo_tank3p_volume', 10, 3)->default(0);
            $table->float('cargo_tank3s_upper_temp', 10, 3)->default(0);
            $table->float('cargo_tank3s_middle_temp', 10, 3)->default(0);
            $table->float('cargo_tank3s_bottom_temp', 10, 3)->default(0);
            $table->float('cargo_tank3s_pressure', 10, 3)->default(0);
            $table->float('cargo_tank3s_volume', 10, 3)->default(0);
            $table->float('cargo_tank4p_upper_temp', 10, 3)->default(0);
            $table->float('cargo_tank4p_middle_temp', 10, 3)->default(0);
            $table->float('cargo_tank4p_bottom_temp', 10, 3)->default(0);
            $table->float('cargo_tank4p_pressure', 10, 3)->default(0);
            $table->float('cargo_tank4p_volume', 10, 3)->default(0);
            $table->float('cargo_tank4s_upper_temp', 10, 3)->default(0);
            $table->float('cargo_tank4s_middle_temp', 10, 3)->default(0);
            $table->float('cargo_tank4s_bottom_temp', 10, 3)->default(0);
            $table->float('cargo_tank4s_pressure', 10, 3)->default(0);
            $table->float('cargo_tank4s_volume', 10, 3)->default(0);
            $table->float('cargo_tank5p_upper_temp', 10, 3)->default(0);
            $table->float('cargo_tank5p_middle_temp', 10, 3)->default(0);
            $table->float('cargo_tank5p_bottom_temp', 10, 3)->default(0);
            $table->float('cargo_tank5p_pressure', 10, 3)->default(0);
            $table->float('cargo_tank5p_volume', 10, 3)->default(0);
            $table->float('cargo_tank5s_upper_temp', 10, 3)->default(0);
            $table->float('cargo_tank5s_middle_temp', 10, 3)->default(0);
            $table->float('cargo_tank5s_bottom_temp', 10, 3)->default(0);
            $table->float('cargo_tank5s_pressure', 10, 3)->default(0);
            $table->float('cargo_tank5s_volume', 10, 3)->default(0);
            $table->float('slop_tank_p_upper_temp', 10, 3)->default(0);
            $table->float('slop_tank_p_middle_temp', 10, 3)->default(0);
            $table->float('slop_tank_p_bottom_temp', 10, 3)->default(0);
            $table->float('slop_tank_p_pressure', 10, 3)->default(0);
            $table->float('slop_tank_p_volume', 10, 3)->default(0);
            $table->float('slop_tank_s_upper_temp', 10, 3)->default(0);
            $table->float('slop_tank_s_middle_temp', 10, 3)->default(0);
            $table->float('slop_tank_s_bottom_temp', 10, 3)->default(0);
            $table->float('slop_tank_s_pressure', 10, 3)->default(0);
            $table->float('slop_tank_s_volume', 10, 3)->default(0);
            $table->float('no1_fo_tank_p_volume', 10, 3)->default(0);
            $table->float('no1_fo_tank_s_volume', 10, 3)->default(0);
            $table->float('no2_fo_tank_p_volume', 10, 3)->default(0);
            $table->float('no2_fo_tank_s_volume', 10, 3)->default(0);
            $table->float('no1_fo_service_tank_volume', 10, 3)->default(0);
            $table->float('no2_fo_service_tank_volume', 10, 3)->default(0);
            $table->float('fo_settling_tank_volume', 10, 3)->default(0);
            $table->float('do_storage_tank_p_volume', 10, 3)->default(0);
            $table->float('do_storage_tank_s_volume', 10, 3)->default(0);
            $table->float('no1_do_service_tank_volume', 10, 3)->default(0);
            $table->float('no2_do_service_tank_volume', 10, 3)->default(0);
            $table->float('do_setting_tank_volume', 10, 3)->default(0);
        });

        Schema::table('cargo_log_12_202310', function (Blueprint $table) {
            // panasia/hanla
            $table->float('cargo_tank1p_ullage', 10, 3)->default(0);
            $table->float('cargo_tank1s_ullage', 10, 3)->default(0);
            $table->float('cargo_tank2p_ullage', 10, 3)->default(0);
            $table->float('cargo_tank2s_ullage', 10, 3)->default(0);
            $table->float('cargo_tank3p_ullage', 10, 3)->default(0);
            $table->float('cargo_tank3s_ullage', 10, 3)->default(0);
            $table->float('cargo_tank4p_ullage', 10, 3)->default(0);
            $table->float('cargo_tank4s_ullage', 10, 3)->default(0);
            $table->float('cargo_tank5p_ullage', 10, 3)->default(0);
            $table->float('cargo_tank5s_ullage', 10, 3)->default(0);
            $table->float('slop_tank_p_ullage', 10, 3)->default(0);
            $table->float('slop_tank_s_ullage', 10, 3)->default(0);
            $table->float('water_ballast_tank1p_level', 10, 3)->default(0);
            $table->float('water_ballast_tank1s_level', 10, 3)->default(0);
            $table->float('water_ballast_tank2p_level', 10, 3)->default(0);
            $table->float('water_ballast_tank2s_level', 10, 3)->default(0);
            $table->float('water_ballast_tank3p_level', 10, 3)->default(0);
            $table->float('water_ballast_tank3s_level', 10, 3)->default(0);
            $table->float('water_ballast_tank4p_level', 10, 3)->default(0);
            $table->float('water_ballast_tank4s_level', 10, 3)->default(0);
            $table->float('water_ballast_tank5p_level', 10, 3)->default(0);
            $table->float('water_ballast_tank5s_level', 10, 3)->default(0);
            $table->float('water_ballast_tank6p_level', 10, 3)->default(0);
            $table->float('water_ballast_tank6s_level', 10, 3)->default(0);
            $table->float('fore_peak_tank_leve', 10, 3)->default(0);
            $table->float('after_peak_tank_level', 10, 3)->default(0);
            $table->float('no1_fo_tank_p_level', 10, 3)->default(0);
            $table->float('no1_fo_tank_s_level', 10, 3)->default(0);
            $table->float('no2_fo_tank_p_level', 10, 3)->default(0);
            $table->float('no2_fo_tank_s_level', 10, 3)->default(0);
            $table->float('no1_fo_service_tank_level', 10, 3)->default(0);
            $table->float('no2_fo_service_tank_level', 10, 3)->default(0);
            $table->float('fo_settling_tank_level', 10, 3)->default(0);
            $table->float('do_storage_tank_p_level', 10, 3)->default(0);
            $table->float('do_storage_tank_s_level', 10, 3)->default(0);
            $table->float('no1_do_service_tank_level', 10, 3)->default(0);
            $table->float('no2_do_service_tank_level', 10, 3)->default(0);
            $table->float('do_setting_tank_level', 10, 3)->default(0);
            $table->float('draft_sensor_level', 10, 3)->default(0);
            $table->float('draft_mark_level', 10, 3)->default(0);
            $table->float('draft_pp_level', 10, 3)->default(0);
            $table->float('cargo_tank1p_upper_temp', 10, 3)->default(0);
            $table->float('cargo_tank1p_middle_temp', 10, 3)->default(0);
            $table->float('cargo_tank1p_bottom_temp', 10, 3)->default(0);
            $table->float('cargo_tank1p_pressure', 10, 3)->default(0);
            $table->float('cargo_tank1p_volume', 10, 3)->default(0);
            $table->float('cargo_tank1s_upper_temp', 10, 3)->default(0);
            $table->float('cargo_tank1s_middle_temp', 10, 3)->default(0);
            $table->float('cargo_tank1s_bottom_temp', 10, 3)->default(0);
            $table->float('cargo_tank1s_pressure', 10, 3)->default(0);
            $table->float('cargo_tank1s_volume', 10, 3)->default(0);
            $table->float('cargo_tank2p_upper_temp', 10, 3)->default(0);
            $table->float('cargo_tank2p_middle_temp', 10, 3)->default(0);
            $table->float('cargo_tank2p_bottom_temp', 10, 3)->default(0);
            $table->float('cargo_tank2p_pressure', 10, 3)->default(0);
            $table->float('cargo_tank2p_volume', 10, 3)->default(0);
            $table->float('cargo_tank2s_upper_temp', 10, 3)->default(0);
            $table->float('cargo_tank2s_middle_temp', 10, 3)->default(0);
            $table->float('cargo_tank2s_bottom_temp', 10, 3)->default(0);
            $table->float('cargo_tank2s_pressure', 10, 3)->default(0);
            $table->float('cargo_tank2s_volume', 10, 3)->default(0);
            $table->float('cargo_tank3p_upper_temp', 10, 3)->default(0);
            $table->float('cargo_tank3p_middle_temp', 10, 3)->default(0);
            $table->float('cargo_tank3p_bottom_temp', 10, 3)->default(0);
            $table->float('cargo_tank3p_pressure', 10, 3)->default(0);
            $table->float('cargo_tank3p_volume', 10, 3)->default(0);
            $table->float('cargo_tank3s_upper_temp', 10, 3)->default(0);
            $table->float('cargo_tank3s_middle_temp', 10, 3)->default(0);
            $table->float('cargo_tank3s_bottom_temp', 10, 3)->default(0);
            $table->float('cargo_tank3s_pressure', 10, 3)->default(0);
            $table->float('cargo_tank3s_volume', 10, 3)->default(0);
            $table->float('cargo_tank4p_upper_temp', 10, 3)->default(0);
            $table->float('cargo_tank4p_middle_temp', 10, 3)->default(0);
            $table->float('cargo_tank4p_bottom_temp', 10, 3)->default(0);
            $table->float('cargo_tank4p_pressure', 10, 3)->default(0);
            $table->float('cargo_tank4p_volume', 10, 3)->default(0);
            $table->float('cargo_tank4s_upper_temp', 10, 3)->default(0);
            $table->float('cargo_tank4s_middle_temp', 10, 3)->default(0);
            $table->float('cargo_tank4s_bottom_temp', 10, 3)->default(0);
            $table->float('cargo_tank4s_pressure', 10, 3)->default(0);
            $table->float('cargo_tank4s_volume', 10, 3)->default(0);
            $table->float('cargo_tank5p_upper_temp', 10, 3)->default(0);
            $table->float('cargo_tank5p_middle_temp', 10, 3)->default(0);
            $table->float('cargo_tank5p_bottom_temp', 10, 3)->default(0);
            $table->float('cargo_tank5p_pressure', 10, 3)->default(0);
            $table->float('cargo_tank5p_volume', 10, 3)->default(0);
            $table->float('cargo_tank5s_upper_temp', 10, 3)->default(0);
            $table->float('cargo_tank5s_middle_temp', 10, 3)->default(0);
            $table->float('cargo_tank5s_bottom_temp', 10, 3)->default(0);
            $table->float('cargo_tank5s_pressure', 10, 3)->default(0);
            $table->float('cargo_tank5s_volume', 10, 3)->default(0);
            $table->float('slop_tank_p_upper_temp', 10, 3)->default(0);
            $table->float('slop_tank_p_middle_temp', 10, 3)->default(0);
            $table->float('slop_tank_p_bottom_temp', 10, 3)->default(0);
            $table->float('slop_tank_p_pressure', 10, 3)->default(0);
            $table->float('slop_tank_p_volume', 10, 3)->default(0);
            $table->float('slop_tank_s_upper_temp', 10, 3)->default(0);
            $table->float('slop_tank_s_middle_temp', 10, 3)->default(0);
            $table->float('slop_tank_s_bottom_temp', 10, 3)->default(0);
            $table->float('slop_tank_s_pressure', 10, 3)->default(0);
            $table->float('slop_tank_s_volume', 10, 3)->default(0);
            $table->float('no1_fo_tank_p_volume', 10, 3)->default(0);
            $table->float('no1_fo_tank_s_volume', 10, 3)->default(0);
            $table->float('no2_fo_tank_p_volume', 10, 3)->default(0);
            $table->float('no2_fo_tank_s_volume', 10, 3)->default(0);
            $table->float('no1_fo_service_tank_volume', 10, 3)->default(0);
            $table->float('no2_fo_service_tank_volume', 10, 3)->default(0);
            $table->float('fo_settling_tank_volume', 10, 3)->default(0);
            $table->float('do_storage_tank_p_volume', 10, 3)->default(0);
            $table->float('do_storage_tank_s_volume', 10, 3)->default(0);
            $table->float('no1_do_service_tank_volume', 10, 3)->default(0);
            $table->float('no2_do_service_tank_volume', 10, 3)->default(0);
            $table->float('do_setting_tank_volume', 10, 3)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('', function (Blueprint $table) {
        });
    }
}
