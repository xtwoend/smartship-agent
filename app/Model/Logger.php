<?php

declare(strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;
use Hyperf\Database\Model\Events\Creating;

/**
 */
class Logger extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'loggers';

    public bool $incrementing = false;
    protected string $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [
        'topic', 'message', 'sync'
    ];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = [
        'sync' => 'boolean'
    ];

    public function creating(Creating $event)
    {
        $this->id = \Ramsey\Uuid\Uuid::uuid4()->toString();
    }
}
