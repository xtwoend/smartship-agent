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

namespace Smartship\Krasak\Model;

use Carbon\Carbon;
use Hyperf\Database\Schema\Schema;
use App\Model\Traits\HasColumnTrait;
use Hyperf\DbConnection\Model\Model;
use App\Model\Alarm\SensorAlarmTrait;
use Hyperf\Database\Schema\Blueprint;

class CargoLog extends Model
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
    ];

    // create table cargo if not found table
    public static function table($fleetId, $date = null, $payload = [])
    {
        $date = is_null($date) ? date('Ym') : Carbon::parse($date)->format('Ym');
        $model = new self();
        $tableName = $model->getTable() . "_{$fleetId}_{$date}";

        if (! Schema::hasTable($tableName)) {
            Schema::create($tableName, function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('fleet_id')->index();
                $table->datetime('terminal_time')->unique();

                // cargo data
                $table->datetime('cargo_timestamp')->nullable();
                $table->float('temp_ballast1_driver_end_bearing_port')->default(0);
                $table->float('temp_ballast1_trans_bearing_port')->default(0);
                $table->float('temp_ballast2_driver_end_bearing_starboard')->default(0);
                $table->float('temp_ballast2_trans_bearing_starboard')->default(0);
                $table->float('temp_cargo2_pump_casing_center')->default(0);
                $table->float('temp_cargo2_driver_end_bearing_center')->default(0);
                $table->float('temp_cargo2_trans_bearing_center')->default(0);
                $table->float('temp_cargo1_pump_casing_port')->default(0);
                $table->float('temp_cargo1_driver_end_beearing_port')->default(0);
                $table->float('temp_cargo1_trans_bearing_port')->default(0);
                $table->float('temp_cargo3_pump_casing_starboard')->default(0);
                $table->float('temp_cargo3_driver_end_bearing_startboard')->default(0);
                $table->float('temp_cargo3_trans_bearing_port')->default(0);
                $table->float('temp_stripping1_end_bearing_port')->default(0);
                $table->float('temp_stripping1_driver_end_bearing_port')->default(0);
                $table->float('temp_stripping1_trans_bearing_port')->default(0);
                $table->float('temp_stripping2_end_bearing_startboard')->default(0);
                $table->float('temp_stripping2_driver_end_bearing_startboard')->default(0);
                $table->float('temp_stripping2_trans_bearing_startboard')->default(0);
                $table->float('temp_cleanning_driver_end_bearing_port')->default(0);
                $table->float('temp_cleanning_trans_bearing_port')->default(0);

                // pump status
                $table->datetime('cargo_pump_timestamp')->nullable();
                $table->boolean('cleannig_pump_run')->default(false);
                $table->boolean('stripping2_pump_port_run')->default(false);
                $table->boolean('strriping1_pump_stbd_run')->default(false);
                $table->boolean('cargo3_pump_port_run')->default(false);
                $table->boolean('cargo2_pump_center_run')->default(false);
                $table->boolean('cargo1_pump_stbd_run')->default(false);
                $table->boolean('ballast2_pump_port_run')->default(false);
                $table->boolean('ballast1_pump_stbd_run')->default(false);

                $table->timestamps();
            });
        }
        if (count($payload) > 0) {
            $model->addColumn($tableName, $payload);
        }
        return $model->setTable($tableName);
    }

    // Calculate percentage cargo capacity
    public function cargoCapacity($model): void
    {
        // $cargoArray = [
        //     'level_cot_1p',
        //     'level_cot_1s',
        //     'level_cot_2p',
        //     'level_cot_2s',
        //     'level_cot_3p',
        //     'level_cot_3s',
        //     'level_cot_4p',
        //     'level_cot_4s',
        //     'level_cot_5p',
        //     'level_cot_5s',
        // ];

        // $sensors = \App\Model\Sensor::where('fleet_id', $model->fleet_id)->where('group', 'cargo')->pluck('danger', 'sensor_name')->toArray();


        // $data = [];
        // foreach ($cargoArray as $c) {
        //     if(! isset($sensors[$c])) continue;
        //     $max = $sensors[$c];
        //     $value = $model->{$c};

        //     $percentage = ($value <= $max) ? ($value / $max) : 0;
        //     $data[$c] = (1 - $percentage);
        // }

        // $totalPercentage = 0;
        // foreach ($data as $d) {
        //     $totalPercentage += $d;
        // }

        // $percentageCargo = $totalPercentage / count($cargoArray);

        // // save
        // $now = \Carbon\Carbon::now();
        // $fsr = \App\Model\FleetDailyReport::table($model->fleet_id)->where([
        //     'fleet_id' => $model->fleet_id,
        //     'date' => $now->format('Y-m-d'),
        //     'sensor' => 'cargo_percentage',
        // ])->first();

        // if (! $fsr) {
        //     $fsr = \App\Model\FleetDailyReport::table($model->fleet_id);
        //     $fsr->fleet_id = $model->fleet_id;
        //     $fsr->date = $now->format('Y-m-d');
        //     $fsr->sensor = 'cargo_percentage';
        //     $fsr->before = $percentageCargo;
        // }

        // $fsr->after = $percentageCargo;
        // $fsr->value = ($fsr->after - $fsr->before);
        // $fsr->save();
    }
}
