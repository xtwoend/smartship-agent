<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class AddPbrandanCargoTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('cargo_9', function (Blueprint $table) {
            // cargo pansia
            $table->float('no1_cotp_ullage', 10, 3)->default(0);
            $table->float('no1_cotp_temp', 10, 3)->default(0);
            $table->float('no1_cots_ullage', 10, 3)->default(0);
            $table->float('no1_cots_temp', 10, 3)->default(0);
            $table->float('no2_cotp_ullage', 10, 3)->default(0);
            $table->float('no2_cotp_temp', 10, 3)->default(0);
            $table->float('no2_cots_ullage', 10, 3)->default(0);
            $table->float('no2_cots_temp', 10, 3)->default(0);
            $table->float('no3_cotp_ullage', 10, 3)->default(0);
            $table->float('no3_cotp_temp', 10, 3)->default(0);
            $table->float('no3_cots_ullage', 10, 3)->default(0);
            $table->float('no3_cots_temp', 10, 3)->default(0);
            $table->float('no4_cotp_ullage', 10, 3)->default(0);
            $table->float('no4_cotp_temp', 10, 3)->default(0);
            $table->float('no4_cots_ullage', 10, 3)->default(0);
            $table->float('no4_cots_temp', 10, 3)->default(0);
            $table->float('no5_cotp_ullage', 10, 3)->default(0);
            $table->float('no5_cotp_temp', 10, 3)->default(0);
            $table->float('no5_cots_ullage', 10, 3)->default(0);
            $table->float('no5_cots_temp', 10, 3)->default(0);
            $table->float('slop_tank_p_ullage', 10, 3)->default(0);
            $table->float('slop_tank_p_temp', 10, 3)->default(0);
            $table->float('slop_tank_s_ullage', 10, 3)->default(0);
            $table->float('slop_tank_s_temp', 10, 3)->default(0);
            $table->float('no1_wbtp__level', 10, 3)->default(0);
            $table->float('no1_wbts_level', 10, 3)->default(0);
            $table->float('no2_wbtp_level', 10, 3)->default(0);
            $table->float('no2_wbts_level', 10, 3)->default(0);
            $table->float('no3_wbtp_level', 10, 3)->default(0);
            $table->float('no3_wbts_level', 10, 3)->default(0);
            $table->float('no4_wbtp_level', 10, 3)->default(0);
            $table->float('no4_wbts_level', 10, 3)->default(0);
            $table->float('no5_wbtp_level', 10, 3)->default(0);
            $table->float('no5_wbts_level', 10, 3)->default(0);
            $table->float('no6_wbtp_level', 10, 3)->default(0);
            $table->float('no6_wbts_level', 10, 3)->default(0);
            $table->float('fptk', 10, 3)->default(0);
            $table->float('aptk', 10, 3)->default(0);
        });

        
        Schema::table('cargo_log_9_202310', function (Blueprint $table) {
            // cargo pansia
            $table->float('no1_cotp_ullage', 10, 3)->default(0);
            $table->float('no1_cotp_temp', 10, 3)->default(0);
            $table->float('no1_cots_ullage', 10, 3)->default(0);
            $table->float('no1_cots_temp', 10, 3)->default(0);
            $table->float('no2_cotp_ullage', 10, 3)->default(0);
            $table->float('no2_cotp_temp', 10, 3)->default(0);
            $table->float('no2_cots_ullage', 10, 3)->default(0);
            $table->float('no2_cots_temp', 10, 3)->default(0);
            $table->float('no3_cotp_ullage', 10, 3)->default(0);
            $table->float('no3_cotp_temp', 10, 3)->default(0);
            $table->float('no3_cots_ullage', 10, 3)->default(0);
            $table->float('no3_cots_temp', 10, 3)->default(0);
            $table->float('no4_cotp_ullage', 10, 3)->default(0);
            $table->float('no4_cotp_temp', 10, 3)->default(0);
            $table->float('no4_cots_ullage', 10, 3)->default(0);
            $table->float('no4_cots_temp', 10, 3)->default(0);
            $table->float('no5_cotp_ullage', 10, 3)->default(0);
            $table->float('no5_cotp_temp', 10, 3)->default(0);
            $table->float('no5_cots_ullage', 10, 3)->default(0);
            $table->float('no5_cots_temp', 10, 3)->default(0);
            $table->float('slop_tank_p_ullage', 10, 3)->default(0);
            $table->float('slop_tank_p_temp', 10, 3)->default(0);
            $table->float('slop_tank_s_ullage', 10, 3)->default(0);
            $table->float('slop_tank_s_temp', 10, 3)->default(0);
            $table->float('no1_wbtp__level', 10, 3)->default(0);
            $table->float('no1_wbts_level', 10, 3)->default(0);
            $table->float('no2_wbtp_level', 10, 3)->default(0);
            $table->float('no2_wbts_level', 10, 3)->default(0);
            $table->float('no3_wbtp_level', 10, 3)->default(0);
            $table->float('no3_wbts_level', 10, 3)->default(0);
            $table->float('no4_wbtp_level', 10, 3)->default(0);
            $table->float('no4_wbts_level', 10, 3)->default(0);
            $table->float('no5_wbtp_level', 10, 3)->default(0);
            $table->float('no5_wbts_level', 10, 3)->default(0);
            $table->float('no6_wbtp_level', 10, 3)->default(0);
            $table->float('no6_wbts_level', 10, 3)->default(0);
            $table->float('fptk', 10, 3)->default(0);
            $table->float('aptk', 10, 3)->default(0);
        });


        Schema::table('cargo_log_9_202312', function (Blueprint $table) {
            // cargo pansia
            $table->float('no1_cotp_ullage', 10, 3)->default(0);
            $table->float('no1_cotp_temp', 10, 3)->default(0);
            $table->float('no1_cots_ullage', 10, 3)->default(0);
            $table->float('no1_cots_temp', 10, 3)->default(0);
            $table->float('no2_cotp_ullage', 10, 3)->default(0);
            $table->float('no2_cotp_temp', 10, 3)->default(0);
            $table->float('no2_cots_ullage', 10, 3)->default(0);
            $table->float('no2_cots_temp', 10, 3)->default(0);
            $table->float('no3_cotp_ullage', 10, 3)->default(0);
            $table->float('no3_cotp_temp', 10, 3)->default(0);
            $table->float('no3_cots_ullage', 10, 3)->default(0);
            $table->float('no3_cots_temp', 10, 3)->default(0);
            $table->float('no4_cotp_ullage', 10, 3)->default(0);
            $table->float('no4_cotp_temp', 10, 3)->default(0);
            $table->float('no4_cots_ullage', 10, 3)->default(0);
            $table->float('no4_cots_temp', 10, 3)->default(0);
            $table->float('no5_cotp_ullage', 10, 3)->default(0);
            $table->float('no5_cotp_temp', 10, 3)->default(0);
            $table->float('no5_cots_ullage', 10, 3)->default(0);
            $table->float('no5_cots_temp', 10, 3)->default(0);
            $table->float('slop_tank_p_ullage', 10, 3)->default(0);
            $table->float('slop_tank_p_temp', 10, 3)->default(0);
            $table->float('slop_tank_s_ullage', 10, 3)->default(0);
            $table->float('slop_tank_s_temp', 10, 3)->default(0);
            $table->float('no1_wbtp__level', 10, 3)->default(0);
            $table->float('no1_wbts_level', 10, 3)->default(0);
            $table->float('no2_wbtp_level', 10, 3)->default(0);
            $table->float('no2_wbts_level', 10, 3)->default(0);
            $table->float('no3_wbtp_level', 10, 3)->default(0);
            $table->float('no3_wbts_level', 10, 3)->default(0);
            $table->float('no4_wbtp_level', 10, 3)->default(0);
            $table->float('no4_wbts_level', 10, 3)->default(0);
            $table->float('no5_wbtp_level', 10, 3)->default(0);
            $table->float('no5_wbts_level', 10, 3)->default(0);
            $table->float('no6_wbtp_level', 10, 3)->default(0);
            $table->float('no6_wbts_level', 10, 3)->default(0);
            $table->float('fptk', 10, 3)->default(0);
            $table->float('aptk', 10, 3)->default(0);
        });
        
        Schema::table('cargo_log_9_202401', function (Blueprint $table) {
            // cargo pansia
            $table->float('no1_cotp_ullage', 10, 3)->default(0);
            $table->float('no1_cotp_temp', 10, 3)->default(0);
            $table->float('no1_cots_ullage', 10, 3)->default(0);
            $table->float('no1_cots_temp', 10, 3)->default(0);
            $table->float('no2_cotp_ullage', 10, 3)->default(0);
            $table->float('no2_cotp_temp', 10, 3)->default(0);
            $table->float('no2_cots_ullage', 10, 3)->default(0);
            $table->float('no2_cots_temp', 10, 3)->default(0);
            $table->float('no3_cotp_ullage', 10, 3)->default(0);
            $table->float('no3_cotp_temp', 10, 3)->default(0);
            $table->float('no3_cots_ullage', 10, 3)->default(0);
            $table->float('no3_cots_temp', 10, 3)->default(0);
            $table->float('no4_cotp_ullage', 10, 3)->default(0);
            $table->float('no4_cotp_temp', 10, 3)->default(0);
            $table->float('no4_cots_ullage', 10, 3)->default(0);
            $table->float('no4_cots_temp', 10, 3)->default(0);
            $table->float('no5_cotp_ullage', 10, 3)->default(0);
            $table->float('no5_cotp_temp', 10, 3)->default(0);
            $table->float('no5_cots_ullage', 10, 3)->default(0);
            $table->float('no5_cots_temp', 10, 3)->default(0);
            $table->float('slop_tank_p_ullage', 10, 3)->default(0);
            $table->float('slop_tank_p_temp', 10, 3)->default(0);
            $table->float('slop_tank_s_ullage', 10, 3)->default(0);
            $table->float('slop_tank_s_temp', 10, 3)->default(0);
            $table->float('no1_wbtp__level', 10, 3)->default(0);
            $table->float('no1_wbts_level', 10, 3)->default(0);
            $table->float('no2_wbtp_level', 10, 3)->default(0);
            $table->float('no2_wbts_level', 10, 3)->default(0);
            $table->float('no3_wbtp_level', 10, 3)->default(0);
            $table->float('no3_wbts_level', 10, 3)->default(0);
            $table->float('no4_wbtp_level', 10, 3)->default(0);
            $table->float('no4_wbts_level', 10, 3)->default(0);
            $table->float('no5_wbtp_level', 10, 3)->default(0);
            $table->float('no5_wbts_level', 10, 3)->default(0);
            $table->float('no6_wbtp_level', 10, 3)->default(0);
            $table->float('no6_wbts_level', 10, 3)->default(0);
            $table->float('fptk', 10, 3)->default(0);
            $table->float('aptk', 10, 3)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cargo_9', function (Blueprint $table) {
            //
        });
    }
}
