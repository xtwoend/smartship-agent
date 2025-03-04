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

class Pangkalanbrandan extends Model
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
        'no1_cotp_ullage' => ['port',   ['no1_cotp_ullage_mt', 'no1_cotp_ullage_ltr'], ['mes_type' => 'ullage', 'height' => 0, 'content' => '']],
        'no1_cots_ullage' => ['stb',    ['no1_cots_ullage_mt', 'no1_cots_ullage_ltr'], ['mes_type' => 'ullage', 'height' => 0, 'content' => '']],
        'no2_cotp_ullage' => ['port',   ['no2_cotp_ullage_mt', 'no2_cotp_ullage_ltr'], ['mes_type' => 'ullage', 'height' => 0, 'content' => '']],
        'no2_cots_ullage' => ['stb',    ['no2_cots_ullage_mt', 'no2_cots_ullage_ltr'], ['mes_type' => 'ullage', 'height' => 0, 'content' => '']],
        'no3_cotp_ullage' => ['port',   ['no3_cotp_ullage_mt', 'no3_cotp_ullage_ltr'], ['mes_type' => 'ullage', 'height' => 0, 'content' => '']],
        'no3_cots_ullage' => ['stb',    ['no3_cots_ullage_mt', 'no3_cots_ullage_ltr'], ['mes_type' => 'ullage', 'height' => 0, 'content' => '']],
        'no4_cotp_ullage' => ['port',   ['no4_cotp_ullage_mt', 'no4_cotp_ullage_ltr'], ['mes_type' => 'ullage', 'height' => 0, 'content' => '']],
        'no4_cots_ullage' => ['stb',    ['no4_cots_ullage_mt', 'no4_cots_ullage_ltr'], ['mes_type' => 'ullage', 'height' => 0, 'content' => '']],
        'no5_cotp_ullage' => ['port',   ['no5_cotp_ullage_mt', 'no5_cotp_ullage_ltr'], ['mes_type' => 'ullage', 'height' => 0, 'content' => '']],
        'no5_cots_ullage' => ['stb',    ['no5_cots_ullage_mt', 'no5_cots_ullage_ltr'], ['mes_type' => 'ullage', 'height' => 0, 'content' => '']],
    ];

    public ?array $bunkerTanks = [
        'hfo_storage_tank_1p' =>  ['port'   , ['hfo_storage_tank_1p_m3', 'hfo_storage_tank_1p_ltr', 'hfo_storage_tank_1p_mt'],    ['mes_type' => 'level', 'content' => 'HFO']],
        'hfo_storage_tank_1s' =>  ['stb'    , ['hfo_storage_tank_1s_m3', 'hfo_storage_tank_1s_ltr', 'hfo_storage_tank_1s_mt'],    ['mes_type' => 'level', 'content' => 'HFO']],
        'hfo_storage_tank_2p' =>  ['port'   , ['hfo_storage_tank_2p_m3', 'hfo_storage_tank_2p_ltr', 'hfo_storage_tank_2p_mt'],    ['mes_type' => 'level', 'content' => 'HFO']],
        'hfo_storage_tank_2s' =>  ['stb'    , ['hfo_storage_tank_2s_m3', 'hfo_storage_tank_2s_ltr', 'hfo_storage_tank_2s_mt'],    ['mes_type' => 'level', 'content' => 'HFO']],
        'hfo_setting_tank' =>     ['port'   , ['hfo_setting_tank_m3', 'hfo_setting_tank_ltr', 'hfo_setting_tank_mt'],          ['mes_type' => 'level', 'content' => 'HFO']],
        'hfo_service_tank_1' =>   ['port'   , ['hfo_service_tank_1_m3', 'hfo_service_tank_1_ltr', 'hfo_service_tank_1_mt'],      ['mes_type' => 'level', 'content' => 'HFO']],
        'hfo_service_tank_2' =>   ['port'   , ['hfo_service_tank_2_m3', 'hfo_service_tank_2_ltr', 'hfo_service_tank_2_mt'],      ['mes_type' => 'level', 'content' => 'HFO']],
        'mdo_storage_tank_p' =>   ['port'   , ['mdo_storage_tank_p_m3', 'mdo_storage_tank_p_ltr', 'mdo_storage_tank_p_mt'],      ['mes_type' => 'level', 'content' => 'MDO']],
        'mdo_storage_tank_s' =>   ['stb'    , ['mdo_storage_tank_s_m3', 'mdo_storage_tank_s_ltr', 'mdo_storage_tank_s_mt'],      ['mes_type' => 'level', 'content' => 'MDO']],
        'mdo_setting_tank' =>     ['port'   , ['mdo_setting_tank_m3', 'mdo_setting_tank_ltr', 'mdo_setting_tank_mt'],          ['mes_type' => 'level', 'content' => 'MDO']],
        'mdo_service_tank_1' =>   ['port'   , ['mdo_service_tank_1_m3', 'mdo_service_tank_1_ltr', 'mdo_service_tank_1_mt'],      ['mes_type' => 'level', 'content' => 'MDO']],
        'mdo_service_tank_2' =>   ['port'   , ['mdo_service_tank_2_m3', 'mdo_service_tank_2_ltr', 'mdo_service_tank_2_mt'],      ['mes_type' => 'level', 'content' => 'MDO']],
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

                $table->float('pump_non_drvend_c1', 10, 3)->default(0);
                $table->float('pump_casing_c1', 10, 3)->default(0);
                $table->float('bulk_head_c1', 10, 3)->default(0);
                $table->float('transmission_sealing_c1', 10, 3)->default(0);
                $table->float('pump_non_drvend_c2', 10, 3)->default(0);
                $table->float('pump_casing_c2', 10, 3)->default(0);
                $table->float('bulk_head_c2', 10, 3)->default(0);
                $table->float('transmission_sealing_c2', 10, 3)->default(0);
                $table->float('pump_non_drvend_c3', 10, 3)->default(0);
                $table->float('pump_casing_c3', 10, 3)->default(0);
                $table->float('bulk_head_c3', 10, 3)->default(0);
                $table->float('transmission_sealing_c3', 10, 3)->default(0);
                $table->float('pump_non_drvend_bp1', 10, 3)->default(0);
                $table->float('pump_casing_bp1', 10, 3)->default(0);
                $table->float('bulk_head_bp1', 10, 3)->default(0);
                $table->float('tansmission_sealing_bp1', 10, 3)->default(0);
                $table->float('pump_non_drvend_bp2', 10, 3)->default(0);
                $table->float('pump_casing_bp2', 10, 3)->default(0);
                $table->float('bulk_head_bp2', 10, 3)->default(0);
                $table->float('transmission_sealing_bp2', 10, 3)->default(0);
                $table->float('pump_non_drvend_sp1', 10, 3)->default(0);
                $table->float('pump_casing_sp1', 10, 3)->default(0);
                $table->float('bulk_head_sp1', 10, 3)->default(0);
                $table->float('transmission_sealing_sp1', 10, 3)->default(0);
                $table->float('pump_non_drvend_tcp', 10, 3)->default(0);
                $table->float('pump_casing_tcp', 10, 3)->default(0);
                $table->float('bulk_head_tcp', 10, 3)->default(0);
                $table->float('transmission_sealing_tcp', 10, 3)->default(0);

                $table->datetime('bunker_timestamp')->nullable();
                $table->float('hfo_storage_tank_1p', 10, 3)->default(0);
                $table->float('hfo_storage_tank_1s', 10, 3)->default(0);
                $table->float('hfo_storage_tank_2p', 10, 3)->default(0);
                $table->float('hfo_storage_tank_2s', 10, 3)->default(0);
                $table->float('hfo_setting_tank', 10, 3)->default(0);
                $table->float('hfo_service_tank_1', 10, 3)->default(0);
                $table->float('hfo_service_tank_2', 10, 3)->default(0);
                $table->float('mdo_storage_tank_p', 10, 3)->default(0);
                $table->float('mdo_storage_tank_s', 10, 3)->default(0);
                $table->float('mdo_setting_tank', 10, 3)->default(0);
                $table->float('mdo_service_tank_1', 10, 3)->default(0);
                $table->float('mdo_service_tank_2', 10, 3)->default(0);

                $table->datetime('pump_latest_update_at')->nullable();
                $table->boolean('cargo_pump1_run', 10, 3)->nullable();
                $table->boolean('cargo_pump1_alarm', 10, 3)->nullable();
                $table->boolean('cargo_pump2_run', 10, 3)->nullable();
                $table->boolean('cargo_pump2_alarm', 10, 3)->nullable();
                $table->boolean('cargo_pump3_run', 10, 3)->nullable();
                $table->boolean('cargo_pump3_alarm', 10, 3)->nullable();
                $table->boolean('ballast_pump1_run', 10, 3)->nullable();
                $table->boolean('ballast_pump1_alarm', 10, 3)->nullable();
                $table->boolean('ballast_pump2_run', 10, 3)->nullable();
                $table->boolean('ballast_pump2_alarm', 10, 3)->nullable();
                $table->boolean('stripping_pump_run', 10, 3)->nullable();
                $table->boolean('stripping_pump_alarm', 10, 3)->nullable();
                $table->boolean('cleaningtank_pump_run', 10, 3)->nullable();
                $table->boolean('cleaningtank_pump_alarm', 10, 3)->nullable();

                // cargo pansia
                $table->float('no1_cotp_ullage', 10, 3)->default(0);
                $table->float('no1_cotp_temp', 10, 3)->default(0);
                $table->float('no1_cots_ullage', 10, 3)->default(0);
                $table->float('no1_cots_temp', 10, 3)->default(0);
                $table->float('no2_cotp_ullage', 10, 3)->default(0);
                $table->float('no2_cotp_temp', 10, 3)->default(0);
                $table->float('no2_cots_ullage', 10, 3)->default(0);
                $table->float('no2_cots_temp', 10, 3)->default(0);
                $table->float('no3_cotp_ullage', 10, 3)->default(0);
                $table->float('no3_cotp_temp', 10, 3)->default(0);
                $table->float('no3_cots_ullage', 10, 3)->default(0);
                $table->float('no3_cots_temp', 10, 3)->default(0);
                $table->float('no4_cotp_ullage', 10, 3)->default(0);
                $table->float('no4_cotp_temp', 10, 3)->default(0);
                $table->float('no4_cots_ullage', 10, 3)->default(0);
                $table->float('no4_cots_temp', 10, 3)->default(0);
                $table->float('no5_cotp_ullage', 10, 3)->default(0);
                $table->float('no5_cotp_temp', 10, 3)->default(0);
                $table->float('no5_cots_ullage', 10, 3)->default(0);
                $table->float('no5_cots_temp', 10, 3)->default(0);
                $table->float('slop_tank_p_ullage', 10, 3)->default(0);
                $table->float('slop_tank_p_temp', 10, 3)->default(0);
                $table->float('slop_tank_s_ullage', 10, 3)->default(0);
                $table->float('slop_tank_s_temp', 10, 3)->default(0);
                $table->float('no1_wbtp__level', 10, 3)->default(0);
                $table->float('no1_wbts_level', 10, 3)->default(0);
                $table->float('no2_wbtp_level', 10, 3)->default(0);
                $table->float('no2_wbts_level', 10, 3)->default(0);
                $table->float('no3_wbtp_level', 10, 3)->default(0);
                $table->float('no3_wbts_level', 10, 3)->default(0);
                $table->float('no4_wbtp_level', 10, 3)->default(0);
                $table->float('no4_wbts_level', 10, 3)->default(0);
                $table->float('no5_wbtp_level', 10, 3)->default(0);
                $table->float('no5_wbts_level', 10, 3)->default(0);
                $table->float('no6_wbtp_level', 10, 3)->default(0);
                $table->float('no6_wbts_level', 10, 3)->default(0);
                $table->float('fptk', 10, 3)->default(0);
                $table->float('aptk', 10, 3)->default(0);

                $table->timestamps();
            });
        }
        $tablePayload = $model->tablePayloadBuilder($model);
        $model->addColumn($tableName, $tablePayload);
        $logModel = new PangkalanbrandanLog();
        $logModel->table($fleetId, null, $tablePayload);


        // $model->addColumn($tableName, [
        //     [
        //         'type' => 'float',
        //         'name' => 'hfo_storage_tank_1p_m3',
        //         'after' => 'hfo_storage_tank_1p',
        //     ],
        //     [
        //         'type' => 'float',
        //         'name' => 'hfo_storage_tank_1s_m3',
        //         'after' => 'hfo_storage_tank_1s',
        //     ],
        //     [
        //         'type' => 'float',
        //         'name' => 'hfo_storage_tank_2p_m3',
        //         'after' => 'hfo_storage_tank_2p',
        //     ],
        //     [
        //         'type' => 'float',
        //         'name' => 'hfo_storage_tank_2s_m3',
        //         'after' => 'hfo_storage_tank_2s',
        //     ],
        //     [
        //         'type' => 'float',
        //         'name' => 'hfo_setting_tank_m3',
        //         'after' => 'hfo_setting_tank',
        //     ],
        //     [
        //         'type' => 'float',
        //         'name' => 'hfo_service_tank_1_m3',
        //         'after' => 'hfo_service_tank_1',
        //     ],
        //     [
        //         'type' => 'float',
        //         'name' => 'hfo_service_tank_2_m3',
        //         'after' => 'hfo_service_tank_2',
        //     ],
        //     [
        //         'type' => 'float',
        //         'name' => 'mdo_storage_tank_p_m3',
        //         'after' => 'mdo_storage_tank_p',
        //     ],
        //     [
        //         'type' => 'float',
        //         'name' => 'mdo_storage_tank_s_m3',
        //         'after' => 'mdo_storage_tank_s',
        //     ],
        //     [
        //         'type' => 'float',
        //         'name' => 'mdo_setting_tank_m3',
        //         'after' => 'mdo_setting_tank',
        //     ],
        //     [
        //         'type' => 'float',
        //         'name' => 'mdo_service_tank_1_m3',
        //         'after' => 'mdo_service_tank_1',
        //     ],
        //     [
        //         'type' => 'float',
        //         'name' => 'mdo_service_tank_2_m3',
        //         'after' => 'mdo_service_tank_2',
        //     ],


        //     [
        //         'type' => 'float',
        //         'name' => 'no1_cotp_ullage_mt',
        //         'after' => 'no1_cotp_ullage',
        //     ],
        //     [
        //         'type' => 'float',
        //         'name' => 'no1_cots_ullage_mt',
        //         'after' => 'no1_cots_ullage',
        //     ],
        //     [
        //         'type' => 'float',
        //         'name' => 'no2_cotp_ullage_mt',
        //         'after' => 'no2_cotp_ullage',
        //     ],
        //     [
        //         'type' => 'float',
        //         'name' => 'no2_cots_ullage_mt',
        //         'after' => 'no2_cots_ullage',
        //     ],
        //     [
        //         'type' => 'float',
        //         'name' => 'no3_cotp_ullage_mt',
        //         'after' => 'no3_cotp_ullage',
        //     ],
        //     [
        //         'type' => 'float',
        //         'name' => 'no3_cots_ullage_mt',
        //         'after' => 'no3_cots_ullage',
        //     ],
        //     [
        //         'type' => 'float',
        //         'name' => 'no4_cotp_ullage_mt',
        //         'after' => 'no4_cotp_ullage',
        //     ],
        //     [
        //         'type' => 'float',
        //         'name' => 'no4_cots_ullage_mt',
        //         'after' => 'no4_cots_ullage',
        //     ],
        //     [
        //         'type' => 'float',
        //         'name' => 'no5_cotp_ullage_mt',
        //         'after' => 'no5_cotp_ullage',
        //     ],
        //     [
        //         'type' => 'float',
        //         'name' => 'no5_cots_ullage_mt',
        //         'after' => 'no5_cots_ullage',
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
        $last = PangkalanbrandanLog::table($model->fleet_id, $date)->orderBy('terminal_time', 'desc')->first();

        $now = Carbon::parse($date);

        // save interval 60 detik
        if ($last && $now->diffInSeconds($last->terminal_time) < config('mqtt.interval_save', 60)) {
            return;
        }

        return PangkalanbrandanLog::table($model->fleet_id, $date)->updateOrCreate([
            'fleet_id' => $model->fleet_id,
            'terminal_time' => $date,
        ], (array) $model->makeHidden(['id', 'bunkers', 'cargos', 'fleet_id', 'created_at', 'updated_at'])->toArray());
    }
}
