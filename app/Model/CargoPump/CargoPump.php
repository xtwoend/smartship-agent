<?php

declare(strict_types=1);

namespace App\Model\CargoPump;

use Hyperf\DbConnection\Model\Model;

class CargoPump extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'cargo_pump';

    /**
     * The connection name for the model.
     */
    protected ?string $connection = 'default';

    // create table cargo if not found table
    public static function table($fleetId)
    {
        $model = new self;
        $tableName = $model->getTable() . "_{$fleetId}";

        return $model->setTable($tableName);
    }
}
