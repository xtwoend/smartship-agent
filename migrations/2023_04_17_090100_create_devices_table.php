<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateDevicesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('fleet_id');
            $table->string('name');
            $table->string('mqtt_server')->nullable();
            $table->string('topic')->nullable();
            $table->string('extractor')->nullable();
            $table->string('log_model')->nullable();
            $table->boolean('connected')->default(false);
            $table->boolean('active')->default(false);
            $table->timestamp('last_connected')->nullable();
            $table->longText('last_message')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devices');
    }
}
