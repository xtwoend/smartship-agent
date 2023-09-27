<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class AddPagerunganBunker extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('engines_12', function (Blueprint $table) {
            $table->float('hfo_storage_tank_1p', 10, 3)->default(0);
            $table->float('hfo_storage_tank_1s', 10, 3)->default(0);
            $table->float('hfo_storage_tank_2p', 10, 3)->default(0);
            $table->float('hfo_storage_tank_2s', 10, 3)->default(0);
            $table->float('hfo_setting_tank', 10, 3)->default(0);
            $table->float('hfo_service_tank_1', 10, 3)->default(0);
            $table->float('hfo_service_tank_2', 10, 3)->default(0);
            $table->float('mdo_storage_tank_p', 10, 3)->default(0);
            $table->float('mdo_storage_tank_s', 10, 3)->default(0);
            $table->float('mdo_setting_tank', 10, 3)->default(0);
            $table->float('mdo_service_tank_1', 10, 3)->default(0);
            $table->float('mdo_service_tank_2', 10, 3)->default(0);
        });

        Schema::table('engine_log_12_202309', function (Blueprint $table) {
            $table->float('hfo_storage_tank_1p', 10, 3)->default(0);
            $table->float('hfo_storage_tank_1s', 10, 3)->default(0);
            $table->float('hfo_storage_tank_2p', 10, 3)->default(0);
            $table->float('hfo_storage_tank_2s', 10, 3)->default(0);
            $table->float('hfo_setting_tank', 10, 3)->default(0);
            $table->float('hfo_service_tank_1', 10, 3)->default(0);
            $table->float('hfo_service_tank_2', 10, 3)->default(0);
            $table->float('mdo_storage_tank_p', 10, 3)->default(0);
            $table->float('mdo_storage_tank_s', 10, 3)->default(0);
            $table->float('mdo_setting_tank', 10, 3)->default(0);
            $table->float('mdo_service_tank_1', 10, 3)->default(0);
            $table->float('mdo_service_tank_2', 10, 3)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('', function (Blueprint $table) {
            //
        });
    }
}
