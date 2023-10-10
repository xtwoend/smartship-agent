<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateMqttLogTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mqtt_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('fleet_id');
            $table->string('topic')->nullable();
            $table->text('message')->nullable();
            $table->datetimes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mqtt_logs');
    }
}
