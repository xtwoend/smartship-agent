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

class Pangalengan extends Model
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
        'no_1_cargo_tank_p_mt' => ['no_1_cargo_tank_p' => 'port'],
        'no_1_cargo_tank_s_mt' => ['no_1_cargo_tank_s' => 'stb'],
        'no_2_cargo_tank_p_mt' => ['no_2_cargo_tank_p' => 'port'],
        'no_2_cargo_tank_s_mt' => ['no_2_cargo_tank_s' => 'stb'],
        'no_3_cargo_tank_p_mt' => ['no_3_cargo_tank_p' => 'port'],
        'no_3_cargo_tank_s_mt' => ['no_3_cargo_tank_s' => 'stb'],
        'no_4_cargo_tank_p_mt' => ['no_4_cargo_tank_p' => 'port'],
        'no_4_cargo_tank_s_mt' => ['no_4_cargo_tank_s' => 'stb'],
        'no_5_cargo_tank_p_mt' => ['no_5_cargo_tank_p' => 'port'],
        'no_5_cargo_tank_s_mt' => ['no_5_cargo_tank_s' => 'stb'],
        'slop_cargo_tank_p_mt' => ['slop_cargo_tank_p' => 'port'],
        'slop_cargo_tank_s_mt' => ['slop_cargo_tank_s' => 'stb'],
    ];

    // bunkers
    public ?array $bunkerTanks = [
        'no_1_hfo_p_m3' => ['no_1_hfo_p', 'port'],
        'no_2_hfo_s_m3' => ['no_2_hfo_s', 'stb'],
        'no_1_hfoday_p_m3' => ['no_1_hfoday_p', 'port'],
        'no_2_hfoday_s_m3' => ['no_2_hfoday_s', 'stb'],
        'hfo_sett_p_m3' => ['hfo_sett_p', 'port'],
        'mdo_sett_s_m3' => ['mdo_sett_s', 'stb'],
        'no_1_mdo_p_m3' => ['no_1_mdo_p', 'port'],
        'no_2_mdo_s_m3' => ['no_2_mdo_s', 'stb'],
        'no_1_mdoday_p_m3' => ['no_1_mdoday_p', 'port'],
        'no_s_mdoday_s_m3' => ['no_s_mdoday_s', 'stb'],
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
                $table->float('no_1_cargo_tank_p', 10, 3)->default(0);
                $table->float('temp_1ctp', 10, 3)->default(0);
                $table->float('no_1_cargo_tank_s', 10, 3)->default(0);
                $table->float('temp_1cts', 10, 3)->default(0);
                $table->float('no_2_cargo_tank_p', 10, 3)->default(0);
                $table->float('temp_2ctp', 10, 3)->default(0);
                $table->float('no_2_cargo_tank_s', 10, 3)->default(0);
                $table->float('temp_2cts', 10, 3)->default(0);
                $table->float('no_3_cargo_tank_p', 10, 3)->default(0);
                $table->float('temp_3ctp', 10, 3)->default(0);
                $table->float('no_3_cargo_tank_s', 10, 3)->default(0);
                $table->float('temp_3cts', 10, 3)->default(0);
                $table->float('no_4_cargo_tank_p', 10, 3)->default(0);
                $table->float('temp_4ctp', 10, 3)->default(0);
                $table->float('no_4_cargo_tank_s', 10, 3)->default(0);
                $table->float('temp_4cts', 10, 3)->default(0);
                $table->float('no_5_cargo_tank_p', 10, 3)->default(0);
                $table->float('temp_5ctp', 10, 3)->default(0);
                $table->float('no_5_cargo_tank_s', 10, 3)->default(0);
                $table->float('temp_5cts', 10, 3)->default(0);
                $table->float('slop_cargo_tank_p', 10, 3)->default(0);
                $table->float('temp_sctp', 10, 3)->default(0);
                $table->float('slop_cargo_tank_s', 10, 3)->default(0);
                $table->float('temp_scts', 10, 3)->default(0);
                $table->float('f_p_t_c', 10, 3)->default(0);
                $table->float('no_1_wbt_p', 10, 3)->default(0);
                $table->float('no_1_wbt_s', 10, 3)->default(0);
                $table->float('no_2_wbt_p', 10, 3)->default(0);
                $table->float('no_2_wbt_s', 10, 3)->default(0);
                $table->float('no_3_wbt_p', 10, 3)->default(0);
                $table->float('no_3_wbt_s', 10, 3)->default(0);
                $table->float('no_4_wbt_p', 10, 3)->default(0);
                $table->float('no_4_wbt_s', 10, 3)->default(0);
                $table->float('no_5_wbt_p', 10, 3)->default(0);
                $table->float('no_5_wbt_s', 10, 3)->default(0);
                $table->float('no_6_wbt_p', 10, 3)->default(0);
                $table->float('no_6_wbt_s', 10, 3)->default(0);
                $table->float('no_7_wbt_p', 10, 3)->default(0);
                $table->float('no_7_wbt_s', 10, 3)->default(0);
                $table->float('aftk_p', 10, 3)->default(0);
                $table->float('aftk_s', 10, 3)->default(0);
                $table->float('no_1_hfo_p', 10, 3)->default(0);
                $table->float('no_2_hfo_s', 10, 3)->default(0);
                $table->float('no_1_hfoday_p', 10, 3)->default(0);
                $table->float('no_2_hfoday_s', 10, 3)->default(0);
                $table->float('hfo_sett_p', 10, 3)->default(0);
                $table->float('mdo_sett_s', 10, 3)->default(0);
                $table->float('no_1_mdo_p', 10, 3)->default(0);
                $table->float('no_2_mdo_s', 10, 3)->default(0);
                $table->float('no_1_mdoday_p', 10, 3)->default(0);
                $table->float('no_s_mdoday_s', 10, 3)->default(0);
                $table->float('volume_cot_1p', 10, 3)->default(0);
                $table->float('volume_cot_1s', 10, 3)->default(0);
                $table->float('volume_cot_2p', 10, 3)->default(0);
                $table->float('volume_cot_2s', 10, 3)->default(0);
                $table->float('volume_cot_3p', 10, 3)->default(0);
                $table->float('volume_cot_3s', 10, 3)->default(0);
                $table->float('volume_cot_4p', 10, 3)->default(0);
                $table->float('volume_cot_4s', 10, 3)->default(0);
                $table->float('volume_cot_5p', 10, 3)->default(0);
                $table->float('volume_cot_5s', 10, 3)->default(0);
                $table->float('volume_fpt', 10, 3)->default(0);
                $table->float('volume_wbt_1p', 10, 3)->default(0);
                $table->float('volume_wbt_1s', 10, 3)->default(0);
                $table->float('volume_wbt_2p', 10, 3)->default(0);
                $table->float('volume_wbt_2s', 10, 3)->default(0);
                $table->float('volume_wbt_3p', 10, 3)->default(0);
                $table->float('volume_wbt_3s', 10, 3)->default(0);
                $table->float('volume_wbt_4p', 10, 3)->default(0);
                $table->float('volume_wbt_4s', 10, 3)->default(0);
                $table->float('volume_wbt_5p', 10, 3)->default(0);
                $table->float('volume_wbt_5s', 10, 3)->default(0);
                $table->float('volume_wbt_6p', 10, 3)->default(0);
                $table->float('volume_wbt_6s', 10, 3)->default(0);
                $table->float('volume_wbt_7p', 10, 3)->default(0);
                $table->float('volume_wbt_7s', 10, 3)->default(0);
                $table->float('volume_aft_1p', 10, 3)->default(0);
                $table->float('volume_aft_1s', 10, 3)->default(0);
                $table->float('volume_mdo_1p', 10, 3)->default(0);
                $table->float('volume_mdo_2s', 10, 3)->default(0);
                $table->float('volume_hfo_1p', 10, 3)->default(0);
                $table->float('volume_hfo_2s', 10, 3)->default(0);
                $table->float('volume_mdo_sett_s', 10, 3)->default(0);
                $table->float('volume_mdoday_1p', 10, 3)->default(0);
                $table->float('volume_mdoday_2s', 10, 3)->default(0);
                $table->float('volume_hfo_sett_p', 10, 3)->default(0);
                $table->float('cargo_pump1_run', 10, 3)->default(0);
                $table->float('cargo_pump2_run', 10, 3)->default(0);
                $table->float('cargo_pump3_run', 10, 3)->default(0);
                $table->float('wballast_pump1_run', 10, 3)->default(0);
                $table->float('wballast_pump2_run', 10, 3)->default(0);
                $table->float('tank_cleaning_pump_run', 10, 3)->default(0);
                $table->float('stripping_pump_run', 10, 3)->default(0);

                // Cargo Sensor
                $table->datetime('cargo_timestamp')->nullable();
                $table->float('temp_casing_wbp1', 10, 3)->default(0);
                $table->float('temp_bearing_wbp1', 10, 3)->default(0);
                $table->float('temp_stuffingbox_wbp1', 10, 3)->default(0);
                $table->float('temp_casing_wbp2', 10, 3)->default(0);
                $table->float('temp_bearing_wbp2', 10, 3)->default(0);
                $table->float('temp_stuffingbox_wbp2', 10, 3)->default(0);
                $table->float('temp_casing_sp', 10, 3)->default(0);
                $table->float('temp_bearing_sp', 10, 3)->default(0);
                $table->float('temp_stuffingbox_sp', 10, 3)->default(0);
                $table->float('temp_casing_tcp', 10, 3)->default(0);
                $table->float('temp_bearing_tcp', 10, 3)->default(0);
                $table->float('temp_stuffingbox_tcp', 10, 3)->default(0);
                $table->float('temp_casing_cp1', 10, 3)->default(0);
                $table->float('temp_bearing_cp1', 10, 3)->default(0);
                $table->float('temp_stuffingbox_cp1', 10, 3)->default(0);
                $table->float('temp_casing_cp2', 10, 3)->default(0);
                $table->float('temp_bearing_cp2', 10, 3)->default(0);
                $table->float('temp_stuffingbox_cp2', 10, 3)->default(0);
                $table->float('temp_casing_cp3', 10, 3)->default(0);
                $table->float('temp_bearing_cp3', 10, 3)->default(0);
                $table->float('temp_stuffingbox_cp3', 10, 3)->default(0);
                $table->float('press_discharge_wbp1', 10, 3)->default(0);
                $table->float('press_suction_wbp1', 10, 3)->default(0);
                $table->float('press_discharge_wbp2', 10, 3)->default(0);
                $table->float('press_suction_wbp2', 10, 3)->default(0);
                $table->float('press_discharge_tcp', 10, 3)->default(0);
                $table->float('press_suction_tcp', 10, 3)->default(0);
                $table->float('press_discharge_sp', 10, 3)->default(0);
                $table->float('press_suction_sp', 10, 3)->default(0);
                $table->float('press_discharge_cp1', 10, 3)->default(0);
                $table->float('press_suction_cp1', 10, 3)->default(0);
                $table->float('press_discharge_cp2', 10, 3)->default(0);
                $table->float('press_suction_cp2', 10, 3)->default(0);
                $table->float('press_discharge_cp3', 10, 3)->default(0);
                $table->float('press_suction_cp3', 10, 3)->default(0);
                $table->timestamps();
            });
        }

        $model->addColumn($tableName, [
            [
                'type' => 'float',
                'name' => 'no_1_hfo_p_m3',
                'after' => 'no_1_hfo_p',
            ],
            [
                'type' => 'float',
                'name' => 'no_2_hfo_s_m3',
                'after' => 'no_2_hfo_s',
            ],
            [
                'type' => 'float',
                'name' => 'no_1_hfoday_p_m3',
                'after' => 'no_1_hfoday_p',
            ],
            [
                'type' => 'float',
                'name' => 'no_2_hfoday_s_m3',
                'after' => 'no_2_hfoday_s',
            ],
            [
                'type' => 'float',
                'name' => 'hfo_sett_p_m3',
                'after' => 'hfo_sett_p',
            ],
            [
                'type' => 'float',
                'name' => 'mdo_sett_s_m3',
                'after' => 'mdo_sett_s',
            ],
            [
                'type' => 'float',
                'name' => 'no_1_mdo_p_m3',
                'after' => 'no_1_mdo_p',
            ],
            [
                'type' => 'float',
                'name' => 'no_2_mdo_s_m3',
                'after' => 'no_2_mdo_s',
            ],
            [
                'type' => 'float',
                'name' => 'no_1_mdoday_p_m3',
                'after' => 'no_1_mdoday_p',
            ],
            [
                'type' => 'float',
                'name' => 'no_s_mdoday_s_m3',
                'after' => 'no_s_mdoday_s',
            ],

            [
                'type' => 'float',
                'name' => 'no_1_cargo_tank_p_mt',
                'after' => 'no_1_cargo_tank_p',
            ],
            [
                'type' => 'float',
                'name' => 'no_1_cargo_tank_s_mt',
                'after' => 'no_1_cargo_tank_s',
            ],
            [
                'type' => 'float',
                'name' => 'no_2_cargo_tank_p_mt',
                'after' => 'no_2_cargo_tank_p',
            ],
            [
                'type' => 'float',
                'name' => 'no_2_cargo_tank_s_mt',
                'after' => 'no_2_cargo_tank_s',
            ],
            [
                'type' => 'float',
                'name' => 'no_3_cargo_tank_p_mt',
                'after' => 'no_3_cargo_tank_p',
            ],
            [
                'type' => 'float',
                'name' => 'no_3_cargo_tank_s_mt',
                'after' => 'no_3_cargo_tank_s',
            ],
            [
                'type' => 'float',
                'name' => 'no_4_cargo_tank_p_mt',
                'after' => 'no_4_cargo_tank_p',
            ],
            [
                'type' => 'float',
                'name' => 'no_4_cargo_tank_s_mt',
                'after' => 'no_4_cargo_tank_s',
            ],
            [
                'type' => 'float',
                'name' => 'no_5_cargo_tank_p_mt',
                'after' => 'no_5_cargo_tank_p',
            ],
            [
                'type' => 'float',
                'name' => 'no_5_cargo_tank_s_mt',
                'after' => 'no_5_cargo_tank_s',
            ],
            [
                'type' => 'float',
                'name' => 'slop_cargo_tank_p_mt',
                'after' => 'slop_cargo_tank_p',
            ],
            [
                'type' => 'float',
                'name' => 'slop_cargo_tank_s_mt',
                'after' => 'slop_cargo_tank_s',
            ],
        ]);

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
        $last = PangalenganLog::table($model->fleet_id, $date)->orderBy('terminal_time', 'desc')->first();

        $now = Carbon::parse($date);

        // save interval 60 detik
        if ($last && $now->diffInSeconds($last->terminal_time) < config('mqtt.interval_save', 60)) {
            return;
        }

        return PangalenganLog::table($model->fleet_id, $date)->updateOrCreate([
            'fleet_id' => $model->fleet_id,
            'terminal_time' => $date,
        ], (array) $model->makeHidden(['id', 'bunkers', 'cargos', 'fleet_id', 'created_at', 'updated_at'])->toArray());
    }
}
