<?php

declare(strict_types=1);

namespace App\Model;

use Carbon\Carbon;
use Hyperf\Database\Schema\Schema;
use Hyperf\DbConnection\Model\Model;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Model\Events\Creating;

/**
 */
class EngineLog extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'engine_log';
    protected string $primaryKey = 'id';
    protected string $keyType = 'string';
    public bool $incrementing = false;

    /**
     * The attributes that are mass assignable.
     */
    protected array $guarded = ['id'];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = [
        'terminal_time' => 'datetime'
    ];

    public static function table($fleetId, $date = null)
    {
        $date = is_null($date) ? date('Ym'): Carbon::parse($date)->format('Ym');
        $model = new self;
        $tableName = $model->getTable() . "_{$fleetId}_{$date}";
        
        if(! Schema::hasTable($tableName)) {
            Schema::create($tableName, function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->unsignedBigInteger('fleet_id')->index();
                $table->datetime('terminal_time')->unique()->index();
                $table->float('control_air_inlet', 12, 6)->default(0);
                $table->float('me_ac_cw_inlet_cooler', 12, 6)->default(0);
                $table->float('jcw_inlet', 12, 6)->default(0);
                $table->float('me_lo_inlet', 12, 6)->default(0);
                $table->float('scav_air_receiver', 12, 6)->default(0);
                $table->float('start_air_inlet', 12, 6)->default(0);
                $table->float('main_lub_oil', 12, 6)->default(0);
                $table->float('me_fo_inlet_engine', 12, 6)->default(0);
                $table->float('turbo_charger_speed_no_1', 12, 6)->default(0);
                $table->float('turbo_charger_speed_no_2', 12, 6)->default(0);
                $table->float('turbo_charger_speed_no_3', 12, 6)->default(0);
                $table->float('tachometer_turbocharge', 12, 6)->default(0);
                $table->float('main_engine_speed', 12, 6)->default(0);
                $table->timestamps();
            });
        }
        
        return $model->setTable($tableName);
    }
    
    public function creating(Creating $event)
    {
        $this->id = \Ramsey\Uuid\Uuid::uuid4()->toString();
    }
}
