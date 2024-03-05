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

use Hyperf\DbConnection\Model\Model;

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
