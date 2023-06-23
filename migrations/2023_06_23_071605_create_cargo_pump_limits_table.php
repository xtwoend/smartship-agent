<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateCargoPumpLimitsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cargo_pump_limits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('fleet_id');
            $table->string('fleet_type')->nullable();
            $table->string('name');
            $table->string('sensor_name');
            $table->string('unit')->nullable();
            $table->float('normal_limit', 15, 5)->default(0);
            $table->float('warning_limit', 15, 5)->default(0);
            $table->float('danger_limit', 15, 5)->default(0);
            $table->float('max_limit', 15, 5)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cargo_pump_limits');
    }
}
