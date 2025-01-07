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

class KakapLog extends Model
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
                $table->float('fuel_oil_inlet_pressure', 10, 3)->default(0);
                $table->float('fuel_oil_inlet_temperature', 10, 3)->default(0);
                $table->float('lube_oil_inlet_pressure', 10, 3)->default(0);
                $table->float('lube_oil_inlet_temperature', 10, 3)->default(0);
                $table->float('lube_oil_filter_differential_pressure', 10, 3)->default(0);
                $table->float('lube_oil_turbocharger_pressure', 10, 3)->default(0);
                $table->float('lube_oil_turbocharger_outlet_temperature', 10, 3)->default(0);
                $table->float('starting_air_pressure', 10, 3)->default(0);
                $table->float('control_air_pressure', 10, 3)->default(0);
                $table->float('h_t_water_pressure_inlet', 10, 3)->default(0);
                $table->float('h_t_water_temperature_inlet', 10, 3)->default(0);
                $table->float('h_t_water_temperature_outlet', 10, 3)->default(0);
                $table->float('l_t_water_pressure_inlet', 10, 3)->default(0);
                $table->float('l_t_water_temperature_inlet', 10, 3)->default(0);
                $table->float('l_t_water_tempeature_l_o_c_outlet', 10, 3)->default(0);
                $table->float('exhaust_gas_temperature_t_c_inlet1', 10, 3)->default(0);
                $table->float('exhaust_gas_temperature_t_c_outlet', 10, 3)->default(0);
                $table->float('exhaust_gas_temperature_cylinder1', 10, 3)->default(0);
                $table->float('exhaust_gas_temperature_cylinder2', 10, 3)->default(0);
                $table->float('exhaust_gas_temperature_cylinder3', 10, 3)->default(0);
                $table->float('exhaust_gas_temperature_cylinder4', 10, 3)->default(0);
                $table->float('exhaust_gas_temperature_cylinder5', 10, 3)->default(0);
                $table->float('exhaust_gas_temperature_cylinder6', 10, 3)->default(0);
                $table->float('exhaust_gas_temperature_average', 10, 3)->default(0);
                $table->float('exhaust_gas_temp_deviation1_a', 10, 3)->default(0);
                $table->float('exhaust_gas_temp_deviation2_a', 10, 3)->default(0);
                $table->float('exhaust_gas_temp_deviation3_a', 10, 3)->default(0);
                $table->float('exhaust_gas_temp_deviation4_a', 10, 3)->default(0);
                $table->float('exhaust_gas_temp_deviation5_a', 10, 3)->default(0);
                $table->float('exhaust_gas_temp_deviation6_a', 10, 3)->default(0);
                $table->float('charge_air_pressure_inlet', 10, 3)->default(0);
                $table->float('charge_air_temperature_inlet', 10, 3)->default(0);
                $table->float('main_bearing_temp0', 10, 3)->default(0);
                $table->float('main_bearing_temp1', 10, 3)->default(0);
                $table->float('main_bearing_temp2', 10, 3)->default(0);
                $table->float('main_bearing_temp3', 10, 3)->default(0);
                $table->float('main_bearing_temp4', 10, 3)->default(0);
                $table->float('main_bearing_temp5', 10, 3)->default(0);
                $table->float('main_bearing_temp6', 10, 3)->default(0);
                $table->float('main_bearing_temp7', 10, 3)->default(0);
                $table->float('crankcase_pressure', 10, 3)->default(0);
                $table->float('fuel_rack_position', 10, 3)->default(0);
                $table->float('turbocharger_speed', 10, 3)->default(0);
                $table->float('modbus_counter', 10, 3)->default(0);
                $table->float('engine_speed', 10, 3)->default(0);
                $table->float('torsional_vibration_level', 10, 3)->default(0);
                $table->float('cylinder_a1_liner_temperature1', 10, 3)->default(0);
                $table->float('cylinder_a1_liner_temperature2', 10, 3)->default(0);
                $table->float('cylinder_a2_liner_temperature1', 10, 3)->default(0);
                $table->float('cylinder_a2_liner_temperature2', 10, 3)->default(0);
                $table->float('cylinder_a3_liner_temperature1', 10, 3)->default(0);
                $table->float('cylinder_a3_liner_temperature2', 10, 3)->default(0);
                $table->float('cylinder_a4_liner_temperature1', 10, 3)->default(0);
                $table->float('cylinder_a4_liner_temperature2', 10, 3)->default(0);
                $table->float('cylinder_a5_liner_temperature1', 10, 3)->default(0);
                $table->float('cylinder_a5_liner_temperature2', 10, 3)->default(0);
                $table->float('cylinder_a6_liner_temperature1', 10, 3)->default(0);
                $table->float('cylinder_a6_liner_temperature2', 10, 3)->default(0);
                $table->timestamps();
            });
        }

        $model->addColumn($tableName, $model);

        return $model->setTable($tableName);
    }
}
