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
namespace App\Model;

use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Schema\Schema;
use Hyperf\DbConnection\Model\Model;

class FleetDailyReport extends Model
{
    /**
     * timestamps false.
     */
    public bool $timestamps = false;

    /**
     * The table associated with the model.
     */
    protected ?string $table = 'fleet_daily_reports';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = ['fleet_id', 'date', 'sensor', 'before', 'after', 'value'];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = [
        'date' => 'date',
    ];

    public static function table($fleetId)
    {
        $model = new self();
        $tableName = $model->getTable() . "_{$fleetId}";

        if (! Schema::hasTable($tableName)) {
            Schema::create($tableName, function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('fleet_id')->index();
                $table->date('date');
                $table->string('sensor')->nullable();
                $table->float('before', 15, 3)->nullable();
                $table->float('after', 15, 3)->nullable();
                $table->float('value', 15, 3)->nullable();

                $table->index(['date', 'sensor'], 'index_date_sensor');
            });
        }

        return $model->setTable($tableName);
    }
}
