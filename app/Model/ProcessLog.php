<?php

declare(strict_types=1);

namespace App\Model;

use Hyperf\Database\Schema\Schema;
use Hyperf\DbConnection\Model\Model;
use Hyperf\Database\Schema\Blueprint;

/**
 */
class ProcessLog extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'process_logs';

    /**
     * The attributes that are mass assignable.
     */
    protected array $guarded = ['id'];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = [
        'data' => 'array'
    ];

    public static function table()
    {
        $model = new self();
        $tableName = $model->getTable() . '_' . date('ymd');

        if (! Schema::hasTable($tableName)) {
            Schema::create($tableName, function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('title')->index();
                $table->longtext('data');
                $table->timestamps();
            });
        }
        return $model->setTable($tableName);
    }
}
