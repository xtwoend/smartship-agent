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

class Arimbi extends Model
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
        'temp_tank_upper_no1' =>    ['port', ['temp_tank_upper_no1_mt', 'temp_tank_upper_no1_ltr'],    ['mes_type' => 'ullage', 'height' => 0, 'content' => '', 'compare' => [0]]],
        'temp_tank_upper_no2' =>    ['port', ['temp_tank_upper_no2_mt', 'temp_tank_upper_no2_ltr'],    ['mes_type' => 'ullage', 'height' => 0, 'content' => '', 'compare' => [0]]],
        'temp_comp_outlet_no1' =>   ['port', ['temp_comp_outlet_no1_mt', 'temp_comp_outlet_no1_ltr'],   ['mes_type' => 'ullage', 'height' => 0, 'content' => '', 'compare' => [0]]],
        'tamp_tank_middle_no1' =>   ['port', ['tamp_tank_middle_no1_mt', 'tamp_tank_middle_no1_ltr'],   ['mes_type' => 'ullage', 'height' => 0, 'content' => '', 'compare' => [0]]],
        'tamp_tank_middle_no2' =>   ['port', ['tamp_tank_middle_no2_mt', 'tamp_tank_middle_no2_ltr'],   ['mes_type' => 'ullage', 'height' => 0, 'content' => '', 'compare' => [0]]],
        'temp_comp_outlet_no2' =>   ['port', ['temp_comp_outlet_no2_mt', 'temp_comp_outlet_no2_ltr'],   ['mes_type' => 'ullage', 'height' => 0, 'content' => '', 'compare' => [0]]],
        'tamp_tank_bottom_no1' =>   ['port', ['tamp_tank_bottom_no1_mt', 'tamp_tank_bottom_no1_ltr'],   ['mes_type' => 'ullage', 'height' => 0, 'content' => '', 'compare' => [0]]],
        'tamp_tank_bottom_no2' =>   ['port', ['tamp_tank_bottom_no2_mt', 'tamp_tank_bottom_no2_ltr'],   ['mes_type' => 'ullage', 'height' => 0, 'content' => '', 'compare' => [0]]],
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
                $table->float('temp_tank_upper_no1', 10, 3)->default(0);
                $table->float('temp_tank_upper_no2', 10, 3)->default(0);
                $table->float('temp_comp_outlet_no1', 10, 3)->default(0);
                $table->float('pressure_tank_no1', 10, 3)->default(0);
                $table->float('tamp_tank_middle_no1', 10, 3)->default(0);
                $table->float('tamp_tank_middle_no2', 10, 3)->default(0);
                $table->float('temp_comp_outlet_no2', 10, 3)->default(0);
                $table->float('pressure_tank_no2', 10, 3)->default(0);
                $table->float('tamp_tank_bottom_no1', 10, 3)->default(0);
                $table->float('tamp_tank_bottom_no2', 10, 3)->default(0);
                $table->float('pressure_comp_inlet', 10, 3)->default(0);
                $table->float('pressure_comp_outlet', 10, 3)->default(0);
                $table->float('ullage_cargo_no1', 10, 3)->default(0);
                $table->float('ullage_cargo_no2', 10, 3)->default(0);
                $table->float('data15', 10, 3)->default(0);
                $table->float('data16', 10, 3)->default(0);
                $table->float('deepwell_pump1_run', 10, 3)->default(0);
                $table->float('deepwell_pump2_run', 10, 3)->default(0);
                $table->float('cargo_compressor_no1_run', 10, 3)->default(0);
                $table->float('cargo_compressor_no2_run', 10, 3)->default(0);
                $table->timestamps();
            });
        }

        $tablePayload = $model->tablePayloadBuilder($model);
        $model->addColumn($tableName, $tablePayload);
        $logModel = new ArimbiLog();
        $logModel->table($fleetId, null, $tablePayload);

        // $model->addColumn($tableName, [
        //     [
        //         'type' => 'float',
        //         'name' => 'temp_tank_upper_no1_mt',
        //         'after' => 'temp_tank_upper_no1',
        //     ],
        //     [
        //         'type' => 'float',
        //         'name' => 'temp_tank_upper_no2_mt',
        //         'after' => 'temp_tank_upper_no2',
        //     ],
        //     [
        //         'type' => 'float',
        //         'name' => 'temp_comp_outlet_no1_mt',
        //         'after' => 'temp_comp_outlet_no1',
        //     ],
        //     [
        //         'type' => 'float',
        //         'name' => 'tamp_tank_middle_no1_mt',
        //         'after' => 'tamp_tank_middle_no1',
        //     ],
        //     [
        //         'type' => 'float',
        //         'name' => 'tamp_tank_middle_no2_mt',
        //         'after' => 'tamp_tank_middle_no2',
        //     ],
        //     [
        //         'type' => 'float',
        //         'name' => 'temp_comp_outlet_no2_mt',
        //         'after' => 'temp_comp_outlet_no2',
        //     ],
        //     [
        //         'type' => 'float',
        //         'name' => 'tamp_tank_bottom_no1_mt',
        //         'after' => 'tamp_tank_bottom_no1',
        //     ],
        //     [
        //         'type' => 'float',
        //         'name' => 'tamp_tank_bottom_no2_mt',
        //         'after' => 'tamp_tank_bottom_no2',
        //     ],
        // ]);

        return $model->setTable($tableName);
    }

    public function updating(Updating $event)
    {
        $model = $event->getModel();
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
        $last = ArimbiLog::table($model->fleet_id, $date)->orderBy('terminal_time', 'desc')->first();

        $now = Carbon::parse($date);

        // save interval 60 detik
        if ($last && $now->diffInSeconds($last->terminal_time) < config('mqtt.interval_save', 60)) {
            return;
        }

        return ArimbiLog::table($model->fleet_id, $date)->updateOrCreate([
            'fleet_id' => $model->fleet_id,
            'terminal_time' => $date,
        ], (array) $model->makeHidden(['id', 'bunkers', 'cargos', 'fleet_id', 'created_at', 'updated_at'])->toArray());
    }
}
