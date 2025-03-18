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

use App\Model\Traits\BunkerCapacityCalculate;
use Carbon\Carbon;
use Hyperf\Database\Schema\Schema;
use App\Model\Traits\HasColumnTrait;
use Hyperf\DbConnection\Model\Model;
use Hyperf\Database\Schema\Blueprint;
use App\Model\Traits\CargoTankCalculate;
use Hyperf\Database\Model\Events\Updated;
use Hyperf\Database\Model\Events\Updating;

class TypeS extends Model
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
        'cargo_pump1_run' => 'boolean',
        'cargo_pump1_alarm' => 'boolean',
        'cargo_pump2_run' => 'boolean',
        'cargo_pump2_alarm' => 'boolean',
        'cargo_pump3_run' => 'boolean',
        'cargo_pump3_alarm' => 'boolean',
        'ballast_pump1_run' => 'boolean',
        'ballast_pump1_alarm' => 'boolean',
        'ballast_pump2_run' => 'boolean',
        'ballast_pump2_alarm' => 'boolean',
        'stripping_pump_run' => 'boolean',
        'stripping_pump_alarm' => 'boolean',
    ];

    public ?array $cargoTanks = [
        'tank_1_port'   => ['port', ['tank_1_port_mt', 'tank_1_port_ltr'], ['mes_type' => 'ullage', 'heigh' => 0, 'content' => '', 'compare' => ['tank_1_port_temp']]],
        'tank_1_stb'    => ['stb',  ['tank_1_stb_mt', 'tank_1_stb_ltr'],  ['mes_type' => 'ullage', 'heigh' => 0, 'content' => '', 'compare' => ['tank_1_stb_temp']]],
        'tank_2_port'   => ['port', ['tank_2_port_mt', 'tank_2_port_ltr'], ['mes_type' => 'ullage', 'heigh' => 0, 'content' => '', 'compare' => ['tank_2_port_temp']]],
        'tank_2_stb'    => ['stb',  ['tank_2_stb_mt', 'tank_2_stb_ltr'],  ['mes_type' => 'ullage', 'heigh' => 0, 'content' => '', 'compare' => ['tank_2_stb_temp']]],
        'tank_3_port'   => ['port', ['tank_3_port_mt', 'tank_3_port_ltr'], ['mes_type' => 'ullage', 'heigh' => 0, 'content' => '', 'compare' => ['tank_3_port_temp']]],
        'tank_3_stb'    => ['stb',  ['tank_3_stb_mt', 'tank_3_stb_ltr'],  ['mes_type' => 'ullage', 'heigh' => 0, 'content' => '', 'compare' => ['tank_3_stb_temp']]],
        'tank_4_port'   => ['port', ['tank_4_port_mt', 'tank_4_port_ltr'], ['mes_type' => 'ullage', 'heigh' => 0, 'content' => '', 'compare' => ['tank_4_port_temp']]],
        'tank_4_stb'    => ['stb',  ['tank_4_stb_mt', 'tank_4_stb_ltr'],  ['mes_type' => 'ullage', 'heigh' => 0, 'content' => '', 'compare' => ['tank_4_stb_temp']]],
        'tank_5_port'   => ['port', ['tank_5_port_mt', 'tank_5_port_ltr'], ['mes_type' => 'ullage', 'heigh' => 0, 'content' => '', 'compare' => ['tank_5_port_temp']]],
        'tank_5_stb'    => ['stb',  ['tank_5_stb_mt', 'tank_5_stb_ltr'],  ['mes_type' => 'ullage', 'heigh' => 0, 'content' => '', 'compare' => ['tank_5_stb_temp']]],
        'tank_6_port'   => ['port', ['tank_6_port_mt', 'tank_6_port_ltr'], ['mes_type' => 'ullage', 'heigh' => 0, 'content' => '', 'compare' => ['tank_6_port_temp']]],
        'tank_6_stb'    => ['stb',  ['tank_6_stb_mt', 'tank_6_stb_ltr'],  ['mes_type' => 'ullage', 'heigh' => 0, 'content' => '', 'compare' => ['tank_6_stb_temp']]],
    ];

    public ?array $bunkerTanks = [
        'fuel_oil_1_port'           => ['port', ['fuel_oil_1_port_m3', 'fuel_oil_1_port_ltr', 'fuel_oil_1_port_mt'], ['mes_type' => 'level', 'content' => 'HFO']],
        'fuel_oil_1_stb'            => ['stb', ['fuel_oil_1_stb_m3', 'fuel_oil_1_stb_ltr', 'fuel_oil_1_stb_mt'], ['mes_type' => 'level', 'content' => 'HFO']],
        'fuel_oil_2_port'           => ['port', ['fuel_oil_2_port_m3', 'fuel_oil_2_port_ltr', 'fuel_oil_2_port_mt'], ['mes_type' => 'level', 'content' => 'HFO']],
        'fuel_oil_2_stb'            => ['stb', ['fuel_oil_2_stb_m3', 'fuel_oil_2_stb_ltr', 'fuel_oil_2_stb_mt'], ['mes_type' => 'level', 'content' => 'HFO']],
        'muel_oil_1_port'           => ['port', ['muel_oil_1_port_m3', 'muel_oil_1_port_ltr', 'muel_oil_1_port_mt'], ['mes_type' => 'level', 'content' => 'MDO']],
        'muel_oil_1_stb'            => ['stb', ['muel_oil_1_stb_m3', 'muel_oil_1_stb_ltr', 'muel_oil_1_stb_mt'], ['mes_type' => 'level', 'content' => 'MDO']],
        'muel_oil_2_port'           => ['port', ['muel_oil_2_port_m3', 'muel_oil_2_port_ltr', 'muel_oil_2_port_mt'], ['mes_type' => 'level', 'content' => 'MDO']],
        'do_fuel_oil_service_stb'   => ['stb', ['do_fuel_oil_service_stb_m3', 'do_fuel_oil_service_stb_ltr', 'do_fuel_oil_service_stb_mt'], ['mes_type' => 'level', 'content' => 'MDO']],
        'do_fuel_oil_settling_stb'  => ['stb', ['do_fuel_oil_settling_stb_m3', 'do_fuel_oil_settling_stb_ltr', 'do_fuel_oil_settling_stb_mt'], ['mes_type' => 'level', 'content' => 'MDO']],
        'fuel_oil_service_port'     => ['port', ['fuel_oil_service_port_m3', 'fuel_oil_service_port_ltr', 'fuel_oil_service_port_mt'], ['mes_type' => 'level', 'content' => 'HFO']],
        'fuel_oil_settling_port'    => ['port', ['fuel_oil_settling_port_m3', 'fuel_oil_settling_port_ltr', 'fuel_oil_settling_port_mt'], ['mes_type' => 'level', 'content' => 'HFO']],
        'ls_fuel_oil_service_port'  => ['port', ['ls_fuel_oil_service_port_m3', 'ls_fuel_oil_service_port_ltr', 'ls_fuel_oil_service_port_mt'], ['mes_type' => 'level', 'content' => 'HFO']],
        'ls_fuel_oil_settling_port' => ['port', ['ls_fuel_oil_settling_port_m3', 'ls_fuel_oil_settling_port_ltr', 'ls_fuel_oil_settling_port_mt'], ['mes_type' => 'level', 'content' => 'HFO']],
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
                $table->float('tank_1_port', 10, 3)->default(0);
                $table->float('tank_1_port_temp', 10, 3)->default(0);
                $table->float('tank_1_stb', 10, 3)->default(0);
                $table->float('tank_1_stb_temp', 10, 3)->default(0);
                $table->float('tank_2_port', 10, 3)->default(0);
                $table->float('tank_2_port_temp', 10, 3)->default(0);
                $table->float('tank_2_stb', 10, 3)->default(0);
                $table->float('tank_2_stb_temp', 10, 3)->default(0);
                $table->float('tank_3_port', 10, 3)->default(0);
                $table->float('tank_3_port_temp', 10, 3)->default(0);
                $table->float('tank_3_stb', 10, 3)->default(0);
                $table->float('tank_3_stb_temp', 10, 3)->default(0);
                $table->float('tank_4_port', 10, 3)->default(0);
                $table->float('tank_4_port_temp', 10, 3)->default(0);
                $table->float('tank_4_stb', 10, 3)->default(0);
                $table->float('tank_4_stb_temp', 10, 3)->default(0);
                $table->float('tank_5_port', 10, 3)->default(0);
                $table->float('tank_5_port_temp', 10, 3)->default(0);
                $table->float('tank_5_stb', 10, 3)->default(0);
                $table->float('tank_5_stb_temp', 10, 3)->default(0);
                $table->float('tank_6_port', 10, 3)->default(0);
                $table->float('tank_6_port_temp', 10, 3)->default(0);
                $table->float('tank_6_stb', 10, 3)->default(0);
                $table->float('tank_6_stb_temp', 10, 3)->default(0);

                $table->float('slop_port', 10, 3)->default(0);
                $table->float('slop_port_temp', 10, 3)->default(0);
                $table->float('slop_stb', 10, 3)->default(0);
                $table->float('slop_stb_temp', 10, 3)->default(0);

                $table->float('draft_front', 10, 3)->default(0);
                $table->float('draft_center_left', 10, 3)->default(0);
                $table->float('draft_center_right', 10, 3)->default(0);
                $table->float('draft_rear', 10, 3)->default(0);

                $table->float('fore_peak', 10, 3)->default(0);

                $table->float('water_ballas_1_port', 10, 3)->default(0);
                $table->float('water_ballas_1_stb', 10, 3)->default(0);
                $table->float('water_ballas_2_port', 10, 3)->default(0);
                $table->float('water_ballas_2_stb', 10, 3)->default(0);
                $table->float('water_ballas_3_port', 10, 3)->default(0);
                $table->float('water_ballas_3_stb', 10, 3)->default(0);
                $table->float('water_ballas_4_port', 10, 3)->default(0);
                $table->float('water_ballas_4_stb', 10, 3)->default(0);
                $table->float('water_ballas_5_port', 10, 3)->default(0);
                $table->float('water_ballas_5_stb', 10, 3)->default(0);
                $table->float('water_ballas_6_port', 10, 3)->default(0);
                $table->float('water_ballas_6_stb', 10, 3)->default(0);

                $table->float('after_peak', 10, 3)->default(0);

                $table->float('fuel_oil_1_port', 10, 3)->default(0);
                $table->float('fuel_oil_1_stb', 10, 3)->default(0);
                $table->float('fuel_oil_2_port', 10, 3)->default(0);
                $table->float('fuel_oil_2_stb', 10, 3)->default(0);

                $table->float('muel_oil_1_port', 10, 3)->default(0);
                $table->float('muel_oil_1_stb', 10, 3)->default(0);
                $table->float('muel_oil_2_port', 10, 3)->default(0);

                $table->float('do_fuel_oil_service_stb', 10, 3)->default(0);
                $table->float('do_fuel_oil_settling_stb', 10, 3)->default(0);
                $table->float('fuel_oil_service_port', 10, 3)->default(0);
                $table->float('fuel_oil_settling_port', 10, 3)->default(0);

                $table->float('ls_fuel_oil_service_port', 10, 3)->default(0);
                $table->float('ls_fuel_oil_settling_port', 10, 3)->default(0);

                $table->boolean('cargo_pump1_run')->default(false);
                $table->boolean('cargo_pump1_alarm')->default(false);
                $table->boolean('cargo_pump2_run')->default(false);
                $table->boolean('cargo_pump2_alarm')->default(false);
                $table->boolean('cargo_pump3_run')->default(false);
                $table->boolean('cargo_pump3_alarm')->default(false);

                $table->boolean('ballast_pump1_run')->default(false);
                $table->boolean('ballast_pump1_alarm')->default(false);
                $table->boolean('ballast_pump2_run')->default(false);
                $table->boolean('ballast_pump2_alarm')->default(false);
                $table->boolean('stripping_pump_run')->default(false);
                $table->boolean('stripping_pump_alarm')->default(false);

                $table->timestamps();
            });
        }
        // $model->addColumn($tableName, $model->tablePayloadBuilder($model));
        $tablePayload = $model->tablePayloadBuilder($model);
        $model->addColumn($tableName, $tablePayload);
        $logModel = new TypeSLog();
        $logModel->table($fleetId, null, $tablePayload);
        // $model->addColumn($tableName, [
        //     [
        //         'type' => 'float',
        //         'name' => 'tank_1_port_mt',
        //         'after' => 'tank_1_port',
        //     ],
        //     [
        //         'type' => 'float',
        //         'name' => 'tank_1_stb_mt',
        //         'after' => 'tank_1_stb',
        //     ],
        //     [
        //         'type' => 'float',
        //         'name' => 'tank_2_port_mt',
        //         'after' => 'tank_2_port',
        //     ],
        //     [
        //         'type' => 'float',
        //         'name' => 'tank_2_stb_mt',
        //         'after' => 'tank_2_stb',
        //     ],
        //     [
        //         'type' => 'float',
        //         'name' => 'tank_3_port_mt',
        //         'after' => 'tank_3_port',
        //     ],
        //     [
        //         'type' => 'float',
        //         'name' => 'tank_3_stb_mt',
        //         'after' => 'tank_3_stb',
        //     ],
        //     [
        //         'type' => 'float',
        //         'name' => 'tank_4_port_mt',
        //         'after' => 'tank_4_port',
        //     ],
        //     [
        //         'type' => 'float',
        //         'name' => 'tank_4_stb_mt',
        //         'after' => 'tank_4_stb',
        //     ],
        //     [
        //         'type' => 'float',
        //         'name' => 'tank_5_port_mt',
        //         'after' => 'tank_5_port',
        //     ],
        //     [
        //         'type' => 'float',
        //         'name' => 'tank_5_stb_mt',
        //         'after' => 'tank_5_stb',
        //     ],
        //     [
        //         'type' => 'float',
        //         'name' => 'tank_6_port_mt',
        //         'after' => 'tank_6_port',
        //     ],
        //     [
        //         'type' => 'float',
        //         'name' => 'tank_6_stb_mt',
        //         'after' => 'tank_6_stb',
        //     ],
        //     [
        //         'type' => 'float',
        //         'name' => 'fuel_oil_1_port_m3',
        //         'after' => 'fuel_oil_1_port',
        //     ],[
        //         'type' => 'float',
        //         'name' => 'fuel_oil_1_stb_m3',
        //         'after' => 'fuel_oil_1_stb',
        //     ],[
        //         'type' => 'float',
        //         'name' => 'fuel_oil_2_port_m3',
        //         'after' => 'fuel_oil_2_port',
        //     ],[
        //         'type' => 'float',
        //         'name' => 'fuel_oil_2_stb_m3',
        //         'after' => 'fuel_oil_2_stb',
        //     ],[
        //         'type' => 'float',
        //         'name' => 'muel_oil_1_port_m3',
        //         'after' => 'muel_oil_1_port',
        //     ],[
        //         'type' => 'float',
        //         'name' => 'muel_oil_1_stb_m3',
        //         'after' => 'muel_oil_1_stb',
        //     ],[
        //         'type' => 'float',
        //         'name' => 'muel_oil_2_port_m3',
        //         'after' => 'muel_oil_2_port',
        //     ],[
        //         'type' => 'float',
        //         'name' => 'do_fuel_oil_service_stb_m3',
        //         'after' => 'do_fuel_oil_service_stb',
        //     ],[
        //         'type' => 'float',
        //         'name' => 'do_fuel_oil_settling_stb_m3',
        //         'after' => 'do_fuel_oil_settling_stb',
        //     ],[
        //         'type' => 'float',
        //         'name' => 'fuel_oil_service_port_m3',
        //         'after' => 'fuel_oil_service_port',
        //     ],[
        //         'type' => 'float',
        //         'name' => 'fuel_oil_settling_port_m3',
        //         'after' => 'fuel_oil_settling_port',
        //     ],[
        //         'type' => 'float',
        //         'name' => 'ls_fuel_oil_service_port_m3',
        //         'after' => 'ls_fuel_oil_service_port',
        //     ],[
        //         'type' => 'float',
        //         'name' => 'ls_fuel_oil_settling_port_m3',
        //         'after' => 'ls_fuel_oil_settling_port',
        //     ],
        // ]);

        return $model->setTable($tableName);
    }

    public function updating(Updating $event)
    {
        $model = $event->getModel();
        $this->terminal_time = Carbon::now()->format('Y-m-d H:i:s');
        // calculate cargo
        $cargoData = $this->calculate($model);
        $updates = array_merge($cargoData, $this->bunkerCalculate($model) );
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
        $last = TypeSLog::table($model->fleet_id, $date)->orderBy('terminal_time', 'desc')->first();

        $now = Carbon::parse($date);

        // save interval 60 detik
        if ($last && $now->diffInSeconds($last->terminal_time) < config('mqtt.interval_save', 60)) {
            return;
        }
        return TypeSLog::table($model->fleet_id, $date)->updateOrCreate([
            'fleet_id' => $model->fleet_id,
            'terminal_time' => $date,
        ], (array) $model->makeHidden(['id', 'bunkers', 'cargos', 'fleet_id', 'created_at', 'updated_at'])->toArray());
    }
    

    
}
