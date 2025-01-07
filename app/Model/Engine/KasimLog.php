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

use App\Model\Alarm\SensorAlarmTrait;
use Carbon\Carbon;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Schema\Schema;
use Hyperf\DbConnection\Model\Model;

class KasimLog extends Model
{
    use SensorAlarmTrait, EngineFormColumn;

    /**
     * engine group sensor.
     */
    public array $sensor_group = ['engine'];

    /**
     * The table associated with the model.
     */
    protected ?string $table = 'engine_log';

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
    public static function table($fleetId, $date = null)
    {
        $date = is_null($date) ? date('Ym') : Carbon::parse($date)->format('Ym');
        $model = new self();
        $tableName = $model->getTable() . "_{$fleetId}_{$date}";

        if (! Schema::hasTable($tableName)) {
            Schema::create($tableName, function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('fleet_id')->index();
                $table->datetime('terminal_time')->index();

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
}
