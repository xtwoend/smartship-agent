<?php

declare(strict_types=1);

namespace App\Model;

use Carbon\Carbon;
use App\Model\Vessel;
use Hyperf\Database\Schema\Schema;
use Hyperf\DbConnection\Model\Model;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Model\Events\Creating;

/**
 */
class Logger extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'loggers';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [
        'vessel_id', 'terminal_time', 'group', 'data'
    ];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = [
        'data' => 'array',
        'terminal_time' => 'datetime:Y-m-d H:i:s'
    ];

    public function vessel()
    {
        return $this->belongsTo(Vessel::class, 'vessel_id');
    }
    
    public static function table($vesselId, $date = null)
    {
        $date = is_null($date) ? date('Ym'): Carbon::parse($date)->format('Ym');
        $model = new self;
        $tableName = $model->getTable() . "_{$vesselId}_{$date}";
        
        if(! Schema::hasTable($tableName)) {
            Schema::create($tableName, function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->unsignedBigInteger('vessel_id')->index();
                $table->datetime('terminal_time')->unique()->index();
                $table->string('group')->index(); // vdr, ccr, ecr
                $table->json('data')->nullable();
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
