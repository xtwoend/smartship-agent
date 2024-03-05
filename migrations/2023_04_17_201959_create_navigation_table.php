<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
use Hyperf\Database\Migrations\Migration;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Schema\Schema;

class CreateNavigationTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('navigations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('fleet_id');
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
