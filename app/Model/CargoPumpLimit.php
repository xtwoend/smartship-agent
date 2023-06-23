<?php

declare(strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

/**
 */
class CargoPumpLimit extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'cargo_pump_limits';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = [];

    /**
     * fleets
     */
    public function fleet()
    {
        return $this->belongsTo(Fleet::class, 'fleet_id');
    }
}
