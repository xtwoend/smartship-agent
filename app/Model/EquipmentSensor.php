<?php

declare(strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

/**
 */
class EquipmentSensor extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'equipment_sensors';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [
        'equipment_id', 'sensor_id', 'mode', 'avg_value', 'performance', 'abnormal_count', 'total_value', 'count_value', 'sensor_trigger', 'sensor_trigger_value'
    ];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = [];

    /**
     * treshold
     */
    public function treshold() {
        $this->belongsTo(Sensor::class, 'sensor_id');
    }
}
