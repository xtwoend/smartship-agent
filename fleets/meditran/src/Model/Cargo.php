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

namespace Smartship\Meditran\Model;

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
        'no_1_cargo_tank_p' => ['port', ['no_1_cargo_tank_p_mt', 'no_1_cargo_tank_p_ltr'], ['mes_type' => 'level', 'content' => '', 'compare' => ['temp_1ctp']]],
        'no_1_cargo_tank_s' => ['stb', ['no_1_cargo_tank_s_mt', 'no_1_cargo_tank_s_ltr'], ['mes_type' => 'level', 'content' => '', 'compare' => ['temp_1cts']]],
        'no_2_cargo_tank_p' => ['port', ['no_2_cargo_tank_p_mt', 'no_2_cargo_tank_p_ltr'], ['mes_type' => 'level', 'content' => '', 'compare' => ['temp_2ctp']]],
        'no_2_cargo_tank_s' => ['stb', ['no_2_cargo_tank_s_mt', 'no_2_cargo_tank_s_ltr'], ['mes_type' => 'level', 'content' => '', 'compare' => ['temp_2cts']]],
        'no_3_cargo_tank_p' => ['port', ['no_3_cargo_tank_p_mt', 'no_3_cargo_tank_p_ltr'], ['mes_type' => 'level', 'content' => '', 'compare' => ['temp_3ctp']]],
        'no_3_cargo_tank_s' => ['stb', ['no_3_cargo_tank_s_mt', 'no_3_cargo_tank_s_ltr'], ['mes_type' => 'level', 'content' => '', 'compare' => ['temp_3ctm']]],
        'no_4_cargo_tank_p' => ['port', ['no_4_cargo_tank_p_mt', 'no_4_cargo_tank_p_ltr'], ['mes_type' => 'level', 'content' => '', 'compare' => ['temp_4ctp']]],
        'no_4_cargo_tank_s' => ['stb', ['no_4_cargo_tank_s_mt', 'no_4_cargo_tank_s_ltr'], ['mes_type' => 'level', 'content' => '', 'compare' => ['temp_4cts']]],
        'no_5_cargo_tank_p' => ['port', ['no_5_cargo_tank_p_mt', 'no_5_cargo_tank_p_ltr'], ['mes_type' => 'level', 'content' => '', 'compare' => ['temp_5ctp']]],
        'no_5_cargo_tank_s' => ['stb', ['no_5_cargo_tank_s_mt', 'no_5_cargo_tank_s_ltr'], ['mes_type' => 'level', 'content' => '', 'compare' => ['temp_5cts']]],
        'slop_tank_p' => ['port', ['slop_tank_p_mt', 'slop_tank_p_ltr'], ['mes_type' => 'level', 'content' => '', 'compare' => ['temp_stp']]],
        'slop_tank_s' => ['stb', ['slop_tank_s_mt', 'slop_tank_s_ltr'], ['mes_type' => 'level', 'content' => '', 'compare' => ['temp_sts']]],
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
                $table->float('no_1_cargo_tank_p')->default(0);
                $table->float('temp_1ctp')->default(0);
                $table->float('no_1_cargo_tank_s')->default(0);
                $table->float('temp_1cts')->default(0);
                $table->float('no_2_cargo_tank_p')->default(0);
                $table->float('temp_2ctp')->default(0);
                $table->float('no_2_cargo_tank_s')->default(0);
                $table->float('temp_2cts')->default(0);
                $table->float('no_3_cargo_tank_p')->default(0);
                $table->float('temp_3ctp')->default(0);
                $table->float('no_3_cargo_tank_s')->default(0);
                $table->float('temp_3ctm')->default(0);
                $table->float('no_4_cargo_tank_p')->default(0);
                $table->float('temp_4ctp')->default(0);
                $table->float('no_4_cargo_tank_s')->default(0);
                $table->float('temp_4cts')->default(0);
                $table->float('no_5_cargo_tank_p')->default(0);
                $table->float('temp_5ctp')->default(0);
                $table->float('no_5_cargo_tank_s')->default(0);
                $table->float('temp_5cts')->default(0);
                $table->float('slop_tank_p')->default(0);
                $table->float('temp_stp')->default(0);
                $table->float('slop_tank_s')->default(0);
                $table->float('temp_sts')->default(0);

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
