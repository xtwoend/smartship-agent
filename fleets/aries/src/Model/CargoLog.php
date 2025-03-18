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
namespace Smartship\Aries\Model;

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
    public static function table($fleetId, $date = null, $payload=[])
    {
        $date = is_null($date) ? date('Ym') : Carbon::parse($date)->format('Ym');
        $model = new self();
        $tableName = $model->getTable() . "_{$fleetId}_{$date}";

        if (! Schema::hasTable($tableName)) {
            Schema::create($tableName, function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('fleet_id')->index();
                $table->datetime('terminal_time')->unique();
                
                // hanla
                $table->float('level_cot_1p')->default(0);
                $table->float('temp_cot_1p')->default(0);
                $table->float('level_cot_1p_mt')->nullable();
                $table->float('level_cot_1s')->default(0);
                $table->float('temp_cot_1s')->default(0);
                $table->float('level_cot_1s_mt')->nullable();
                $table->float('level_cot_2p')->default(0);
                $table->float('temp_cot_2p')->default(0);
                $table->float('level_cot_2p_mt')->nullable();
                $table->float('level_cot_2s')->default(0);
                $table->float('temp_cot_2s')->default(0);
                $table->float('level_cot_2s_mt')->nullable();
                $table->float('level_cot_3p')->default(0);
                $table->float('temp_cot_3p')->default(0);
                $table->float('level_cot_3p_mt')->nullable();
                $table->float('level_cot_3s')->default(0);
                $table->float('temp_cot_3s')->default(0);
                $table->float('level_cot_3s_mt')->nullable();
                $table->float('level_cot_4p')->default(0);
                $table->float('temp_cot_4p')->default(0);
                $table->float('level_cot_4p_mt')->nullable();
                $table->float('level_cot_4s')->default(0);
                $table->float('temp_cot_4s')->default(0);
                $table->float('level_cot_4s_mt')->nullable();
                $table->float('level_cot_5p')->default(0);
                $table->float('temp_cot_5p')->default(0);
                $table->float('level_cot_5p_mt')->nullable();
                $table->float('level_cot_5s')->default(0);
                $table->float('temp_cot_5s')->default(0);
                $table->float('level_cot_5s_mt')->nullable();
                $table->float('level_slop_p')->default(0);
                $table->float('temp_slop_p')->default(0);
                $table->float('level_slop_s')->default(0);
                $table->float('temp_slop_s')->default(0);
                $table->float('fore_peak_tank')->default(0);
                $table->float('level_wbt_1p')->default(0);
                $table->float('level_wbt_1s')->default(0);
                $table->float('level_wbt_2p')->default(0);
                $table->float('level_wbt_2s')->default(0);
                $table->float('level_wbt_3p')->default(0);
                $table->float('level_wbt_3s')->default(0);
                $table->float('level_wbt_4p')->default(0);
                $table->float('level_wbt_4s')->default(0);
                $table->float('level_wbt_5p')->default(0);
                $table->float('level_wbt_5s')->default(0);
                $table->float('level_draft_fore')->default(0);
                $table->float('level_draft_after')->default(0);
                $table->float('after_peak_tank')->default(0);
                $table->float('mdo_mgo_tank_p')->default(0);
                $table->float('mdo_tank_s')->default(0);
                $table->float('fore_fw_tank_p')->default(0);
                $table->float('fore_fw_tank_s')->default(0);
                $table->float('fw_tank_p')->default(0);
                $table->float('fw_tank_s')->default(0);
                $table->float('fo_overflow_tank')->default(0);

                // cargo operation
                $table->datetime('cargo_timestamp')->nullable();
                $table->float('pump_casing_temp_cop1')->default(0);
                $table->float('pump_de_bearing_temp_cop1')->default(0);
                $table->float('trans_bearing_temp_cop1')->default(0);
                $table->float('trans_sealing_temp_cop1')->default(0);
                $table->float('pump_casing_temp_cop2')->default(0);
                $table->float('pump_de_bearing_temp_cop2')->default(0);
                $table->float('trans_bearing_temp_cop2')->default(0);
                $table->float('trans_sealing_temp_cop2')->default(0);
                $table->float('pump_casing_temp_cop3')->default(0);
                $table->float('pump_de_bearing_temp_cop3')->default(0);
                $table->float('trans_bearing_temp_cop3')->default(0);
                $table->float('trans_sealing_temp_cop3')->default(0);
                $table->float('pump_nde_bearing_temp_sp1')->default(0);
                $table->float('pump_casing_temp_sp1')->default(0);
                $table->float('pump_de_bearing_temp_sp1')->default(0);
                $table->float('trans_bearing_sp1')->default(0);
                $table->float('trans_sealing_sp1')->default(0);
                $table->float('pump_nde_bearing_temp_sp2')->default(0);
                $table->float('pump_casing_temp_sp2')->default(0);
                $table->float('pump_de_bearing_temp_sp2')->default(0);
                $table->float('trans_bearing_sp2')->default(0);
                $table->float('trans_sealing_sp2')->default(0);
                $table->float('pump_casing_bp1')->default(0);
                $table->float('pump_de_bearing_bp1')->default(0);
                $table->float('trans_bearing_bp1')->default(0);
                $table->float('trans_sealing_bp1')->default(0);
                $table->float('pump_casing_bp2')->default(0);
                $table->float('pump_de_bearing_bp2')->default(0);
                $table->float('trans_bearing_bp2')->default(0);
                $table->float('trans_sealing_bp2')->default(0);
                $table->float('pump_nde_bearing_tcp')->default(0);
                $table->float('pump_casing_tcp')->default(0);
                $table->float('pump_de_bearing_tcp')->default(0);
                $table->float('trans_bearing_tcp')->default(0);
                $table->float('trans_sealing_tcp')->default(0);
                $table->float('bearing_temp_vp1')->default(0);
                $table->float('bearing_temp_vp2')->default(0);
                $table->float('throttle_valve_cop1')->default(0);
                $table->float('throttle_valve_cop2')->default(0);
                $table->float('throttle_valve_cop3')->default(0);
                $table->float('discharge_pressure_cop1')->default(0);
                $table->float('discharge_pressure_cop2')->default(0);
                $table->float('discharge_pressure_cop3')->default(0);
                $table->float('vibration_cop1')->default(0);
                $table->float('vibration_cop2')->default(0);
                $table->float('vibration_cop3')->default(0);

                // cargo pump status
                $table->datetime('cargo_pump_timestamp')->nullable();
                $table->tinyInteger('cargo_pump1_run')->default(0);
                $table->tinyInteger('cargo_pump2_run')->default(0);
                $table->tinyInteger('cargo_pump3_run')->default(0);
                $table->tinyInteger('stripping_pump1_run')->default(0);
                $table->tinyInteger('stripping_pump2_run')->default(0);
                $table->tinyInteger('ballast_pump_run')->default(0);
                
                $table->timestamps();
            });
        }
        if(count($payload) > 0) {
            $model->addColumn($tableName, $payload);
        }
        return $model->setTable($tableName);
    }

    // Calculate percentage cargo capacity
    public function cargoCapacity($model): void
    {
        $cargoArray = [
            'level_cot_1p',
            'level_cot_1s',
            'level_cot_2p',
            'level_cot_2s',
            'level_cot_3p',
            'level_cot_3s',
            'level_cot_4p',
            'level_cot_4s',
            'level_cot_5p',
            'level_cot_5s',
        ];

        $sensors = \App\Model\Sensor::where('fleet_id', $model->fleet_id)->where('group', 'cargo')->pluck('danger', 'sensor_name')->toArray();
        

        $data = [];
        foreach ($cargoArray as $c) {
            if(! isset($sensors[$c])) continue;
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
