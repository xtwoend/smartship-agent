<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateEnginesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('engines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('fleet_id');
            $table->timestamp('terminal_time')->index();
            $table->float('control_air_inlet', 12, 6)->default(0);
            $table->float('me_ac_cw_inlet_cooler', 12, 6)->default(0);
            $table->float('jcw_inlet', 12, 6)->default(0);
            $table->float('me_lo_inlet', 12, 6)->default(0);
            $table->float('scav_air_receiver', 12, 6)->default(0);
            $table->float('start_air_inlet', 12, 6)->default(0);
            $table->float('main_lub_oil', 12, 6)->default(0);
            $table->float('me_fo_inlet_engine', 12, 6)->default(0);
            $table->float('turbo_charger_speed_no_1', 12, 6)->default(0);
            $table->float('turbo_charger_speed_no_2', 12, 6)->default(0);
            $table->float('turbo_charger_speed_no_3', 12, 6)->default(0);
            $table->float('tachometer_turbocharge', 12, 6)->default(0);
            $table->float('main_engine_speed', 12, 6)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('engines');
    }
}
