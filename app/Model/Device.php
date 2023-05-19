<?php

declare(strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

/**
 */
class Device extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'devices';

    /**
     * The attributes that are mass assignable.
     */
    protected array $guarded = ['id'];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = [
        'last_connected' => 'datetime'
    ];

    /**
     * scope active
     */
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    /**
     * Fleet
     */
    public function Fleet()
    {
        return $this->belongsTo(Fleet::class, 'fleet_id');
    }
}
