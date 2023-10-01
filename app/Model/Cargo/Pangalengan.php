<?php

declare(strict_types=1);

namespace App\Model\Cargo;

use Carbon\Carbon;
use Hyperf\Database\Schema\Schema;
use Hyperf\DbConnection\Model\Model;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Model\Events\Updated;

class Pangalengan extends Model
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
     * all 
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
        $model = new self;
        $tableName = $model->getTable() . "_{$fleetId}";
        
        if(! Schema::hasTable($tableName)) {
            Schema::create($tableName, function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('fleet_id')->index();
                $table->datetime('terminal_time')->index();
                $table->float('no_1_cargo_tank_p', 10,3)->default(0);
                $table->float('temp_1ctp', 10,3)->default(0);
                $table->float('no_1_cargo_tank_s', 10,3)->default(0);
                $table->float('temp_1cts', 10,3)->default(0);
                $table->float('no_2_cargo_tank_p', 10,3)->default(0);
                $table->float('temp_2ctp', 10,3)->default(0);
                $table->float('no_2_cargo_tank_s', 10,3)->default(0);
                $table->float('temp_2cts', 10,3)->default(0);
                $table->float('no_3_cargo_tank_p', 10,3)->default(0);
                $table->float('temp_3ctp', 10,3)->default(0);
                $table->float('no_3_cargo_tank_s', 10,3)->default(0);
                $table->float('temp_3cts', 10,3)->default(0);
                $table->float('no_4_cargo_tank_p', 10,3)->default(0);
                $table->float('temp_4ctp', 10,3)->default(0);
                $table->float('no_4_cargo_tank_s', 10,3)->default(0);
                $table->float('temp_4cts', 10,3)->default(0);
                $table->float('no_5_cargo_tank_p', 10,3)->default(0);
                $table->float('temp_5ctp', 10,3)->default(0);
                $table->float('no_5_cargo_tank_s', 10,3)->default(0);
                $table->float('temp_5cts', 10,3)->default(0);
                $table->float('slop_cargo_tank_p', 10,3)->default(0);
                $table->float('temp_sctp', 10,3)->default(0);
                $table->float('slop_cargo_tank_s', 10,3)->default(0);
                $table->float('temp_scts', 10,3)->default(0);
                $table->float('f_p_t_c', 10,3)->default(0);
                $table->float('no_1_wbt_p', 10,3)->default(0);
                $table->float('no_1_wbt_s', 10,3)->default(0);
                $table->float('no_2_wbt_p', 10,3)->default(0);
                $table->float('no_2_wbt_s', 10,3)->default(0);
                $table->float('no_3_wbt_p', 10,3)->default(0);
                $table->float('no_3_wbt_s', 10,3)->default(0);
                $table->float('no_4_wbt_p', 10,3)->default(0);
                $table->float('no_4_wbt_s', 10,3)->default(0);
                $table->float('no_5_wbt_p', 10,3)->default(0);
                $table->float('no_5_wbt_s', 10,3)->default(0);
                $table->float('no_6_wbt_p', 10,3)->default(0);
                $table->float('no_6_wbt_s', 10,3)->default(0);
                $table->float('no_7_wbt_p', 10,3)->default(0);
                $table->float('no_7_wbt_s', 10,3)->default(0);
                $table->float('aftk_p', 10,3)->default(0);
                $table->float('aftk_s', 10,3)->default(0);
                $table->float('no_1_hfo_p', 10,3)->default(0);
                $table->float('no_2_hfo_s', 10,3)->default(0);
                $table->float('no_1_hfoday_p', 10,3)->default(0);
                $table->float('no_2_hfoday_s', 10,3)->default(0);
                $table->float('hfo_sett_p', 10,3)->default(0);
                $table->float('mdo_sett_s', 10,3)->default(0);
                $table->float('no_1_mdo_p', 10,3)->default(0);
                $table->float('no_2_mdo_s', 10,3)->default(0);
                $table->float('no_1_mdoday_p', 10,3)->default(0);
                $table->float('no_s_mdoday_s', 10,3)->default(0);
                $table->float('volume_cot_1p', 10,3)->default(0);
                $table->float('volume_cot_1s', 10,3)->default(0);
                $table->float('volume_cot_2p', 10,3)->default(0);
                $table->float('volume_cot_2s', 10,3)->default(0);
                $table->float('volume_cot_3p', 10,3)->default(0);
                $table->float('volume_cot_3s', 10,3)->default(0);
                $table->float('volume_cot_4p', 10,3)->default(0);
                $table->float('volume_cot_4s', 10,3)->default(0);
                $table->float('volume_cot_5p', 10,3)->default(0);
                $table->float('volume_cot_5s', 10,3)->default(0);
                $table->float('volume_fpt', 10,3)->default(0);
                $table->float('volume_wbt_1p', 10,3)->default(0);
                $table->float('volume_wbt_1s', 10,3)->default(0);
                $table->float('volume_wbt_2p', 10,3)->default(0);
                $table->float('volume_wbt_2s', 10,3)->default(0);
                $table->float('volume_wbt_3p', 10,3)->default(0);
                $table->float('volume_wbt_3s', 10,3)->default(0);
                $table->float('volume_wbt_4p', 10,3)->default(0);
                $table->float('volume_wbt_4s', 10,3)->default(0);
                $table->float('volume_wbt_5p', 10,3)->default(0);
                $table->float('volume_wbt_5s', 10,3)->default(0);
                $table->float('volume_wbt_6p', 10,3)->default(0);
                $table->float('volume_wbt_6s', 10,3)->default(0);
                $table->float('volume_wbt_7p', 10,3)->default(0);
                $table->float('volume_wbt_7s', 10,3)->default(0);
                $table->float('volume_aft_1p', 10,3)->default(0);
                $table->float('volume_aft_1s', 10,3)->default(0);
                $table->float('volume_mdo_1p', 10,3)->default(0);
                $table->float('volume_mdo_2s', 10,3)->default(0);
                $table->float('volume_hfo_1p', 10,3)->default(0);
                $table->float('volume_hfo_2s', 10,3)->default(0);
                $table->float('volume_mdo_sett_s', 10,3)->default(0);
                $table->float('volume_mdoday_1p', 10,3)->default(0);
                $table->float('volume_mdoday_2s', 10,3)->default(0);
                $table->float('volume_hfo_sett_p', 10,3)->default(0);
                $table->float('cargo_pump1_run', 10,3)->default(0);
                $table->float('cargo_pump2_run', 10,3)->default(0);
                $table->float('cargo_pump3_run', 10,3)->default(0);
                $table->float('wballast_pump1_run', 10,3)->default(0);
                $table->float('wballast_pump2_run', 10,3)->default(0);
                $table->float('tank_cleaning_pump_run', 10,3)->default(0);
                $table->float('stripping_pump_run', 10,3)->default(0);
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
        $last = PangalenganLog::table($model->fleet_id, $date)->orderBy('terminal_time', 'desc')->first();
     
        $now = Carbon::parse($date);

        // save interval 60 detik
        if($last && $now->diffInSeconds($last->terminal_time) < config('mqtt.interval_save', 60) ) {   
            return;
        }
        
        return PangalenganLog::table($model->fleet_id, $date)->updateOrCreate([
            'fleet_id' => $model->fleet_id,
            'terminal_time' => $date,
        ], (array) $model->makeHidden(['id', 'fleet_id', 'created_at', 'updated_at'])->toArray());
    }
}
