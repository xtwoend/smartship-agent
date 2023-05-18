<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateNavigationTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('navigations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('vessel_id');
            $table->timestamp('terminal_time')->index();
            $table->float('wind_speed')->default(0);
            $table->float('wind_direction')->default(0);
            $table->float('lat', 15, 6)->default(0);
            $table->string('lat_dir')->nullable();
            $table->float('lng', 15, 6)->default(0);
            $table->string('lng_dir')->nullable();
            $table->string('datum_refrence')->nullable();
            $table->float('sog')->default(0);
            $table->float('cog')->default(0);
            $table->float('total_distance')->default(0);
            $table->float('distance')->default(0);
            $table->float('heading')->default(0);
            $table->float('rot')->default(0);
            $table->float('depth')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('navigations');
    }
}
