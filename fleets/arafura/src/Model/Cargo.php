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

namespace Smartship\Arafura\Model;

use Carbon\Carbon;
use App\Model\Cargo\CargoTrait;
use Hyperf\Database\Schema\Schema;
use App\Model\Traits\HasColumnTrait;
use Hyperf\DbConnection\Model\Model;
use Hyperf\Database\Schema\Blueprint;
use App\Model\Traits\CargoTankCalculate;
use Hyperf\Database\Model\Events\Updated;
use Hyperf\Database\Model\Events\Updating;
use App\Model\Traits\BunkerCapacityCalculate;

class Cargo extends Model
{
    use HasColumnTrait;
    use CargoTankCalculate;
    use BunkerCapacityCalculate;
    use CargoTrait;

    /**
     * The table associated with the model.
     */
    protected ?string $table = 'cargo';

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

    public ?array $cargoTanks = [
        'level_cot_1p' => ['port', ['level_cot_1p_mt', 'level_cot_1p_ltr'], ['mes_type' => 'level', 'content' => '', 'compare' => ['temp_cot_1p']]],
        'level_cot_1s' => ['stb', ['level_cot_1s_mt', 'level_cot_1s_ltr'], ['mes_type' => 'level', 'content' => '', 'compare' => ['temp_cot_1s']]],
        'level_cot_2p' => ['port', ['level_cot_2p_mt', 'level_cot_2p_ltr'], ['mes_type' => 'level', 'content' => '', 'compare' => ['temp_cot_2p']]],
        'level_cot_2s' => ['stb', ['level_cot_2s_mt', 'level_cot_2s_ltr'], ['mes_type' => 'level', 'content' => '', 'compare' => ['temp_cot_2s']]],
        'level_cot_3p' => ['port', ['level_cot_3p_mt', 'level_cot_3p_ltr'], ['mes_type' => 'level', 'content' => '', 'compare' => ['temp_cot_3p']]],
        'level_cot_3s' => ['stb', ['level_cot_3s_mt', 'level_cot_3s_ltr'], ['mes_type' => 'level', 'content' => '', 'compare' => ['temp_cot_3s']]],
        'level_cot_4p' => ['port', ['level_cot_4p_mt', 'level_cot_4p_ltr'], ['mes_type' => 'level', 'content' => '', 'compare' => ['temp_cot_4p']]],
        'level_cot_4s' => ['stb', ['level_cot_4s_mt', 'level_cot_4s_ltr'], ['mes_type' => 'level', 'content' => '', 'compare' => ['temp_cot_4s']]],
        'level_cot_5p' => ['port', ['level_cot_5p_mt', 'level_cot_5p_ltr'], ['mes_type' => 'level', 'content' => '', 'compare' => ['temp_cot_5p']]],
        'level_cot_5s' => ['stb', ['level_cot_5s_mt', 'level_cot_5s_ltr'], ['mes_type' => 'level', 'content' => '', 'compare' => ['temp_cot_5s']]],
        'level_slop_p' => ['port', ['level_slop_p_mt', 'level_slop_p_ltr'], ['mes_type' => 'level', 'content' => '', 'compare' => ['temp_slop_p']]],
        'level_slop_s' => ['stb', ['level_slop_s_mt', 'level_slop_s_ltr'], ['mes_type' => 'level', 'content' => '', 'compare' => ['temp_slop_s']]],
    ];

    public ?array $bunkerTanks = [];

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
        $tablePayload = $model->tablePayloadBuilder($model);
        $model->addColumn($tableName, $tablePayload);
        $logModel = new CargoLog();
        $logModel->table($fleetId, null, $tablePayload);
        return $model->setTable($tableName);
    }

    public function updating(Updating $event)
    {
        $model = $event->getModel();
        $this->terminal_time = Carbon::now()->format('Y-m-d H:i:s');
        // calculate cargo
        $cargoData = $this->calculate($model);
        $this->terminal_time = Carbon::now()->format('Y-m-d H:i:s');
        $cargoData = $this->calculate($model);
        $updates = array_merge($cargoData, $this->bunkerCalculate($model));

        foreach ($cargoData as $k => $v) {
            $this->{$k} = $v;
        }
    }

    // update & insert
    public function updated(Updated $event)
    {
        $model = $event->getModel();

        $date = $model->terminal_time;
        $last = CargoLog::table($model->fleet_id, $date)->orderBy('terminal_time', 'desc')->first();

        $now = Carbon::parse($date);

        // save interval 60 detik
        if ($last && $now->diffInSeconds($last->terminal_time) < config('mqtt.interval_save', 60)) {
            return;
        }

        return CargoLog::table($model->fleet_id, $date)->updateOrCreate([
            'fleet_id' => $model->fleet_id,
            'terminal_time' => $date,
        ], (array) $model->makeHidden(['id', 'bunkers', 'cargos', 'fleet_id', 'created_at', 'updated_at'])->toArray());
    }

    public ?array $tanks = [
        'level_cot_1p_mt' => ['level_cot_1p', 'temp_cot_1p'],
        'level_cot_1s_mt' => ['level_cot_1s', 'temp_cot_1s'],
        'level_cot_2p_mt' => ['level_cot_2p', 'temp_cot_2p'],
        'level_cot_2s_mt' => ['level_cot_2s', 'temp_cot_2s'],
        'level_cot_3p_mt' => ['level_cot_3p', 'temp_cot_3p'],
        'level_cot_3s_mt' => ['level_cot_3s', 'temp_cot_3s'],
        'level_cot_4p_mt' => ['level_cot_4p', 'temp_cot_4p'],
        'level_cot_4s_mt' => ['level_cot_4s', 'temp_cot_1s'],
        'level_cot_5p_mt' => ['level_cot_5p', 'temp_cot_5p'],
        'level_cot_5s_mt' => ['level_cot_5s', 'temp_cot_5s'],
    ];
}
