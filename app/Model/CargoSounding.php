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

class CargoSounding extends Model
{
    /**
     * disable timestamps.
     */
    public bool $timestamps = false;

    /**
     * The table associated with the model.
     */
    protected ?string $table = 'tank_sounding_cargo';

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
                $table->unsignedBigInteger('fleet_id');
                $table->unsignedBigInteger('tank_id')->index();
                $table->float('trim_index', 10, 3)->index()->nullable()->default(NULL);
                $table->float('heel_index', 10, 3)->index()->nullable()->default(NULL); // (-) = port, 0 = no heel, (+) = stb
                $table->unsignedInteger('mes_type')->index(); // level and ullage
                $table->unsignedInteger('unit')->index(); // level or ullage value
                $table->float('value', 10, 3)->nullable();
                $table->float('diff', 10, 3)->nullable()->default(NULL);
                $table->timestamps();
            });
        }

        return $model->setTable($tableName);
    }
}
