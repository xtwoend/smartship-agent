<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace App\Model;

use Hyperf\DbConnection\Model\Model;
use App\Model\Traits\HasColumnTrait;

class Tank extends Model
{
    use HasColumnTrait;

    const TYPE_BUNKER = 'bunker';
    const TYPE_CARGO = 'cargo';
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'tanks';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [
        'fleet_id',
        'tank_position', // name from sensor
        'tank_locator', // P|S
        'contents',
        'content_type', // (product) HFO, MDO, AVTUR
        'capacity',
        'type', // bunker, cargo
        'mes_type', // ullage, level
        'height', // tank height
        'calc_type', // match, interpolate
    ];

}
