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
use Hyperf\Database\Model\Events\Updated;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Schema\Schema;
use Hyperf\DbConnection\Model\Model;

class Mahakam extends Model
{
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

        return $model->setTable($tableName);
    }

    // update & insert
    public function updated(Updated $event)
    {
        $model = $event->getModel();

        $date = $model->terminal_time;
        $last = KakapLog::table($model->fleet_id, $date)->orderBy('terminal_time', 'desc')->first();

        $now = Carbon::parse($date);

        // save interval 60 detik
        if ($last && $now->diffInSeconds($last->terminal_time) < config('mqtt.interval_save', 60)) {
            return;
        }

        return KakapLog::table($model->fleet_id, $date)->updateOrCreate([
            'fleet_id' => $model->fleet_id,
            'terminal_time' => $date,
        ], (array) $model->makeHidden(['id', 'fleet_id', 'created_at', 'updated_at'])->toArray());
    }
}
