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

use App\Model\ProcessLog;
use App\Model\BunkerSounding;

trait BunkerCapacityCalculate
{
    public function bunkerCalculate($model): array
    {
        $fleetId = $model->fleet_id;
        $soundingModel = BunkerSounding::table($fleetId);
        $data = [];
        // var_dump('BunkerCapacityCalculate', $model, $model->bunkers);

        $bunkers = ($model->bunkers->count() < 1) ? $model->getBunkers() : $model->bunkers;
        foreach ($bunkers as $key => $bunker) {
            // levels are in M, convert to CM
            $level = $model->{$bunker->tank_position} * 100;
            $level = round($level, 0, PHP_ROUND_HALF_EVEN);
            $level = $level < 0 ? 0 : $level;
            $trim = 0;
            $volRow = null;
            if ($bunker->tank_locator === 'S') {
                $fore = $model->draft_fore ?? $model->draft_front ?? 0;
                $after = $model->draft_after ?? $model->draft_rear ?? 0;
                $trim = $this->customRound($fore - $after);
                if (!$volRow = $soundingModel->where('tank_id', $bunker->id)->where('trim_index', $trim)->where('sounding_cm', $level)->first()) {
                    $closestTrims = $soundingModel->select('trim_index', 'volume')
                        ->where('sounding_cm', $level)
                        ->orderByRaw('ABS(trim_index - ?) ASC', [$trim])
                        ->limit(2)
                        ->get();
                    if ($closestTrims->count() == 2) {
                        $diff1 = abs($trim - $closestTrims[0]->trim_index);
                        $diff2 = abs($trim - $closestTrims[1]->trim_index);
                        if ($diff1 < $diff2) {
                            // Round the first closest trim to the nearest integer using round half down
                            $trim = round($closestTrims[0]->trim_index, 0, PHP_ROUND_HALF_DOWN);
                        } else {
                            // Round the second closest trim to the nearest integer using round half down
                            $trim = round($closestTrims[1]->trim_index, 0, PHP_ROUND_HALF_DOWN);
                        }
                    }
                    if ($closestTrims->count() == 1) {
                        $trim = $closestTrims[0]->trim_index;
                    }
                }
            }
            if(!$volRow) {
                $volRow = $soundingModel->where('tank_id', $bunker->id)->where('trim_index', $trim)->where('sounding_cm', $level)->first();
            }
            $vol = $volRow?->volume ?? 0;
            $data["{$bunker->tank_position}_m3"] = $vol;
            if ($bunker->tank_locator === 'S' || $bunker->tank_locator === 'P') {
                $data["{$bunker->tank_position}_ltr"] = $vol * 1000;
                $data["{$bunker->tank_position}_mt"] = $vol * ($bunker->content_type === 'MDO' ? BunkerSounding::DENSITY_MDO : BunkerSounding::DENSITY_HFO);
            }
            $log = (new ProcessLog())->table('s');
            $log->create([
                'title' => 'BunkerCapacityCalculate_' . $fleetId . '_' . $bunker->id,
                'data' => [
                    'fleet' => $fleetId,
                    'level' => $level,
                    'trim' => $trim,
                    'vol_row' => $volRow,
                    'vol' => $vol,
                    'data' => $data,
                    'bunker' => $bunker,
                    'cargo' => $model,
                ]
            ]);
        }
        return $data;
    }
    private function customRound($value)
    {
        $decimalPart = $value - floor($value);

        if ($decimalPart <= 0.4) {
            return floor($value);
        } elseif ($decimalPart == 0.5) {
            return $value;
        } else {
            return ceil($value);
        }
    }
}
