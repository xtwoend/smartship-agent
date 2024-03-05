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

class CreateFleetsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fleets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('active')->default(false);
            $table->string('name');
            $table->string('imo_number')->nullable();
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
        Schema::dropIfExists('fleets');
    }
}
