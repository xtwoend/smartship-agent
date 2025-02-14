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
namespace App\Model\Traits;

use App\Model\CargoTankSounding;

trait BunkerCapacityCalculate
{
    public function bunkerCalculate($model): array
    {
        $fleetId = $model->fleet_id;
        $soundingModel = CargoTankSounding::table($fleetId);
        $data = [];
        $bunkers = ($model->bunkers->count() < 1) ? $model->getBunkers($model) : $model->bunkers;
        foreach($bunkers as $key => $bunker) {
            $level = floor($model->{$bunker->tank_position});
            $level = $level < 0 ? 0 : $level;
            
            $trim = 0;
            if($bunker->tank_locator === 'S') {
                $trim = ceil($model->draft_front - $model->draft_rear );
            }
            $vol = $soundingModel->where('tank_id', $bunker->id)->where('trim_index', $trim)->where('sounding_cm', $level)->first();
            $vol = $vol?->volume ?? 0;
            $data["{$bunker->tank_position}_m3"] = $vol;
            
        }
        return $data;
    }
}
