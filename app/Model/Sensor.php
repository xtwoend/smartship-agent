<?php

declare(strict_types=1);

namespace App\Model;

use App\Model\Fleet;
use Hyperf\DbConnection\Model\Model;

/**
 */
class Sensor extends Model
{
    protected array $guarded = ['id'];
    
    public function fleet() 
    {
        return $this->belongsTo(Fleet::class, 'fleet_id');
    }
}
