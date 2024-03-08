<?php

declare(strict_types=1);

namespace App\Model;

use Hyperf\Database\Schema\Schema;
use Hyperf\DbConnection\Model\Model;
use Hyperf\Database\Schema\Blueprint;

/**
 */
class CargoTankCorrection extends Model
{
    /**
     * disable timestamps.
     */
    public bool $timestamps = false;

    /**
     * The table associated with the model.
     */
    protected ?string $table = 'cargo_tank_correction';

    /**
     * The attributes that are mass assignable.
     */
    protected array $guarded = ['id'];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = [];

    public static function table($fleetId)
    {
        $model = new self();
        $tableName = $model->getTable() . "_{$fleetId}";

        if (! Schema::hasTable($tableName)) {
            Schema::create($tableName, function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('fleet_id')->index();
                $table->float('temp', 3, 1)->nullable();
                $table->float('correction', 8, 7)->default(0);
            });
        }

        return $model->setTable($tableName);
    }
}
