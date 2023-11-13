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
class FleetDailyReport extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'fleet_daily_reports';

    /**
     * timestamps false
     */
    public bool $timestamps = false;

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = ['fleet_id', 'date', 'sensor', 'value'];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = [
        'date' => 'date'
    ];

    public static function table($fleetId, $date = null)
    {
        $date = is_null($date) ? date('Ym'): Carbon::parse($date)->format('Ym');
        $model = new self;
        $tableName = $model->getTable() . "_{$fleetId}_{$date}";
        
        if(! Schema::hasTable($tableName)) {
            Schema::create($tableName, function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('fleet_id')->index();
                $table->date('date')->unique();
                $table->string('sensor')->nullable();
                $table->string('value')->nullable();
                // $table->timestamps();
            });
        }
        
        return $model->setTable($tableName);
    }
}
