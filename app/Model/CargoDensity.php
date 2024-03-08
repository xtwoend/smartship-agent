<?php

declare(strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

/**
 */
class CargoDensity extends Model
{
    /**
     * disable timestamps.
     */
    public bool $timestamps = false;

    /**
     * The table associated with the model.
     */
    protected ?string $table = 'cargo_density';

    /**
     * The attributes that are mass assignable.
     */
    protected array $guarded = ['id'];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = [];

    
}
