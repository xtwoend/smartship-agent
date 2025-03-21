<?php


namespace App\Model\Traits;

use App\Model\Tank;
use App\Model\ProcessLog;
use App\Model\CargoDensity;
use App\Model\CargoSounding;
use App\Model\CargoTankCorrection;


trait CargoTankCalculate
{
    // public ?array $tanks = [];

    public function calculate($model)
    {
        // Total Observed Volume = (Volume + (Diff × Unit Decimal)) × Correction Factor
        // Liters = Total Observed Volume × 1000
        // Tonnage (MT) = Density × Total Observed Volume

        $fleetId = $model->fleet_id;
        $correctionTable = CargoTankCorrection::table($fleetId)->get();
        $soundingModel = CargoSounding::table($fleetId);
        $densityModel = new CargoDensity;
        $data = [];
        $cargos = $this->cargoTanks ?? [];

        foreach ($cargos as $tankName => $tank) {
            $tempField = $tank[2]['compare'][0] ?? null;
            if (!$tempField) {
                (new ProcessLog())->table('s')->create([
                    'title' => "Field_Missing_{$fleetId}",
                    'data' => [
                        'tempField' => "Temp field {$tempField} not found for tank: {$fleetId}_{$tankName}"
                    ]
                ]);
            }

            $unit = max(0, round($model->{$tankName} * 100, 1, PHP_ROUND_HALF_EVEN));
            $unitDecimal = round(fmod($unit, 1), 10);
            $unit = round($unit);
            $trim = 0;
            $heel = 0;
            $volCmDiff = 0;
            $temp = round($model->{$tempField} ?? 0);
            $cargoTank = Tank::firstOrCreate(
                ['fleet_id' => $fleetId, 'tank_position' => $tankName],
                [
                    'tank_locator' => $tank[0] == 'port' ? 'P' : 'S', // P|S
                    'type' => 'cargo', // bunker, cargo
                    'mes_type' => $tank[2]['mes_type'], // ullage, level
                    'calc_type' => 'interpolate', // match, interpolate
                ]
            );

            if ($cargoTank->tank_locator === 'S') {
                $fore = $model->draft_fore ?? $model->draft_front ?? 0;
                $after = $model->draft_after ?? $model->draft_rear ?? 0;
                $trim = round($fore - $after, 1, PHP_ROUND_HALF_EVEN);
                $heel = round(($model->draft_center_left ?? 0) - ($model->draft_center_right ?? 0), 1, PHP_ROUND_HALF_EVEN);
            }

            $soundingType = ($cargoTank->mes_type == 'ullage') ? 'ullage' : 'level';

            // Fetch temperature correction factor (default to 1)
            $correctionRow = $correctionTable->where('temp', $temp)->first();
            if (!$correctionRow) {
                (new ProcessLog())->table('s')->create([
                    'title' => "CorrectionRow_Missing_{$fleetId}",
                    'data' => [
                        'tempField' => "correctionRow not found for tank: {$fleetId}_{$tankName}"
                    ]
                ]);
            }
            $correction = $correctionRow?->correction ?? 1;

            // Get volume from sounding table
            $volRow = $soundingModel->where('trim_index', $trim)
                ->where('heel_index', $heel)
                ->where($soundingType, $unit)
                ->first();
            if (!$volRow) {
                $closestTrims = $soundingModel->select('trim_index', 'volume', 'diff')
                    ->where($soundingType, $unit)
                    ->orderByRaw('ABS(trim_index - ?) ASC', [$trim])
                    ->limit(2)
                    ->get();

                // Check if we found two values
                if ($closestTrims->count() < 2) {
                    (new ProcessLog())->table('s')->create([
                        'title' => "CantInterpolate_{$fleetId}",
                        'data' => [
                            'tempField' => "Not enough data points found for interpolation." . json_encode(['closests' => $closestTrims, 'trim' => $trim])
                        ]
                    ]);
                }

                // Sort the trims in ascending order
                $closestTrims = $closestTrims->sortBy('trim');

                // Extract values
                $t1 = $closestTrims[0]->trim_index;
                $v1 = $closestTrims[0]->volume;
                $t2 = $closestTrims[1]->trim_index;
                $v2 = $closestTrims[1]->volume;
                $d2 = $closestTrims[1]->diff;
                if ($t2 !== $t1) {
                    // Perform linear interpolation
                    $volCmDiff = $d2;
                    $vol = $v1 + (($v2 - $v1) / ($t2 - $t1)) * ($trim - $t1);
                    $interpolatedVol = ($volCmDiff * $unitDecimal);
                } else {
                    (new ProcessLog())->table('s')->create([
                        'title' => "CantInterpolate_{$fleetId}",
                        'data' => [
                            'tempField' => "Trim values are the same, cannot interpolate." . json_encode(['closests' => $closestTrims, 'trim' => $trim])
                        ]
                    ]);
                }
            } else {
                $volCmDiff = $volRow?->diff ?? 0;
                $vol = $volRow?->volume ?? 0;
                $interpolatedVol = ($volCmDiff * $unitDecimal);
            }


            // Fetch density (default 1 if missing)
            $densityRow = $densityModel->where('product', $cargoTank->content_type)->first();
            if (!$densityRow) {
                (new ProcessLog())->table('s')->create([
                    'title' => "Density_Row_Missing_{$fleetId}",
                    'data' => [
                        'tempField' => "densityRow not found for tank: {$fleetId}_{$tankName}"
                    ]
                ]);
            }
            $density = $densityRow?->density ?? 1;

            // Calculate observed values
            $totalObservedVol = ($interpolatedVol + $vol) * $correction;
            $tonnageObs = round(($density * $totalObservedVol), 2);

            foreach ($tank[1] as $targetField) {
                if (str_ends_with($targetField, '_mt')) {
                    $data[$targetField] = $tonnageObs;
                }
                if (str_ends_with($targetField, '_ltr')) {
                    $data[$targetField] = round($totalObservedVol * 1000, 2);
                }
                if (str_ends_with($targetField, '_m3')) {
                    $data[$targetField] = round($totalObservedVol, 2);
                }
            }
            // Logging process
            (new ProcessLog())->table('s')->create([
                'title' => "CargoTankCalculate_{$fleetId}_{$cargoTank->id}",
                'data' => [
                    'fleet' => $fleetId,
                    'level' => $unit,
                    'trim' => $trim,
                    'heel' => $heel,
                    'volume_data' => [
                        'raw_volume' => $vol,
                        'diff' => $volCmDiff,
                        'interpolated_volume' => $interpolatedVol,
                        'total_observed_m3' => $totalObservedVol,
                    ],
                    'correction_factor' => $correction,
                    'density' => $density,
                    'calculated_tonnage_MT' => $tonnageObs,
                    'tank' => $tank,
                    'cargo' => $model,
                    'volRow' => $volRow,
                    'densityRow' => $densityRow,
                    'correctionRow' => $correctionRow,
                    'tankRow' => $cargoTank,
                    'model' => $model
                ]
            ]);
        }

        return $data;
    }




    public function calculateBak($model)
    {
        $fleetId = $model->fleet_id;
        // $tabelTank = CargoTankTable::table($fleetId)->get();
        // var_dump($fleetId);
        $correctionTable = CargoTankCorrection::table($fleetId)->get();
        $soundingModel = CargoSounding::table($fleetId);
        $densityModel = new CargoDensity;
        $data = [];

        if (is_null($model->cargos)) return [];

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
            $temp = round($model->{"{$tank->tank_position}_temp"} ?? 0);
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
                if ($tank->height > 0) {
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

            $log = (new ProcessLog())->table('s');
            $log->create([
                'title' => 'CargoTankCalculate_' . $fleetId . '_' . $tank->id,
                'data' => [
                    'fleet' => $fleetId,
                    'level' => $unit,
                    'trim' => $trim,
                    'vol_row' => $volRow,
                    'vol' => $vol,
                    'data' => $data,
                    'tank' => $tank,
                    'cargo' => $model,
                    '$tonnaseObs' => $tonnaseObs,
                    'density' => $density,
                    'densityRow' => $densityRow,
                    '$interpolatedVolume' => $interpolatedVolume,
                    '$soundingType' => $soundingType,
                ]
            ]);
        }

        return $data;
    }
}
