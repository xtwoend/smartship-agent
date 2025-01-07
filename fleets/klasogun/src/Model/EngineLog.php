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
namespace Smartship\Klasogun\Model;

use Carbon\Carbon;
use Hyperf\Database\Schema\Schema;
use Hyperf\DbConnection\Model\Model;
use App\Model\Alarm\SensorAlarmTrait;
use Hyperf\Database\Schema\Blueprint;
use App\Model\Engine\EngineFormColumn;

class EngineLog extends Model
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
                
                // engine
                $table->float('me_fo_inlet_press')->default(0);
                $table->float('no1_main_air_reservoir')->default(0);
                $table->float('no2_main_air_reservoir')->default(0);
                $table->float('me_lub_oil_inlet')->default(0);
                $table->float('me_control_air')->default(0);
                $table->float('me_starting_air')->default(0);
                $table->float('me_charge_air_cylinder_inlet')->default(0);
                $table->float('me_cooling_sea_water_inlet')->default(0);
                $table->float('me_cooling_fresh_water_inlet')->default(0);
                
                $table->timestamps();
            });
        }

        $model->addColumn($tableName);
        
        return $model->setTable($tableName);
    }
}
