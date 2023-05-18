<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateVesselsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vessels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('imo_number');
            $table->string('image')->nullable();
            $table->string('owner')->nullable();
            $table->string('ship_manager')->nullable();
            $table->string('cargo')->nullable();
            $table->string('type')->nullable();
            $table->string('email')->nullable();
            $table->string('telp')->nullable();
            $table->string('call_sign')->nullable();
            $table->string('builder')->nullable();
            $table->string('year')->nullable();
            $table->string('flag')->nullable();
            $table->boolean('connected')->default(false);
            $table->timestamp('last_connection')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vessels');
    }
}
