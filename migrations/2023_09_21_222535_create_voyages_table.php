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

class CreateVoyagesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('voyages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('fleet_id');
            $table->string('destination')->nullable();

            $table->integer('last_port_id')->nullable();
            $table->string('last_port')->nullabe();
            $table->string('last_port_unlocode')->nullabe();
            $table->datetime('last_port_time')->nullable();

            $table->integer('next_port_id')->nullable();
            $table->string('next_port_name')->nullabe();
            $table->string('next_port_unlocode')->nullabe();
            $table->datetime('eta')->nullable();

            $table->datetimes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voyages');
    }
}
