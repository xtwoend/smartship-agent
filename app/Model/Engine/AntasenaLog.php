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

class AntasenaLog extends Model
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
                $table->float('me_rpm', 10, 3)->nullable();
                $table->float('me_exhaust_gas_cyl_1_temp', 10, 3)->nullable();
                $table->float('me_exhaust_gas_cyl_2_temp', 10, 3)->nullable();
                $table->float('me_exhaust_gas_cyl_3_temp', 10, 3)->nullable();
                $table->float('me_exhaust_gas_cyl_4_temp', 10, 3)->nullable();
                $table->float('me_exhaust_gas_cyl_5_temp', 10, 3)->nullable();
                $table->float('me_exhaust_gas_cyl_6_temp', 10, 3)->nullable();
                $table->float('me_exhaust_gas_temp_tc_inlet_no1', 10, 3)->nullable();
                $table->float('me_exhaust_gas_temp_tc_inlet_no2', 10, 3)->nullable();
                $table->float('me_exhaust_gas_temp_tc_outlet', 10, 3)->nullable();
                $table->float('me_fuel_oil_temp_inlet', 10, 3)->nullable();
                $table->float('me_lube_oil_temp_inlet', 10, 3)->nullable();
                $table->float('me_tc_lube_oil_temp_outlet', 10, 3)->nullable();
                $table->float('me_cool_fw_temp_outlet_cyl_no1', 10, 3)->nullable();
                $table->float('me_cool_fw_temp_outlet_cyl_no2', 10, 3)->nullable();
                $table->float('me_cool_fw_temp_outlet_cyl_no3', 10, 3)->nullable();
                $table->float('me_cool_fw_temp_outlet_cyl_no4', 10, 3)->nullable();
                $table->float('me_cool_fw_temp_outlet_cyl_no5', 10, 3)->nullable();
                $table->float('me_cool_fw_temp_outlet_cyl_no6', 10, 3)->nullable();
                $table->float('me_cool_fw_temp_inlet', 10, 3)->nullable();
                $table->float('me_cool_sw_temp_inlet', 10, 3)->nullable();
                $table->float('me_boost_air_temp_inlet', 10, 3)->nullable();
                $table->float('me_starting_air_pressure', 10, 3)->nullable();
                $table->float('me_control_air_pressure', 10, 3)->nullable();
                $table->float('ge1_lube_oil_pressure', 10, 3)->nullable();
                $table->float('ge1_ht_fw_coolant_pressure', 10, 3)->nullable();
                $table->float('ge1_lt_fw_coolant_pressure', 10, 3)->nullable();
                $table->float('ge1_fuel_oil_pressure', 10, 3)->nullable();
                $table->float('ge1_starting_air_pressure', 10, 3)->nullable();
                $table->float('ge1_ht_fw_coolant_temp', 10, 3)->nullable();
                $table->float('ge1_lube_oil_temp', 10, 3)->nullable();
                $table->float('ge1_charge_air_temp', 10, 3)->nullable();
                $table->float('ge1_battery_voltage', 10, 3)->nullable();
                $table->float('ge1_generator_rpm', 10, 3)->nullable();
                $table->float('ge1_spare_1', 10, 3)->nullable();
                $table->float('ge1_spare_2', 10, 3)->nullable();
                $table->float('ge1_spare_3', 10, 3)->nullable();
                $table->float('ge1_spare_4', 10, 3)->nullable();
                $table->float('ge2_lube_oil_pressure', 10, 3)->nullable();
                $table->float('ge2_ht_fw_coolant_pressure', 10, 3)->nullable();
                $table->float('ge2_lt_fw_coolant_pressure', 10, 3)->nullable();
                $table->float('ge2_fuel_oil_pressure', 10, 3)->nullable();
                $table->float('ge2_starting_air_pressure', 10, 3)->nullable();
                $table->float('ge2_ht_fw_coolant_temp', 10, 3)->nullable();
                $table->float('ge2_lube_oil_temp', 10, 3)->nullable();
                $table->float('ge2_charge_air_temp', 10, 3)->nullable();
                $table->float('ge2_battery_voltage', 10, 3)->nullable();
                $table->float('ge2_generator_rpm', 10, 3)->nullable();
                $table->float('ge2_spare_1', 10, 3)->nullable();
                $table->float('ge2_spare_2', 10, 3)->nullable();
                $table->float('ge2_spare_3', 10, 3)->nullable();
                $table->float('ge2_spare_4', 10, 3)->nullable();
                $table->float('ge3_lube_oil_pressure', 10, 3)->nullable();
                $table->float('ge3_ht_fw_coolant_pressure', 10, 3)->nullable();
                $table->float('ge3_lt_fw_coolant_pressure', 10, 3)->nullable();
                $table->float('ge3_fuel_oil_pressure', 10, 3)->nullable();
                $table->float('ge3_starting_air_pressure', 10, 3)->nullable();
                $table->float('ge3_ht_fw_coolant_temp', 10, 3)->nullable();
                $table->float('ge3_lube_oil_temp', 10, 3)->nullable();
                $table->float('ge3_charge_air_temp', 10, 3)->nullable();
                $table->float('ge3_battery_voltage', 10, 3)->nullable();
                $table->float('ge3_generator_rpm', 10, 3)->nullable();
                $table->float('ge3_spare_1', 10, 3)->nullable();
                $table->float('ge3_spare_2', 10, 3)->nullable();
                $table->timestamps();
            });
        }

        return $model->setTable($tableName);
    }
}
