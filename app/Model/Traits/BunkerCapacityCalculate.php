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
        // var_dump('BunkerCapacityCalculate', $model, $model->bunkers);

        $bunkers = ($model->bunkers->count() < 1) ? $model->getBunkers($model) : $model->bunkers;
        foreach ($bunkers as $key => $bunker) {
            // levels are in M, convert to CM
            $level = $model->{$bunker->tank_position} * 100;
            $level = round($level, 3, PHP_ROUND_HALF_EVEN);
            $level = $level < 0 ? 0 : $level;
            $trim = 0;
            if ($bunker->tank_locator === 'S') {
                $fore = 0;
                $after = 0;
                if($model->draft_front) {
                    $fore = $model->draft_front;
                }
                if($model->draft_rear) {
                    $after = $model->draft_rear;
                }
                if($model->draft_fore) {
                    $fore = $model->draft_fore;
                }
                if($model->draft_after) {
                    $after = $model->draft_after;
                }
                $trim = round(($fore - $after), 1, PHP_ROUND_HALF_EVEN);
            }
            $vol = $soundingModel->where('tank_id', $bunker->id)->where('trim_index', $trim)->where('sounding_cm', $level)->first();
            $volId = $vol->id ?? -1;
            $vol = $vol?->volume ?? 0;
            $data["{$bunker->tank_position}_m3"] = $vol;
        }
        return $data;
    }
}
