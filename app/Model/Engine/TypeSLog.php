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

class TypeSLog extends Model
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
                $table->float('control_air_inlet', 12, 6)->default(0);
                $table->float('me_ac_cw_inlet_cooler', 12, 6)->default(0);
                $table->float('jcw_inlet', 12, 6)->default(0);
                $table->float('me_lo_inlet', 12, 6)->default(0);
                $table->float('scav_air_receiver', 12, 6)->default(0);
                $table->float('start_air_inlet', 12, 6)->default(0);
                $table->float('main_lub_oil', 12, 6)->default(0);
                $table->float('me_fo_inlet_engine', 12, 6)->default(0);
                $table->float('turbo_charger_speed_no_1', 12, 6)->default(0);
                $table->float('turbo_charger_speed_no_2', 12, 6)->default(0);
                $table->float('turbo_charger_speed_no_3', 12, 6)->default(0);
                $table->float('tachometer_turbocharge', 12, 6)->default(0);
                $table->float('main_engine_speed', 12, 6)->default(0);
                $table->timestamps();
            });
        }

        $model->addColumn($tableName);
        
        return $model->setTable($tableName);
    }
}
