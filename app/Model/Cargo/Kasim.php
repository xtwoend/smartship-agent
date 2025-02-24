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

class Kasim extends Model
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
                $table->float('temp_3ctm', 10, 3)->default(0);
                $table->float('no_4_cargo_tank_p', 10, 3)->default(0);
                $table->float('temp_4ctp', 10, 3)->default(0);
                $table->float('no_4_cargo_tank_s', 10, 3)->default(0);
                $table->float('temp_4cts', 10, 3)->default(0);
                $table->float('no_5_cargo_tank_p', 10, 3)->default(0);
                $table->float('temp_5ctp', 10, 3)->default(0);
                $table->float('no_5_cargo_tank_s', 10, 3)->default(0);
                $table->float('temp_5cts', 10, 3)->default(0);
                $table->float('slop_tank_p', 10, 3)->default(0);
                $table->float('temp_stp', 10, 3)->default(0);
                $table->float('slop_tank_s', 10, 3)->default(0);
                $table->float('temp_sts', 10, 3)->default(0);

                // pump status
                $table->datetime('pump_timestamp')->nullable();
                $table->boolean('cargo_pump1_run')->nullable();
                $table->boolean('cargo_pump2_run')->nullable();
                $table->boolean('cargo_pump3_run')->nullable();
                $table->boolean('wballast_pump1_run')->nullable();
                $table->boolean('wballast_pump2_run')->nullable();
                $table->boolean('tank_cleanning_pump_run')->nullable();
                $table->boolean('stripping_pump1_run')->nullable();
                $table->boolean('stripping_pump2_run')->nullable();

                // cargo
                $table->datetime('cargo_timestamp')->nullable();
                $table->float('bp1_casing_temp', 10, 3)->default(0);
                $table->float('bp1_transmission_brg_temp', 10, 3)->default(0);
                $table->float('bp1_drive_end_bearing_temp', 10, 3)->default(0);
                $table->float('bp1_nondrive_end_bearing_temp', 10, 3)->default(0);
                $table->float('bp1_transmission_seal_temp', 10, 3)->default(0);
                $table->float('bp2_drive_end_bearing_temp', 10, 3)->default(0);
                $table->float('bp2_casing_temp', 10, 3)->default(0);
                $table->float('bp2_transmission_brg_temp', 10, 3)->default(0);
                $table->float('bp2_nondrive_end_bearing_temp', 10, 3)->default(0);
                $table->float('bp2_transmission_seal_temp', 10, 3)->default(0);
                $table->float('cp1_casing_temp', 10, 3)->default(0);
                $table->float('cp1_bearing_temp', 10, 3)->default(0);
                $table->float('cp1_transmission_brg_temp', 10, 3)->default(0);
                $table->float('cp1_discharge_pressure', 10, 3)->default(0);
                $table->float('cp1_transmission_seal_temp', 10, 3)->default(0);
                $table->float('cp2_casing_temp', 10, 3)->default(0);
                $table->float('cp2_bearing_temp', 10, 3)->default(0);
                $table->float('cp2_transmission_brg_temp', 10, 3)->default(0);
                $table->float('cp2_discharge_pressure', 10, 3)->default(0);
                $table->float('cp2_transmission_seal_temp', 10, 3)->default(0);
                $table->float('cp3_bearing_temp', 10, 3)->default(0);
                $table->float('cp3_casing_temp', 10, 3)->default(0);
                $table->float('cp3_discharge_pressure', 10, 3)->default(0);
                $table->float('cp3_transmission_brg_temp', 10, 3)->default(0);
                $table->float('cp3_transmission_seal_temp', 10, 3)->default(0);
                $table->float('sp1_discharge_pressure', 10, 3)->default(0);
                $table->float('sp1_drive_end_bearing_temp', 10, 3)->default(0);
                $table->float('sp1_casing_temp', 10, 3)->default(0);
                $table->float('sp1_nondrive_end_bearing_temp', 10, 3)->default(0);
                $table->float('sp1_transmission_brg_temp', 10, 3)->default(0);
                $table->float('sp2_casing_temp', 10, 3)->default(0);
                $table->float('sp1_transmission_seal_temp', 10, 3)->default(0);
                $table->float('sp2_discharge_pressure', 10, 3)->default(0);
                $table->float('sp2_drive_end_bearing_temp', 10, 3)->default(0);
                $table->float('sp2_nondrive_end_bearing_temp', 10, 3)->default(0);
                $table->float('sp2_transmission_brg_temp', 10, 3)->default(0);
                $table->float('sp2_transmission_seal_temp', 10, 3)->default(0);
                $table->float('tcp_casing_temp', 10, 3)->default(0);
                $table->float('tcp_discharge_pressure', 10, 3)->default(0);
                $table->float('tcp_nondrive_end_bearing_temp', 10, 3)->default(0);
                $table->float('tcp_drive_end_bearing_temp', 10, 3)->default(0);
                $table->float('tcp_transmission_brg_temp', 10, 3)->default(0);
                $table->float('tcp_transmission_seal_temp', 10, 3)->default(0);

                $table->timestamps();
            });
        }
        $model->addColumn($tableName, [
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
        ]);
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
        $last = KasimLog::table($model->fleet_id, $date)->orderBy('terminal_time', 'desc')->first();

        $now = Carbon::parse($date);

        // save interval 60 detik
        if ($last && $now->diffInSeconds($last->terminal_time) < config('mqtt.interval_save', 60)) {
            return;
        }

        return KasimLog::table($model->fleet_id, $date)->updateOrCreate([
            'fleet_id' => $model->fleet_id,
            'terminal_time' => $date,
        ], (array) $model->makeHidden(['id', 'bunkers', 'cargos', 'fleet_id', 'created_at', 'updated_at'])->toArray());
    }
}
