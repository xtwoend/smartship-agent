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

class Mahakam extends Model
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
        'level_cot_1p' => ['port',  ['level_cot_1p_mt', 'level_cot_1p_ltr'], ['mes_type' => 'level', 'height' => 0, 'content' => '']],
        'level_cot_1s' => ['stb',   ['level_cot_1s_mt', 'level_cot_1s_ltr'], ['mes_type' => 'level', 'height' => 0, 'content' => '']],
        'level_cot_2p' => ['port',  ['level_cot_2p_mt', 'level_cot_2p_ltr'], ['mes_type' => 'level', 'height' => 0, 'content' => '']],
        'level_cot_2s' => ['stb',   ['level_cot_2s_mt', 'level_cot_2s_ltr'], ['mes_type' => 'level', 'height' => 0, 'content' => '']],
        'level_cot_3p' => ['port',  ['level_cot_3p_mt', 'level_cot_3p_ltr'], ['mes_type' => 'level', 'height' => 0, 'content' => '']],
        'level_cot_3s' => ['stb',   ['level_cot_3s_mt', 'level_cot_3s_ltr'], ['mes_type' => 'level', 'height' => 0, 'content' => '']],
        'level_cot_4p' => ['port',  ['level_cot_4p_mt', 'level_cot_4p_ltr'], ['mes_type' => 'level', 'height' => 0, 'content' => '']],
        'level_cot_4s' => ['stb',   ['level_cot_4s_mt', 'level_cot_4s_ltr'], ['mes_type' => 'level', 'height' => 0, 'content' => '']],
        'level_cot_5p' => ['port',  ['level_cot_5p_mt', 'level_cot_5p_ltr'], ['mes_type' => 'level', 'height' => 0, 'content' => '']],
        'level_cot_5s' => ['stb',   ['level_cot_5s_mt', 'level_cot_5s_ltr'], ['mes_type' => 'level', 'height' => 0, 'content' => '']],
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

                $table->float('level_cot_1p', 16, 2)->default(0);
                $table->float('temp_cot_1p', 16, 2)->default(0);
                $table->float('level_cot_1s', 16, 2)->default(0);
                $table->float('temp_cot_1s', 16, 2)->default(0);
                $table->float('level_cot_2p', 16, 2)->default(0);
                $table->float('temp_cot_2p', 16, 2)->default(0);
                $table->float('level_cot_2s', 16, 2)->default(0);
                $table->float('temp_cot_2s', 16, 2)->default(0);
                $table->float('level_cot_3p', 16, 2)->default(0);
                $table->float('temp_cot_3p', 16, 2)->default(0);
                $table->float('level_cot_3s', 16, 2)->default(0);
                $table->float('temp_cot_3s', 16, 2)->default(0);
                $table->float('level_cot_4p', 16, 2)->default(0);
                $table->float('temp_cot_4p', 16, 2)->default(0);
                $table->float('level_cot_4s', 16, 2)->default(0);
                $table->float('temp_cot_4s', 16, 2)->default(0);
                $table->float('level_cot_5p', 16, 2)->default(0);
                $table->float('temp_cot_5p', 16, 2)->default(0);
                $table->float('level_cot_5s', 16, 2)->default(0);
                $table->float('temp_cot_5s', 16, 2)->default(0);
                $table->float('level_slop_p', 16, 2)->default(0);
                $table->float('temp_slop_p', 16, 2)->default(0);
                $table->float('level_slop_s', 16, 2)->default(0);
                $table->float('temp_slop_s', 16, 2)->default(0);
                $table->float('fore_peak_tank', 16, 2)->default(0);
                $table->float('level_wbt_1p', 16, 2)->default(0);
                $table->float('level_wbt_1s', 16, 2)->default(0);
                $table->float('level_wbt_2p', 16, 2)->default(0);
                $table->float('level_wbt_2s', 16, 2)->default(0);
                $table->float('level_wbt_3p', 16, 2)->default(0);
                $table->float('level_wbt_3s', 16, 2)->default(0);
                $table->float('level_wbt_4p', 16, 2)->default(0);
                $table->float('level_wbt_4s', 16, 2)->default(0);
                $table->float('level_wbt_5p', 16, 2)->default(0);
                $table->float('level_wbt_5s', 16, 2)->default(0);
                $table->float('level_draft_fore', 16, 2)->default(0);
                $table->float('level_draft_mid_p', 16, 2)->default(0);
                $table->float('level_draft_mid_s', 16, 2)->default(0);
                $table->float('level_draft_after', 16, 2)->default(0);

                $table->timestamps();
            });
        }

        $tablePayload = $model->tablePayloadBuilder($model);
        $model->addColumn($tableName, $tablePayload);
        $logModel = new MahakamLog();
        $logModel->table($fleetId, null, $tablePayload);

        // $model->addColumn($tableName, [
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
        $last = MahakamLog::table($model->fleet_id, $date)->orderBy('terminal_time', 'desc')->first();

        $now = Carbon::parse($date);

        // save interval 60 detik
        if ($last && $now->diffInSeconds($last->terminal_time) < config('mqtt.interval_save', 60)) {
            return;
        }

        return MahakamLog::table($model->fleet_id, $date)->updateOrCreate([
            'fleet_id' => $model->fleet_id,
            'terminal_time' => $date,
        ], (array) $model->makeHidden(['id', 'bunkers', 'cargos', 'fleet_id', 'created_at', 'updated_at'])->toArray());
    }
}
