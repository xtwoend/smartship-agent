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
        foreach($this->tanks as $key => $tank) {
            $level = floor($model->{$key});
            $level = $level < 0 ? 0 : $level;
            $trim = 0;
            if($tank[1] == 'stb') {
                $trim = ceil($model->draft_front - $model->draft_rear );
            }
            $vol = $soundingModel->where('tank_position', $key)->where('trim_index', $trim)->where('sounding_cm', $level)->first();
            $vol = $volRow?->volume ?? 0;
            $data[$key] = $vol->volume;
        }

        return $data;
    }
}
