<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateFleetAveragesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fleet_averages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('fleet_id');
            $table->date('collected_date')->nullable();
            $table->float('sog')->default(0);
            $table->integer('distance')->default(0);
            $table->float('cargo_percentage', 5, 2)->default(0);
            $table->float('bunker_percentage', 5, 2)->default(0);
            $table->float('pump_rate', 5, 2)->default(0);
            $table->datetimes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fleet_averages');
    }
}
