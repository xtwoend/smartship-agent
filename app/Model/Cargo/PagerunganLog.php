<?php

declare(strict_types=1);

namespace App\Model\Cargo;

use Carbon\Carbon;
use Hyperf\Database\Schema\Schema;
use Hyperf\DbConnection\Model\Model;
use App\Model\Alarm\SensorAlarmTrait;
use Hyperf\Database\Schema\Blueprint;

class PagerunganLog extends Model
{
    use SensorAlarmTrait;

    /**
     * engine group sensor
     */
    public array $sensor_group = ['cargo'];
    
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'cargo_log';

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
    public static function table($fleetId, $date = null)
    {
        $date = is_null($date) ? date('Ym'): Carbon::parse($date)->format('Ym');
        $model = new self;
        $tableName = $model->getTable() . "_{$fleetId}_{$date}";
        
        if(! Schema::hasTable($tableName)) {
            Schema::create($tableName, function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('fleet_id')->index();
                $table->datetime('terminal_time')->unique();
                
                $table->float('pump_non_drvend_c1', 10, 3)->default(0);
                $table->float('pump_casing_c1', 10, 3)->default(0);
                $table->float('bulk_head_c1', 10, 3)->default(0);
                $table->float('transmission_sealing_c1', 10, 3)->default(0);
                $table->float('pump_non_drvend_c2', 10, 3)->default(0);
                $table->float('pump_casing_c2', 10, 3)->default(0);
                $table->float('bulk_head_c2', 10, 3)->default(0);
                $table->float('transmission_sealing_c2', 10, 3)->default(0);
                $table->float('pump_non_drvend_c3', 10, 3)->default(0);
                $table->float('pump_casing_c3', 10, 3)->default(0);
                $table->float('bulk_head_c3', 10, 3)->default(0);
                $table->float('transmission_sealing_c3', 10, 3)->default(0);
                $table->float('pump_non_drvend_bp1', 10, 3)->default(0);
                $table->float('pump_casing_bp1', 10, 3)->default(0);
                $table->float('bulk_head_bp1', 10, 3)->default(0);
                $table->float('tansmission_sealing_bp1', 10, 3)->default(0);
                $table->float('pump_non_drvend_bp2', 10, 3)->default(0);
                $table->float('pump_casing_bp2', 10, 3)->default(0);
                $table->float('bulk_head_bp2', 10, 3)->default(0);
                $table->float('transmission_sealing_bp2', 10, 3)->default(0);
                $table->float('pump_non_drvend_sp1', 10, 3)->default(0);
                $table->float('pump_casing_sp1', 10, 3)->default(0);
                $table->float('bulk_head_sp1', 10, 3)->default(0);
                $table->float('transmission_sealing_sp1', 10, 3)->default(0);
                $table->float('pump_non_drvend_tcp', 10, 3)->default(0);
                $table->float('pump_casing_tcp', 10, 3)->default(0);
                $table->float('bulk_head_tcp', 10, 3)->default(0);
                $table->float('transmission_sealing_tcp', 10, 3)->default(0);

                $table->datetime('pump_latest_update_at')->nullable();
                $table->boolean('cargo_pump1_run')->nullable();
                $table->boolean('cargo_pump1_alarm')->nullable();
                $table->boolean('cargo_pump2_run')->nullable();
                $table->boolean('cargo_pump2_alarm')->nullable();
                $table->boolean('cargo_pump3_run')->nullable();
                $table->boolean('cargo_pump3_alarm')->nullable();
                $table->boolean('ballast_pump1_run')->nullable();
                $table->boolean('ballast_pump1_alarm')->nullable();
                $table->boolean('ballast_pump2_run')->nullable();
                $table->boolean('ballast_pump2_alarm')->nullable();
                $table->boolean('stripping_pump_run')->nullable();
                $table->boolean('stripping_pump_alarm')->nullable();
                $table->boolean('cleaningtank_pump_run')->nullable();
                $table->boolean('cleaningtank_pump_alarm')->nullable();

                // panasia/hanla
                $table->float('cargo_tank1p_ullage', 10, 3)->default(0);
                $table->float('cargo_tank1s_ullage', 10, 3)->default(0);
                $table->float('cargo_tank2p_ullage', 10, 3)->default(0);
                $table->float('cargo_tank2s_ullage', 10, 3)->default(0);
                $table->float('cargo_tank3p_ullage', 10, 3)->default(0);
                $table->float('cargo_tank3s_ullage', 10, 3)->default(0);
                $table->float('cargo_tank4p_ullage', 10, 3)->default(0);
                $table->float('cargo_tank4s_ullage', 10, 3)->default(0);
                $table->float('cargo_tank5p_ullage', 10, 3)->default(0);
                $table->float('cargo_tank5s_ullage', 10, 3)->default(0);
                $table->float('slop_tank_p_ullage', 10, 3)->default(0);
                $table->float('slop_tank_s_ullage', 10, 3)->default(0);
                $table->float('water_ballast_tank1p_level', 10, 3)->default(0);
                $table->float('water_ballast_tank1s_level', 10, 3)->default(0);
                $table->float('water_ballast_tank2p_level', 10, 3)->default(0);
                $table->float('water_ballast_tank2s_level', 10, 3)->default(0);
                $table->float('water_ballast_tank3p_level', 10, 3)->default(0);
                $table->float('water_ballast_tank3s_level', 10, 3)->default(0);
                $table->float('water_ballast_tank4p_level', 10, 3)->default(0);
                $table->float('water_ballast_tank4s_level', 10, 3)->default(0);
                $table->float('water_ballast_tank5p_level', 10, 3)->default(0);
                $table->float('water_ballast_tank5s_level', 10, 3)->default(0);
                $table->float('water_ballast_tank6p_level', 10, 3)->default(0);
                $table->float('water_ballast_tank6s_level', 10, 3)->default(0);
                $table->float('fore_peak_tank_leve', 10, 3)->default(0);
                $table->float('after_peak_tank_level', 10, 3)->default(0);
                $table->float('no1_fo_tank_p_level', 10, 3)->default(0);
                $table->float('no1_fo_tank_s_level', 10, 3)->default(0);
                $table->float('no2_fo_tank_p_level', 10, 3)->default(0);
                $table->float('no2_fo_tank_s_level', 10, 3)->default(0);
                $table->float('no1_fo_service_tank_level', 10, 3)->default(0);
                $table->float('no2_fo_service_tank_level', 10, 3)->default(0);
                $table->float('fo_settling_tank_level', 10, 3)->default(0);
                $table->float('do_storage_tank_p_level', 10, 3)->default(0);
                $table->float('do_storage_tank_s_level', 10, 3)->default(0);
                $table->float('no1_do_service_tank_level', 10, 3)->default(0);
                $table->float('no2_do_service_tank_level', 10, 3)->default(0);
                $table->float('do_setting_tank_level', 10, 3)->default(0);
                $table->float('draft_sensor_level', 10, 3)->default(0);
                $table->float('draft_mark_level', 10, 3)->default(0);
                $table->float('draft_pp_level', 10, 3)->default(0);
                $table->float('cargo_tank1p_upper_temp', 10, 3)->default(0);
                $table->float('cargo_tank1p_middle_temp', 10, 3)->default(0);
                $table->float('cargo_tank1p_bottom_temp', 10, 3)->default(0);
                $table->float('cargo_tank1p_pressure', 10, 3)->default(0);
                $table->float('cargo_tank1p_volume', 10, 3)->default(0);
                $table->float('cargo_tank1s_upper_temp', 10, 3)->default(0);
                $table->float('cargo_tank1s_middle_temp', 10, 3)->default(0);
                $table->float('cargo_tank1s_bottom_temp', 10, 3)->default(0);
                $table->float('cargo_tank1s_pressure', 10, 3)->default(0);
                $table->float('cargo_tank1s_volume', 10, 3)->default(0);
                $table->float('cargo_tank2p_upper_temp', 10, 3)->default(0);
                $table->float('cargo_tank2p_middle_temp', 10, 3)->default(0);
                $table->float('cargo_tank2p_bottom_temp', 10, 3)->default(0);
                $table->float('cargo_tank2p_pressure', 10, 3)->default(0);
                $table->float('cargo_tank2p_volume', 10, 3)->default(0);
                $table->float('cargo_tank2s_upper_temp', 10, 3)->default(0);
                $table->float('cargo_tank2s_middle_temp', 10, 3)->default(0);
                $table->float('cargo_tank2s_bottom_temp', 10, 3)->default(0);
                $table->float('cargo_tank2s_pressure', 10, 3)->default(0);
                $table->float('cargo_tank2s_volume', 10, 3)->default(0);
                $table->float('cargo_tank3p_upper_temp', 10, 3)->default(0);
                $table->float('cargo_tank3p_middle_temp', 10, 3)->default(0);
                $table->float('cargo_tank3p_bottom_temp', 10, 3)->default(0);
                $table->float('cargo_tank3p_pressure', 10, 3)->default(0);
                $table->float('cargo_tank3p_volume', 10, 3)->default(0);
                $table->float('cargo_tank3s_upper_temp', 10, 3)->default(0);
                $table->float('cargo_tank3s_middle_temp', 10, 3)->default(0);
                $table->float('cargo_tank3s_bottom_temp', 10, 3)->default(0);
                $table->float('cargo_tank3s_pressure', 10, 3)->default(0);
                $table->float('cargo_tank3s_volume', 10, 3)->default(0);
                $table->float('cargo_tank4p_upper_temp', 10, 3)->default(0);
                $table->float('cargo_tank4p_middle_temp', 10, 3)->default(0);
                $table->float('cargo_tank4p_bottom_temp', 10, 3)->default(0);
                $table->float('cargo_tank4p_pressure', 10, 3)->default(0);
                $table->float('cargo_tank4p_volume', 10, 3)->default(0);
                $table->float('cargo_tank4s_upper_temp', 10, 3)->default(0);
                $table->float('cargo_tank4s_middle_temp', 10, 3)->default(0);
                $table->float('cargo_tank4s_bottom_temp', 10, 3)->default(0);
                $table->float('cargo_tank4s_pressure', 10, 3)->default(0);
                $table->float('cargo_tank4s_volume', 10, 3)->default(0);
                $table->float('cargo_tank5p_upper_temp', 10, 3)->default(0);
                $table->float('cargo_tank5p_middle_temp', 10, 3)->default(0);
                $table->float('cargo_tank5p_bottom_temp', 10, 3)->default(0);
                $table->float('cargo_tank5p_pressure', 10, 3)->default(0);
                $table->float('cargo_tank5p_volume', 10, 3)->default(0);
                $table->float('cargo_tank5s_upper_temp', 10, 3)->default(0);
                $table->float('cargo_tank5s_middle_temp', 10, 3)->default(0);
                $table->float('cargo_tank5s_bottom_temp', 10, 3)->default(0);
                $table->float('cargo_tank5s_pressure', 10, 3)->default(0);
                $table->float('cargo_tank5s_volume', 10, 3)->default(0);
                $table->float('slop_tank_p_upper_temp', 10, 3)->default(0);
                $table->float('slop_tank_p_middle_temp', 10, 3)->default(0);
                $table->float('slop_tank_p_bottom_temp', 10, 3)->default(0);
                $table->float('slop_tank_p_pressure', 10, 3)->default(0);
                $table->float('slop_tank_p_volume', 10, 3)->default(0);
                $table->float('slop_tank_s_upper_temp', 10, 3)->default(0);
                $table->float('slop_tank_s_middle_temp', 10, 3)->default(0);
                $table->float('slop_tank_s_bottom_temp', 10, 3)->default(0);
                $table->float('slop_tank_s_pressure', 10, 3)->default(0);
                $table->float('slop_tank_s_volume', 10, 3)->default(0);
                $table->float('no1_fo_tank_p_volume', 10, 3)->default(0);
                $table->float('no1_fo_tank_s_volume', 10, 3)->default(0);
                $table->float('no2_fo_tank_p_volume', 10, 3)->default(0);
                $table->float('no2_fo_tank_s_volume', 10, 3)->default(0);
                $table->float('no1_fo_service_tank_volume', 10, 3)->default(0);
                $table->float('no2_fo_service_tank_volume', 10, 3)->default(0);
                $table->float('fo_settling_tank_volume', 10, 3)->default(0);
                $table->float('do_storage_tank_p_volume', 10, 3)->default(0);
                $table->float('do_storage_tank_s_volume', 10, 3)->default(0);
                $table->float('no1_do_service_tank_volume', 10, 3)->default(0);
                $table->float('no2_do_service_tank_volume', 10, 3)->default(0);
                $table->float('do_setting_tank_volume', 10, 3)->default(0);

                $table->timestamps();
            });
        }
        
        return $model->setTable($tableName);
    }


    // Calculate percentage cargo capacity
    public function cargoCapacity($model) : void {
    
        $cargoArray = [
            'cargo_tank1p_ullage', 
            'cargo_tank1s_ullage', 
            'cargo_tank2p_ullage', 
            'cargo_tank2s_ullage',
            'cargo_tank3p_ullage', 
            'cargo_tank3s_ullage', 
            'cargo_tank4p_ullage', 
            'cargo_tank4s_ullage', 
            'cargo_tank5p_ullage', 
            'cargo_tank5s_ullage', 
        ];
        
        $sensors = \App\Model\Sensor::where('fleet_id', $model->fleet_id)->where('group', 'cargo')->pluck('danger', 'sensor_name')->toArray();
        $data = [];
        foreach($cargoArray as $c) {
            $max = $sensors[$c];
            $value = $model->{$c};
            
            $percentage = ($value <= $max)? ($value / $max) : 0;
            $data[$c] = (1 - $percentage);
        }
        
        $totalPercentage = 0;
        foreach($data as $d) {
            $totalPercentage += $d;
        }

        $percentageCargo = $totalPercentage / count($cargoArray);

        $now = \Carbon\Carbon::now();
        $fsr = \App\Model\FleetDailyReport::table($model->fleet_id)->where([
            'fleet_id' => $model->fleet_id,
            'date' => $now->format('Y-m-d'),
            'sensor' => 'cargo_percentage'
        ])->first();
        
        if(! $fsr) {
            $fsr = \App\Model\FleetDailyReport::table($model->fleet_id);
            $fsr->fleet_id = $model->fleet_id;
            $fsr->date = $now->format('Y-m-d');
            $fsr->sensor = 'cargo_percentage';
            $fsr->before = $percentageCargo;
        }

        $fsr->after = $percentageCargo;
        $fsr->value = ($fsr->after - $fsr->before);
        $fsr->save();
    }
}
