<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateTankTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tanks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('fleet_id');
            $table->string('tank_position')->index();
            $table->enum('tank_locator', [ 'P', 'S'])->default('P');
            $table->string('contents', 50)->nullable()->default(NULL);
            $table->string('content_type', 50)->nullable()->default(NULL);
            $table->float('capacity', 10, 3)->default(0);
            $table->string('type', 50)->nullable()->default(NULL);
            $table->string('mes_type', 10)->nullable()->default(NULL);
            $table->unsignedInteger('height')->nullable()->default(NULL);
            $table->string('calc_type')->default('match'); // match, interpolate
            $table->datetimes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tanks');
    }
}
