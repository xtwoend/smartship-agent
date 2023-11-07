<?php

declare(strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

/**
 */
class FleetStatusDuration extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'fleet_status_duration';

    /**
     * The attributes that are mass assignable.
     */
    protected array $guarded = ['id'];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = [];

    /**
     * relation to fleet
     */
    public function fleet() {
        return $this->belongsTo(Fleet::class, 'fleet_id');
    }
}
