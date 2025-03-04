<?php


namespace App\Model\Traits;

use App\Model\CargoDensity;
use App\Model\CargoSounding;
use App\Model\CargoTankTable;
use App\Model\CargoTankCorrection;
use Hyperf\Database\Model\Events\Creating;


trait CargoTankCalculate
{
    // public ?array $tanks = [];

    public function calculate($model)
    {
        $fleetId = $model->fleet_id;
        // $tabelTank = CargoTankTable::table($fleetId)->get();
        // var_dump($fleetId);
        $correctionTable = CargoTankCorrection::table($fleetId)->get();
        $soundingModel = CargoSounding::table($fleetId);
        $densityModel = new CargoDensity;
        $data = [];
        $cargos = ($model->cargos->count() < 1) ? $model->getCargos() : $model->cargos;
        foreach ($cargos as $key => $tank) {
            // $ullage = $model->{$tank[0]};
            // $ullage = $ullage < 0 ? 0 : $ullage;

            // $temp = $model->{$tank[1]};
            // $volRow = $tabelTank->where('tank_position', $tank[0])->where('ullage', $ullage)->first();
            // tank position

            // $correctionRow = $tabelCorrection->where('temp', $temp)->first();
            // $vol = $volRow?->volume ?? 0;
            // $correction = $correctionRow?->correction ?? 0;
            // $total_obs = $vol * $correction;

            // $data[$key] = $total_obs;

            // ullage are in M, convert to CM
            $unit = max(0, round($model->{$tank->tank_position} * 100, 1, PHP_ROUND_HALF_EVEN));
            $unitDecimal = round(fmod($unit, 1), 10);
            $unit = round($unit);
            $trim = 0;
            $diff = 0;
            $temp = round($model->{"{$tank->tank_position}_temp"}??0);
            // check another field type
            $levelToTemp = str_ireplace('level_', 'temp_', $tank->tank_position);
            if (isset($model->{$levelToTemp})) {
                $temp = round($model->{$levelToTemp});
            }
            if ($tank->tank_locator === 'S') {
                $fore = $model->draft_fore ?? $model->draft_front ?? 0;
                $after = $model->draft_after ?? $model->draft_rear ?? 0;
                $trim = round($fore - $after, 1, PHP_ROUND_HALF_EVEN);
            }
            $heel = round($model->draft_center_left - $model->draft_center_right, 1, PHP_ROUND_HALF_EVEN);

            $soundingType = 'ullage';
            if ($tank->mes_type == 'level') {
                if($tank->height > 0)  {
                    $unit = $tank->height - $unit;
                }
                $soundingType = 'level';
            }
            $interpolatedVolume = 0;
            $correctionRow = $correctionTable->where('temp', $temp)->first();
            $correction = $correctionRow?->correction ?? 1;

            // if ($tank->calc_type != 'match') {
            //     $volRow = $soundingModel->where('trim_index', 0)->where('heel_index', 0)->where($soundingType, $unit)->first();
            //     $diff = $volRow?->diff ?? 0;
            //     $vol = $volRow?->volume ?? 0;
            //     $interpolatedVolume = ($diff * $unitDecimal);
            // } else {
            //     $volRow = $soundingModel->where('tank_id', $tank->id)->where('trim_index', $trim)->where('heel_index', $heel)->where($soundingType, $unit)->first();
            //     $vol = $volRow?->volume ?? 0;
            // }
            $volRow = $soundingModel->where('trim_index', 0)->where('heel_index', 0)->where($soundingType, $unit)->first();
            $diff = $volRow?->diff ?? 0;
            $vol = $volRow?->volume ?? 0;
            $interpolatedVolume = ($diff * $unitDecimal);

            // $totalObs = round( (($interpolatedVolume + $vol) * $correction), 0, PHP_ROUND_HALF_UP );
            $totalObs = ($interpolatedVolume + $vol) * $correction;

            $densityRow = $densityModel->where('product', $tank->content_type)->first();
            $density = $densityRow?->density ?? 1;
            $tonnaseObs = ($density * $totalObs);
            $data["{$tank->tank_position}_ltr"] = ($totalObs * 1000);
            $data["{$tank->tank_position}_mt"] = $tonnaseObs;

            // if($tank->tank_position == 'level_cot_1p') {
            //     var_dump(json_encode([
            //         'data' => $data,
            //         'densityRow' => $densityRow,
            //         'correctionRow' => $correctionRow,
            //         'tank' => $tank,
            //         'volRow' => $volRow,
            //         'trim' => $trim,
            //         'heel' => $heel,
            //         'unit' => $unit,
            //         'density' => $density,
            //         'correction' => $correction,
            //         'vol' => $vol,
            //         'totalObs' => $totalObs,
            //         'interpolatedVolume' => $interpolatedVolume,
            //         'soundingType' => $soundingType,
            //         'temp' => $temp,
            //         'diff' => $diff,
            //         'unitdecimal' => $unitDecimal,
            //         '$tank->calc_type' => $tank->calc_type,
            //     ], JSON_PRETTY_PRINT));
            // }
        }

        return $data;
    }
}