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
namespace App\Model\Engine;

use Carbon\Carbon;
use Hyperf\Database\Model\Events\Updated;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Schema\Schema;
use Hyperf\DbConnection\Model\Model;

class Kasim extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'engines';

    /**
     * The connection name for the model.
     */
    protected ?string $connection = 'default';

    /**
     * all.
     */
    protected array $guarded = ['id'];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = [
        'terminal_time' => 'datetime',
    ];

    // create table cargo if not found table
    public static function table($fleetId)
    {
        $model = new self();
        $tableName = $model->getTable() . "_{$fleetId}";

        if (! Schema::hasTable($tableName)) {
            Schema::create($tableName, function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('fleet_id')->index();
                $table->datetime('terminal_time')->index();
                $table->integer('rpm')->default(0);
                $table->float('me_ht_water_temp_air_cooler_inlet', 10, 3)->default(0);
                $table->float('me_ht_water_temp_cyl_row_inlet', 10, 3)->default(0);
                $table->float('me_lube_oil_temp_cooler_inlet', 10, 3)->default(0);
                $table->float('me_lube_oil_temp_engine_inlet', 10, 3)->default(0);
                $table->float('me_exhaust_gat_temp_cyl1_a', 10, 3)->default(0);
                $table->float('me_exhaust_gat_temp_cyl2_a', 10, 3)->default(0);
                $table->float('me_exhaust_gat_temp_cyl3_a', 10, 3)->default(0);
                $table->float('me_exhaust_gat_temp_cyl4_a', 10, 3)->default(0);
                $table->float('me_exhaust_gat_temp_cyl5_a', 10, 3)->default(0);
                $table->float('me_exhaust_gat_temp_cyl6_a', 10, 3)->default(0);
                $table->float('me_exhaust_gat_temp_cyl7_a', 10, 3)->default(0);
                $table->float('me_exhaust_gat_temp_cyl8_a', 10, 3)->default(0);
                $table->float('me_exhaust_gas_temp_tc_inlet', 10, 3)->default(0);
                $table->float('me_exhaust_gas_temp_tc_outlet', 10, 3)->default(0);
                $table->float('me_ht_water_pressure', 10, 3)->default(0);
                $table->float('me_ht_water_temp_cyl_row_outlet', 10, 3)->default(0);
                $table->float('me_exhaust_gat_temp_cyl1_b', 10, 3)->default(0);
                $table->float('me_exhaust_gat_temp_cyl2_b', 10, 3)->default(0);
                $table->float('me_exhaust_gat_temp_cyl3_b', 10, 3)->default(0);
                $table->float('me_exhaust_gat_temp_cyl4_b', 10, 3)->default(0);
                $table->float('me_exhaust_gat_temp_cyl5_b', 10, 3)->default(0);
                $table->float('me_exhaust_gat_temp_cyl6_b', 10, 3)->default(0);
                $table->float('me_exhaust_gat_temp_cyl7_b', 10, 3)->default(0);
                $table->float('me_exhaust_gat_temp_cyl8_b', 10, 3)->default(0);
                $table->float('me_ht_water_pressure2', 10, 3)->default(0);
                $table->float('me_ht_water_temp_cyl_row_outlet2', 10, 3)->default(0);

                $table->timestamps();
            });
        }

        return $model->setTable($tableName);
    }

    // update & insert
    public function updated(Updated $event)
    {
        $model = $event->getModel();
        $date = $model->terminal_time;
        $last = KasimLog::table($model->fleet_id, $date)->orderBy('terminal_time', 'desc')->first();
        $now = Carbon::parse($date);

        // save interval 60 detik
        if ($last && $now->diffInSeconds($last->terminal_time) < config('mqtt.interval_save', 60)) {
            return;
        }

        return KasimLog::table($model->fleet_id, $date)->updateOrCreate([
            'fleet_id' => $model->fleet_id,
            'terminal_time' => $date,
        ], (array) $model->makeHidden(['id', 'fleet_id', 'created_at', 'updated_at'])->toArray());
    }
}
