<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class AddRawGpsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('navigations', function (Blueprint $table) {
            $table->string('gps_raw')->after('lng_dir')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('navigations', function (Blueprint $table) {
            $table->dropColumn('gps_raw');
        });
    }
}
