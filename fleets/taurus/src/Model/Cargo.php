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
namespace Smartship\Taurus\Model;

use Carbon\Carbon;
use Hyperf\Database\Schema\Schema;
use App\Model\Traits\HasColumnTrait;
use Hyperf\DbConnection\Model\Model;
use Hyperf\Database\Schema\Blueprint;
use App\Model\Traits\CargoTankCalculate;
use Hyperf\Database\Model\Events\Updated;
use Hyperf\Database\Model\Events\Updating;

class Cargo extends Model
{
    use HasColumnTrait;
    use CargoTankCalculate;

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
                
                // hanla
                $table->float('level_cot_1p')->default(0);
                $table->float('temp_cot_1p')->default(0);
                $table->float('level_cot_1p_mt')->nullable();
                $table->float('level_cot_1s')->default(0);
                $table->float('temp_cot_1s')->default(0);
                $table->float('level_cot_1s_mt')->default(0);
                $table->float('level_cot_2p')->default(0);
                $table->float('temp_cot_2p')->default(0);
                $table->float('level_cot_2p_mt')->default(0);
                $table->float('level_cot_2s')->default(0);
                $table->float('temp_cot_2s')->default(0);
                $table->float('level_cot_2s_mt')->default(0);
                $table->float('level_cot_3p')->default(0);
                $table->float('temp_cot_3p')->default(0);
                $table->float('level_cot_3p_mt')->default(0);
                $table->float('level_cot_3s')->default(0);
                $table->float('temp_cot_3s')->default(0);
                $table->float('level_cot_3s_mt')->default(0);
                $table->float('level_cot_4p')->default(0);
                $table->float('temp_cot_4p')->default(0);
                $table->float('level_cot_4p_mt')->default(0);
                $table->float('level_cot_4s')->default(0);
                $table->float('temp_cot_4s')->default(0);
                $table->float('level_cot_4s_mt')->default(0);
                $table->float('level_cot_5p')->default(0);
                $table->float('temp_cot_5p')->default(0);
                $table->float('level_cot_5p_mt')->default(0);
                $table->float('level_cot_5s')->default(0);
                $table->float('temp_cot_5s')->default(0);
                $table->float('level_cot_5s_mt')->default(0);
                $table->float('level_slop_p')->default(0);
                $table->float('temp_slop_p')->default(0);
                $table->float('level_slop_s')->default(0);
                $table->float('temp_slop_s')->default(0);
                $table->float('fore_peak_tank')->default(0);
                $table->float('level_wbt_1p')->default(0);
                $table->float('level_wbt_1s')->default(0);
                $table->float('level_wbt_2p')->default(0);
                $table->float('level_wbt_2s')->default(0);
                $table->float('level_wbt_3p')->default(0);
                $table->float('level_wbt_3s')->default(0);
                $table->float('level_wbt_4p')->default(0);
                $table->float('level_wbt_4s')->default(0);
                $table->float('level_wbt_5p')->default(0);
                $table->float('level_wbt_5s')->default(0);
                $table->float('level_draft_fore')->default(0);
                $table->float('level_draft_after')->default(0);
                $table->float('after_peak_tank')->default(0);
                $table->float('mdo_mgo_tank_p')->default(0);
                $table->float('mdo_tank_s')->default(0);
                $table->float('fore_fw_tank_p')->default(0);
                $table->float('fore_fw_tank_s')->default(0);
                $table->float('fw_tank_p')->default(0);
                $table->float('fw_tank_s')->default(0);
                $table->float('fo_overflow_tank')->default(0);

                // pump
                $table->datetime('cargo_pump_timestamp')->nullable();
                $table->float('cargo_pump1_run')->default(0);
                $table->float('cargo_pump2_run')->default(0);
                $table->float('cargo_pump3_run')->default(0);
                $table->float('wballast_pump1_run')->default(0);
                $table->float('wballast_pump2_run')->default(0);
                $table->float('tank_cleaning_pump1_run')->default(0);
                $table->float('tank_cleaning_pump2_run')->default(0);

                $table->timestamps();
            });
        }

        return $model->setTable($tableName);
    }

    public function updating(Updating $event) 
    {
        $model = $event->getModel();
        // calculate cargo
        $cargoData = $this->calculate($model);
    
        foreach($cargoData as $k => $v) {
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
        ], (array) $model->makeHidden(['id', 'fleet_id', 'created_at', 'updated_at'])->toArray());
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
