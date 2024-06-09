<?php

declare(strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

/**
 */
class Equipment extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'equipments';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [
        'fleet_id', 'name', 'group', 'last_maintenance', 'schedule_maintenance', 'next_maintenance', 'score', 'condition', 'degradation_factor', 'lifetime_hours', 'predicted_time_repair', 'difference_lifetime'
    ];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = [];
}
