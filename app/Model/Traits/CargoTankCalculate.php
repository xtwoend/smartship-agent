<?php


namespace App\Model\Traits;

use App\Model\CargoDensity;
use App\Model\CargoSounding;
use App\Model\CargoTankCorrection;


trait CargoTankCalculate
{
    // public ?array $tanks = [];

    public function calculate($model)
    {
        $fleetId = $model->fleet_id;
        $correctionTable = CargoTankCorrection::table($fleetId)->get();
        $soundingModel = CargoSounding::table($fleetId);
        $densityModel = new CargoDensity;
        $data = [];
        $cargos = ($model->cargos->count() < 1) ? $model->getCargos() : $model->cargos;
        foreach ($cargos as $key => $tank) {

            // ullage are in M, convert to CM
            $unit = max(0, round($model->{$tank->tank_position} * 100, 1, PHP_ROUND_HALF_EVEN));
            $unitDecimal = round(fmod($unit, 1), 10);

            $trim = 0;
            $heel = 0;
            $correction = 1;
            $temp = round(($model->{"{$tank->tank_position}_temp"} ?? 0));
            $hasDraft = (isset($model->draft_fore) || isset($model->draft_rear) || isset($model->draft_center_left) || isset($model->draft_center_right)) ? true : false;

            if ($hasDraft) {
                // if ($tank->tank_locator === 'S') {
                $fore = $model->draft_fore ?? $model->draft_front ?? 0;
                $after = $model->draft_after ?? $model->draft_rear ?? 0;
                $trim = round($fore - $after, 1, PHP_ROUND_HALF_EVEN);

                // }
                $heel = round($model->draft_center_left - $model->draft_center_right, 1, PHP_ROUND_HALF_EVEN);
            }
            if ($tank->mes_type == 'level' && $tank->height > 0) {
                $unit = $tank->height - $unit;
            }
            $unit = round($unit);
            $interpolatedVolume = 0;
            if ($temp > 0) {
                $correctionRow = $correctionTable->where('temp', $temp)->first();
                $correction = $correctionRow?->correction ?? 1;
            }

            if ($tank->calc_type != 'match') {
                $volRow = $soundingModel->where('trim_index', 0)->where('heel_index', 0)->where('ullage', $unit)->first();
                $diff = $volRow?->diff ?? 0;
                $vol = $volRow?->volume ?? 0;
                $interpolatedVolume = ($diff * $unitDecimal);
            } else {
                $volRow = $soundingModel->where('tank_id', $tank->id)->where('trim_index', $trim)->where('heel_index', $heel)->where('ullage', $unit)->first();
                $vol = $volRow?->volume ?? 0;
            }

            $totalObs = ($interpolatedVolume + $vol) * $correction;

            $densityRow = $densityModel->where('product', $tank->content_type)->first();
            $tonnaseObs = null;
            if ($densityRow) {
                $density = $densityRow?->density ?? 1;
                $tonnaseObs = ($density * $totalObs);
            }

            $data["{$tank->tank_position}_ltr"] = ($totalObs * 1000);
            $data["{$tank->tank_position}_mt"] = $tonnaseObs;
        }

        return $data;
    }
}
