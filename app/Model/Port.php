<?php

declare(strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

/**
 */
class Port extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'ports';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [
        'name', 'location', 'lat', 'lng'
    ];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = [];
}
