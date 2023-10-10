<?php

declare(strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

/**
 */
class MqttLog extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'mqtt_logs';

    /**
     * The attributes that are mass assignable.
     */
    protected array $guarded = ['id'];
}
