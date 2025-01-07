<?php

declare(strict_types=1);

namespace App\Model\Engine;

use Carbon\Carbon;
use Hyperf\Database\Schema\Schema;
use Hyperf\DbConnection\Model\Model;
use App\Model\Engine\EngineFormColumn;

class EngineLog extends Model
{
    use EngineFormColumn;
    
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'engine_log';

    /**
     * The connection name for the model.
     */
    protected ?string $connection = 'default';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = [];

    // create table cargo if not found table
    public static function table($fleetId, $date = null)
    {
        $date = is_null($date) ? date('Ym') : Carbon::parse($date)->format('Ym');
        $model = new self();
        $tableName = $model->getTable() . "_{$fleetId}_{$date}";

        if (Schema::hasTable($tableName)) {
            $model->addColumn($tableName, $model);
        }

        return $model->setTable($tableName);

    }
}
