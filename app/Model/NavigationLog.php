<?php

declare(strict_types=1);

namespace App\Model;

use Carbon\Carbon;
use App\Model\FleetDailyReport;
use Hyperf\Database\Schema\Schema;
use Hyperf\DbConnection\Model\Model;
use App\Model\Alarm\SensorAlarmTrait;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Model\Events\Created;
use Hyperf\Database\Model\Events\Creating;

/**
 */
class NavigationLog extends Model
{
    use SensorAlarmTrait;
    
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'navigation_log';
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

    public function fleet()
    {
        return $this->belongsTo(Fleet::class, 'fleet_id');
    }
    
    public static function table($fleetId, $date = null)
    {
        $date = is_null($date) ? date('Ym'): Carbon::parse($date)->format('Ym');
        $model = new self;
        $tableName = $model->getTable() . "_{$fleetId}_{$date}";
        
        if(! Schema::hasTable($tableName)) {
            Schema::create($tableName, function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->unsignedBigInteger('fleet_id')->index();
                $table->datetime('terminal_time')->unique();
                $table->float('wind_speed')->default(0);
                $table->float('wind_direction')->default(0);
                $table->float('lat', 15, 6)->default(0);
                $table->string('lat_dir')->nullable();
                $table->float('lng', 15, 6)->default(0);
                $table->string('lng_dir')->nullable();
                $table->string('datum_refrence')->nullable();
                $table->float('sog')->default(0);
                $table->float('cog')->default(0);
                $table->float('total_distance')->default(0);
                $table->float('distance')->default(0);
                $table->float('heading')->default(0);
                $table->float('rot')->default(0);
                $table->float('depth')->default(0);
                $table->timestamps();
            });
        }
        
        return $model->setTable($tableName);
    }
    
    public function creating(Creating $event)
    {
        $this->id = \Ramsey\Uuid\Uuid::uuid4()->toString();
    }

    /**
     * create by sistem
     */
    public function navigationDailyReport($model) 
    {
         
        $now = Carbon::now();
        $fdr = FleetDailyReport::table($model->fleet_id)->where([
            'fleet_id' => $model->fleet_id,
            'date' => $now->format('Y-m-d'),
            'sensor' => 'distance'
        ])->first();
        
        if(! $fdr) {
            $fdr = FleetDailyReport::table($model->fleet_id);
            $fdr->fleet_id = $model->fleet_id;
            $fdr->date = $now->format('Y-m-d');
            $fdr->sensor = 'distance';
            $fdr->before = $model->total_distance;
        }

        $fdr->after = $model->total_distance;
        $fdr->value = ($fdr->after - $fdr->before);
        $fdr->save();
    }
}
