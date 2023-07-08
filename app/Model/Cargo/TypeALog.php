<?php

declare(strict_types=1);

namespace App\Model\Cargo;

use Hyperf\Database\Schema\Schema;
use Hyperf\DbConnection\Model\Model;
use Hyperf\Database\Schema\Blueprint;
use Carbon\Carbon;

class TypeALog extends Model
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
                $table->float('cargo_pump1_run', 10, 3)->default(0);
                $table->float('cargo_pump2_run', 10, 3)->default(0);
                $table->float('compressor_no1_run', 10, 3)->default(0);
                $table->float('compressor_no2_run', 10, 3)->default(0);
                $table->timestamps();
            });
        }
        
        return $model->setTable($tableName);
    }
}
