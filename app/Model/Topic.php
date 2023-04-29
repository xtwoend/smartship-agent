<?php

declare(strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

/**
 */
class Topic extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'topics';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [
        'name', 'topic', 'last_received'
    ];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = [];
}
