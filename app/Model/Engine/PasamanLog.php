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

class PasamanLog extends Model
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
                $table->float('me_lo_inlet_pressure', 10, 3)->default(0);
                $table->float('me_tc_lo_inlet_pressure', 10, 3)->default(0);
                $table->float('me_jcw_inlet_pressure', 10, 3)->default(0);
                $table->float('me_fo_inlet_pressure', 10, 3)->default(0);
                $table->float('me_starting_air_pressure', 10, 3)->default(0);
                $table->float('me_scavenging_air_pressure', 10, 3)->default(0);
                $table->float('me_exh_valve_spring_air_pressure', 10, 3)->default(0);
                $table->float('me_cfw_air_cooler_pressure', 10, 3)->default(0);
                $table->float('me_exh_valve_drive_oil_pressure', 10, 3)->default(0);
                $table->float('no1_dg_lo_inlet_pressure', 10, 3)->default(0);
                $table->float('no2_dg_lo_inlet_pressure', 10, 3)->default(0);
                $table->float('no3_dg_lo_inlet_pressure', 10, 3)->default(0);
                $table->timestamps();
            });
        }

        $model->addColumn($tableName, $model);

        return $model->setTable($tableName);
    }
}
