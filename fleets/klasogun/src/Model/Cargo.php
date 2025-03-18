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

namespace Smartship\Klasogun\Model;

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

    public ?array $cargoTanks = [];
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
        // 'level_cot_1p_mt' => ['level_cot_1p', 'temp_cot_1p'],
        // 'level_cot_1s_mt' => ['level_cot_1s', 'temp_cot_1s'],
        // 'level_cot_2p_mt' => ['level_cot_2p', 'temp_cot_2p'],
        // 'level_cot_2s_mt' => ['level_cot_2s', 'temp_cot_2s'],
        // 'level_cot_3p_mt' => ['level_cot_3p', 'temp_cot_3p'],
        // 'level_cot_3s_mt' => ['level_cot_3s', 'temp_cot_3s'],
        // 'level_cot_4p_mt' => ['level_cot_4p', 'temp_cot_4p'],
        // 'level_cot_4s_mt' => ['level_cot_4s', 'temp_cot_1s'],
        // 'level_cot_5p_mt' => ['level_cot_5p', 'temp_cot_5p'],
        // 'level_cot_5s_mt' => ['level_cot_5s', 'temp_cot_5s'],
    ];
}
