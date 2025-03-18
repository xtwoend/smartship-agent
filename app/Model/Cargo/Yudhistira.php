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
use Hyperf\Database\Schema\Schema;
use App\Model\Traits\HasColumnTrait;
use Hyperf\DbConnection\Model\Model;
use Hyperf\Database\Schema\Blueprint;
use App\Model\Traits\CargoTankCalculate;
use Hyperf\Database\Model\Events\Updated;
use Hyperf\Database\Model\Events\Updating;
use App\Model\Traits\BunkerCapacityCalculate;

class Yudhistira extends Model
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
    ];
    

    public ?array $bunkerTanks = [
        'after_peak_tank_m3'         => ['port',    ['after_peak_tank_m3', 'after_peak_tank_ltr', 'after_peak_tank_mt'],  ['mes_type' => 'level', 'content' => '']],
        'mdo_tank_p_m3'      => ['port',    ['mdo_mgo_tank_p_m3', 'mdo_mgo_tank_p_ltr', 'mdo_mgo_tank_p_mt'],    ['mes_type' => 'level', 'content' => 'MDO']],
        'mdo_tank_s_m3'      => ['stb', ['mdo_tank_s_m3', 'mdo_tank_s_ltr', 'mdo_tank_s_mt'],    ['mes_type' => 'level', 'content' => 'MDO']],
        'fore_fw_tank_p_m3'      => ['port',    ['fore_fw_tank_p_m3', 'fore_fw_tank_p_ltr', 'fore_fw_tank_p_mt'],    ['mes_type' => 'level', 'content' => '']],
        'fore_fw_tank_s_m3'      => ['stb', ['fore_fw_tank_s_m3', 'fore_fw_tank_s_ltr', 'fore_fw_tank_s_mt'],    ['mes_type' => 'level', 'content' => '']],
        'fw_tank_p_m3'       => ['port',    ['fw_tank_p_m3', 'fw_tank_p_ltr', 'fw_tank_p_mt'],  ['mes_type' => 'level', 'content' => '']],
        'fw_tank_s_m3'       => ['stb', ['fw_tank_s_m3', 'fw_tank_s_ltr', 'fw_tank_s_mt'],  ['mes_type' => 'level', 'content' => '']],
        'fo_overflow_tank_m3'        => ['port',    ['fo_overflow_tank_m3', 'fo_overflow_tank_ltr', 'fo_overflow_tank_mt'],    ['mes_type' => 'level', 'content' => '']],
    ];

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
                // cargo
                $table->datetime('cargo_timestamp')->nullable();
                $table->float('pump_casing_temp_cop1', 10, 3)->nullable();
                $table->float('pump_de_bearing_temp_cop1', 10, 3)->nullable();
                $table->float('trans_bearing_temp_cop1', 10, 3)->nullable();
                $table->float('trans_sealing_temp_cop1', 10, 3)->nullable();
                $table->float('pump_casing_temp_cop2', 10, 3)->nullable();
                $table->float('pump_de_bearing_temp_cop2', 10, 3)->nullable();
                $table->float('trans_bearing_temp_cop2', 10, 3)->nullable();
                $table->float('trans_sealing_temp_cop2', 10, 3)->nullable();
                $table->float('pump_casing_temp_cop3', 10, 3)->nullable();
                $table->float('pump_de_bearing_temp_cop3', 10, 3)->nullable();
                $table->float('trans_bearing_temp_cop3', 10, 3)->nullable();
                $table->float('trans_sealing_temp_cop3', 10, 3)->nullable();
                $table->float('pump_nde_bearing_temp_sp1', 10, 3)->nullable();
                $table->float('pump_casing_temp_sp1', 10, 3)->nullable();
                $table->float('pump_de_bearing_temp_sp1', 10, 3)->nullable();
                $table->float('trans_bearing_sp1', 10, 3)->nullable();
                $table->float('trans_sealing_sp1', 10, 3)->nullable();
                $table->float('pump_nde_bearing_temp_sp2', 10, 3)->nullable();
                $table->float('pump_casing_temp_sp2', 10, 3)->nullable();
                $table->float('pump_de_bearing_temp_sp2', 10, 3)->nullable();
                $table->float('trans_bearing_sp2', 10, 3)->nullable();
                $table->float('trans_sealing_sp2', 10, 3)->nullable();
                $table->float('pump_casing_bp1', 10, 3)->nullable();
                $table->float('pump_de_bearing_bp1', 10, 3)->nullable();
                $table->float('trans_bearing_bp1', 10, 3)->nullable();
                $table->float('trans_sealing_bp1', 10, 3)->nullable();
                $table->float('pump_casing_bp2', 10, 3)->nullable();
                $table->float('pump_de_bearing_bp2', 10, 3)->nullable();
                $table->float('trans_bearing_bp2', 10, 3)->nullable();
                $table->float('trans_sealing_bp2', 10, 3)->nullable();
                $table->float('pump_nde_bearing_tcp', 10, 3)->nullable();
                $table->float('pump_casing_tcp', 10, 3)->nullable();
                $table->float('pump_de_bearing_tcp', 10, 3)->nullable();
                $table->float('trans_bearing_tcp', 10, 3)->nullable();
                $table->float('trans_sealing_tcp', 10, 3)->nullable();
                $table->float('bearing_temp_vp1', 10, 3)->nullable();
                $table->float('bearing_temp_vp2', 10, 3)->nullable();
                $table->float('throttle_valve_cop1', 10, 3)->nullable();
                $table->float('throttle_valve_cop2', 10, 3)->nullable();
                $table->float('throttle_valve_cop3', 10, 3)->nullable();
                $table->float('discharge_pressure_cop1', 10, 3)->nullable();
                $table->float('discharge_pressure_cop2', 10, 3)->nullable();
                $table->float('discharge_pressure_cop3', 10, 3)->nullable();
                $table->float('vibration_cop1', 10, 3)->nullable();
                $table->float('vibration_cop2', 10, 3)->nullable();
                $table->float('vibration_cop3', 10, 3)->nullable();

                // hanla
                $table->float('level_cot_1p', 10, 3)->nullable();
                $table->float('temp_cot_1p', 10, 3)->nullable();
                $table->float('level_cot_1s', 10, 3)->nullable();
                $table->float('temp_cot_1s', 10, 3)->nullable();
                $table->float('level_cot_2p', 10, 3)->nullable();
                $table->float('temp_cot_2p', 10, 3)->nullable();
                $table->float('level_cot_2s', 10, 3)->nullable();
                $table->float('temp_cot_2s', 10, 3)->nullable();
                $table->float('level_cot_3p', 10, 3)->nullable();
                $table->float('temp_cot_3p', 10, 3)->nullable();
                $table->float('level_cot_3s', 10, 3)->nullable();
                $table->float('temp_cot_3s', 10, 3)->nullable();
                $table->float('level_cot_4p', 10, 3)->nullable();
                $table->float('temp_cot_4p', 10, 3)->nullable();
                $table->float('level_cot_4s', 10, 3)->nullable();
                $table->float('temp_cot_4s', 10, 3)->nullable();
                $table->float('level_cot_5p', 10, 3)->nullable();
                $table->float('temp_cot_5p', 10, 3)->nullable();
                $table->float('level_cot_5s', 10, 3)->nullable();
                $table->float('temp_cot_5s', 10, 3)->nullable();
                $table->float('level_slop_p', 10, 3)->nullable();
                $table->float('temp_slop_p', 10, 3)->nullable();
                $table->float('level_slop_s', 10, 3)->nullable();
                $table->float('temp_slop_s', 10, 3)->nullable();
                $table->float('fore_peak_tank', 10, 3)->nullable();
                $table->float('level_wbt_1p', 10, 3)->nullable();
                $table->float('level_wbt_1s', 10, 3)->nullable();
                $table->float('level_wbt_2p', 10, 3)->nullable();
                $table->float('level_wbt_2s', 10, 3)->nullable();
                $table->float('level_wbt_3p', 10, 3)->nullable();
                $table->float('level_wbt_3s', 10, 3)->nullable();
                $table->float('level_wbt_4p', 10, 3)->nullable();
                $table->float('level_wbt_4s', 10, 3)->nullable();
                $table->float('level_wbt_5p', 10, 3)->nullable();
                $table->float('level_wbt_5s', 10, 3)->nullable();
                $table->float('level_draft_fore', 10, 3)->nullable();
                $table->float('level_draft_after', 10, 3)->nullable();
                $table->float('after_peak_tank', 10, 3)->nullable();
                $table->float('mdo_mgo_tank_p', 10, 3)->nullable();
                $table->float('mdo_tank_s', 10, 3)->nullable();
                $table->float('fore_fw_tank_p', 10, 3)->nullable();
                $table->float('fore_fw_tank_s', 10, 3)->nullable();
                $table->float('fw_tank_p', 10, 3)->nullable();
                $table->float('fw_tank_s', 10, 3)->nullable();
                $table->float('fo_overflow_tank', 10, 3)->nullable();

                $table->timestamps();
            });
        }

        $tablePayload = $model->tablePayloadBuilder($model);
        $model->addColumn($tableName, $tablePayload);
        $logModel = new YudhistiraLog();
        $logModel->table($fleetId, null, $tablePayload);


        // $model->addColumn($tableName, [
        //     [
        //         'type' => 'float',
        //         'name' => 'after_peak_tank_m3',
        //         'after' => 'after_peak_tank',
        //     ],
        //     [
        //         'type' => 'float',
        //         'name' => 'mdo_mgo_tank_p_m3',
        //         'after' => 'mdo_mgo_tank_p',
        //     ],
        //     [
        //         'type' => 'float',
        //         'name' => 'mdo_tank_s_m3',
        //         'after' => 'mdo_tank_s',
        //     ],
        //     [
        //         'type' => 'float',
        //         'name' => 'fore_fw_tank_p_m3',
        //         'after' => 'fore_fw_tank_p',
        //     ],
        //     [
        //         'type' => 'float',
        //         'name' => 'fore_fw_tank_s_m3',
        //         'after' => 'fore_fw_tank_s',
        //     ],
        //     [
        //         'type' => 'float',
        //         'name' => 'fw_tank_p_m3',
        //         'after' => 'fw_tank_p',
        //     ],
        //     [
        //         'type' => 'float',
        //         'name' => 'fw_tank_s_m3',
        //         'after' => 'fw_tank_s',
        //     ],
        //     [
        //         'type' => 'float',
        //         'name' => 'fo_overflow_tank_m3',
        //         'after' => 'fo_overflow_tank',
        //     ],


        //     [
        //         'type' => 'float',
        //         'name' => 'level_cot_1p_mt',
        //         'after' => 'level_cot_1p',
        //     ],
        //     [
        //         'type' => 'float',
        //         'name' => 'level_cot_1s_mt',
        //         'after' => 'level_cot_1s',
        //     ],
        //     [
        //         'type' => 'float',
        //         'name' => 'level_cot_2p_mt',
        //         'after' => 'level_cot_2p',
        //     ],
        //     [
        //         'type' => 'float',
        //         'name' => 'level_cot_2s_mt',
        //         'after' => 'level_cot_2s',
        //     ],
        //     [
        //         'type' => 'float',
        //         'name' => 'level_cot_3p_mt',
        //         'after' => 'level_cot_3p',
        //     ],
        //     [
        //         'type' => 'float',
        //         'name' => 'level_cot_3s_mt',
        //         'after' => 'level_cot_3s',
        //     ],
        //     [
        //         'type' => 'float',
        //         'name' => 'level_cot_4p_mt',
        //         'after' => 'level_cot_4p',
        //     ],
        //     [
        //         'type' => 'float',
        //         'name' => 'level_cot_4s_mt',
        //         'after' => 'level_cot_4s',
        //     ],
        //     [
        //         'type' => 'float',
        //         'name' => 'level_cot_5p_mt',
        //         'after' => 'level_cot_5p',
        //     ],
        //     [
        //         'type' => 'float',
        //         'name' => 'level_cot_5s_mt',
        //         'after' => 'level_cot_5s',
        //     ],
        // ]);
        return $model->setTable($tableName);
    }

    // updating
    public function updating(Updating $event)
    {
        $model = $event->getModel();
        // calculate cargo
        $cargoData = $this->calculate($model);
        $updates = array_merge($cargoData, $this->bunkerCalculate($model));
        // proses simpan data
        foreach ($updates as $k => $v) {
            $this->{$k} = $v;
        }
    }

    // update & insert
    public function updated(Updated $event)
    {
        $model = $event->getModel();

        $date = $model->terminal_time;
        $last = YudhistiraLog::table($model->fleet_id, $date)->orderBy('terminal_time', 'desc')->first();

        $now = Carbon::parse($date);

        // save interval 60 detik
        if ($last && $now->diffInSeconds($last->terminal_time) < config('mqtt.interval_save', 60)) {
            return;
        }

        return YudhistiraLog::table($model->fleet_id, $date)->updateOrCreate([
            'fleet_id' => $model->fleet_id,
            'terminal_time' => $date,
        ], (array) $model->makeHidden(['id', 'bunkers', 'cargos', 'fleet_id', 'created_at', 'updated_at'])->toArray());
    }
}
