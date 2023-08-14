<?php

declare(strict_types=1);

namespace App\Model\Cargo;

use Hyperf\Database\Schema\Schema;
use Hyperf\DbConnection\Model\Model;
use Hyperf\Database\Schema\Blueprint;
use Carbon\Carbon;

class TypeSLog extends Model
{
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

                // pump status
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
        
        return $model->setTable($tableName);
    }
}
