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
namespace App\Model\Cargo;

use Carbon\Carbon;
use App\Model\Sensor;
use Hyperf\Database\Schema\Schema;
use App\Model\Traits\HasColumnTrait;
use Hyperf\DbConnection\Model\Model;
use App\Model\Alarm\SensorAlarmTrait;
use Hyperf\Database\Schema\Blueprint;

class TypeSLog extends Model
{
    use SensorAlarmTrait;
    use HasColumnTrait;

    /**
     * engine group sensor.
     */
    public array $sensor_group = ['cargo'];

    /**
     * The table associated with the model.
     */
    protected ?string $table = 'cargo_log';

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
        'cargo_pump1_run' => 'boolean',
        'cargo_pump1_alarm' => 'boolean',
        'cargo_pump2_run' => 'boolean',
        'cargo_pump2_alarm' => 'boolean',
        'cargo_pump3_run' => 'boolean',
        'cargo_pump3_alarm' => 'boolean',
        'ballast_pump1_run' => 'boolean',
        'ballast_pump1_alarm' => 'boolean',
        'ballast_pump2_run' => 'boolean',
        'ballast_pump2_alarm' => 'boolean',
        'stripping_pump_run' => 'boolean',
        'stripping_pump_alarm' => 'boolean',
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
                $table->datetime('terminal_time')->unique();
                $table->float('tank_1_port', 10, 3)->default(0);
                $table->float('tank_1_port_temp', 10, 3)->default(0);
                $table->float('tank_1_stb', 10, 3)->default(0);
                $table->float('tank_1_stb_temp', 10, 3)->default(0);
                $table->float('tank_2_port', 10, 3)->default(0);
                $table->float('tank_2_port_temp', 10, 3)->default(0);
                $table->float('tank_2_stb', 10, 3)->default(0);
                $table->float('tank_2_stb_temp', 10, 3)->default(0);
                $table->float('tank_3_port', 10, 3)->default(0);
                $table->float('tank_3_port_temp', 10, 3)->default(0);
                $table->float('tank_3_stb', 10, 3)->default(0);
                $table->float('tank_3_stb_temp', 10, 3)->default(0);
                $table->float('tank_4_port', 10, 3)->default(0);
                $table->float('tank_4_port_temp', 10, 3)->default(0);
                $table->float('tank_4_stb', 10, 3)->default(0);
                $table->float('tank_4_stb_temp', 10, 3)->default(0);
                $table->float('tank_5_port', 10, 3)->default(0);
                $table->float('tank_5_port_temp', 10, 3)->default(0);
                $table->float('tank_5_stb', 10, 3)->default(0);
                $table->float('tank_5_stb_temp', 10, 3)->default(0);
                $table->float('tank_6_port', 10, 3)->default(0);
                $table->float('tank_6_port_temp', 10, 3)->default(0);
                $table->float('tank_6_stb', 10, 3)->default(0);
                $table->float('tank_6_stb_temp', 10, 3)->default(0);

                $table->float('slop_port', 10, 3)->default(0);
                $table->float('slop_port_temp', 10, 3)->default(0);
                $table->float('slop_stb', 10, 3)->default(0);
                $table->float('slop_stb_temp', 10, 3)->default(0);

                $table->float('draft_front', 10, 3)->default(0);
                $table->float('draft_center_left', 10, 3)->default(0);
                $table->float('draft_center_right', 10, 3)->default(0);
                $table->float('draft_rear', 10, 3)->default(0);

                $table->float('fore_peak', 10, 3)->default(0);

                $table->float('water_ballas_1_port', 10, 3)->default(0);
                $table->float('water_ballas_1_stb', 10, 3)->default(0);
                $table->float('water_ballas_2_port', 10, 3)->default(0);
                $table->float('water_ballas_2_stb', 10, 3)->default(0);
                $table->float('water_ballas_3_port', 10, 3)->default(0);
                $table->float('water_ballas_3_stb', 10, 3)->default(0);
                $table->float('water_ballas_4_port', 10, 3)->default(0);
                $table->float('water_ballas_4_stb', 10, 3)->default(0);
                $table->float('water_ballas_5_port', 10, 3)->default(0);
                $table->float('water_ballas_5_stb', 10, 3)->default(0);
                $table->float('water_ballas_6_port', 10, 3)->default(0);
                $table->float('water_ballas_6_stb', 10, 3)->default(0);

                $table->float('after_peak', 10, 3)->default(0);

                $table->float('fuel_oil_1_port', 10, 3)->default(0);
                $table->float('fuel_oil_1_stb', 10, 3)->default(0);
                $table->float('fuel_oil_2_port', 10, 3)->default(0);
                $table->float('fuel_oil_2_stb', 10, 3)->default(0);

                $table->float('muel_oil_1_port', 10, 3)->default(0);
                $table->float('muel_oil_1_stb', 10, 3)->default(0);
                $table->float('muel_oil_2_port', 10, 3)->default(0);

                $table->float('do_fuel_oil_service_stb', 10, 3)->default(0);
                $table->float('do_fuel_oil_settling_stb', 10, 3)->default(0);
                $table->float('fuel_oil_service_port', 10, 3)->default(0);
                $table->float('fuel_oil_settling_port', 10, 3)->default(0);

                $table->float('ls_fuel_oil_service_port', 10, 3)->default(0);
                $table->float('ls_fuel_oil_settling_port', 10, 3)->default(0);

                // pump status
                $table->boolean('cargo_pump1_run')->default(false);
                $table->boolean('cargo_pump1_alarm')->default(false);
                $table->boolean('cargo_pump2_run')->default(false);
                $table->boolean('cargo_pump2_alarm')->default(false);
                $table->boolean('cargo_pump3_run')->default(false);
                $table->boolean('cargo_pump3_alarm')->default(false);

                $table->boolean('ballast_pump1_run')->default(false);
                $table->boolean('ballast_pump1_alarm')->default(false);
                $table->boolean('ballast_pump2_run')->default(false);
                $table->boolean('ballast_pump2_alarm')->default(false);
                $table->boolean('stripping_pump_run')->default(false);
                $table->boolean('stripping_pump_alarm')->default(false);

                $table->timestamps();
            });
        }

        $model->addColumn($tableName, [
            [
                'type' => 'float',
                'name' => 'tank_1_port_mt',
                'after' => 'tank_1_port',
            ],
            [
                'type' => 'float',
                'name' => 'tank_1_stb_mt',
                'after' => 'tank_1_stb',
            ],
            [
                'type' => 'float',
                'name' => 'tank_2_port_mt',
                'after' => 'tank_2_port',
            ],
            [
                'type' => 'float',
                'name' => 'tank_2_stb_mt',
                'after' => 'tank_2_stb',
            ],
            [
                'type' => 'float',
                'name' => 'tank_3_port_mt',
                'after' => 'tank_3_port',
            ],
            [
                'type' => 'float',
                'name' => 'tank_3_stb_mt',
                'after' => 'tank_3_stb',
            ],
            [
                'type' => 'float',
                'name' => 'tank_4_port_mt',
                'after' => 'tank_4_port',
            ],
            [
                'type' => 'float',
                'name' => 'tank_4_stb_mt',
                'after' => 'tank_4_stb',
            ],
            [
                'type' => 'float',
                'name' => 'tank_5_port_mt',
                'after' => 'tank_5_port',
            ],
            [
                'type' => 'float',
                'name' => 'tank_5_stb_mt',
                'after' => 'tank_5_stb',
            ],
            [
                'type' => 'float',
                'name' => 'tank_6_port_mt',
                'after' => 'tank_6_port',
            ],
            [
                'type' => 'float',
                'name' => 'tank_6_stb_mt',
                'after' => 'tank_6_stb',
            ],
        ]);

        return $model->setTable($tableName);
    }

    // Calculate percentage cargo capacity
    public function cargoCapacity($model): void
    {
        $cargoArray = [
            'tank_1_port',
            'tank_2_port',
            'tank_3_port',
            'tank_4_port',
            'tank_5_port',
            'tank_6_port',
            'tank_1_stb',
            'tank_2_stb',
            'tank_3_stb',
            'tank_4_stb',
            'tank_5_stb',
            'tank_6_stb',
        ];

        $sensors = \App\Model\Sensor::where('fleet_id', $model->fleet_id)->where('group', 'cargo')->pluck('danger', 'sensor_name')->toArray();
        $data = [];
        foreach ($cargoArray as $c) {
            $max = $sensors[$c];
            $value = $model->{$c};

            $percentage = ($value <= $max) ? ($value / $max) : 0;
            $data[$c] = (1 - $percentage);
        }

        $totalPercentage = 0;
        foreach ($data as $d) {
            $totalPercentage += $d;
        }

        $percentageCargo = $totalPercentage / count($cargoArray);

        // save
        $now = \Carbon\Carbon::now();
        $fsr = \App\Model\FleetDailyReport::table($model->fleet_id)->where([
            'fleet_id' => $model->fleet_id,
            'date' => $now->format('Y-m-d'),
            'sensor' => 'cargo_percentage',
        ])->first();

        if (! $fsr) {
            $fsr = \App\Model\FleetDailyReport::table($model->fleet_id);
            $fsr->fleet_id = $model->fleet_id;
            $fsr->date = $now->format('Y-m-d');
            $fsr->sensor = 'cargo_percentage';
            $fsr->before = $percentageCargo;
        }

        $fsr->after = $percentageCargo;
        $fsr->value = ($fsr->after - $fsr->before);
        $fsr->save();
    }
}
