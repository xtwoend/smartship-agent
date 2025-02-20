<?php


namespace App\Model\Traits;

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
        // $tabelCorrection = CargoTankCorrection::table($fleetId)->get();
        $soundingModel = CargoSounding::table($fleetId);
        $data = [];
        $cargos = ($model->cargos->count() < 1) ? $model->getCargos() : $model->cargos;
        foreach($cargos as $key => $tank) {
            // $ullage = $model->{$tank[0]};
            // $ullage = $ullage < 0 ? 0 : $ullage;

            // $temp = $model->{$tank[1]};
            // $volRow = $tabelTank->where('tank_position', $tank[0])->where('ullage', $ullage)->first();
            // $correctionRow = $tabelCorrection->where('temp', $temp)->first();
            // $vol = $volRow?->volume ?? 0;
            // $correction = $correctionRow?->correction ?? 0;
            // $total_obs = $vol * $correction;

            // $data[$key] = $total_obs;

            // ullage are in M, convert to CM
            $ullage = $model->{$tank->tank_position} * 100;
            $ullage = round($ullage, 3, PHP_ROUND_HALF_EVEN);
            $ullage = $ullage < 0 ? 0 : $ullage;
            $trim = 0;
            if ($tank->tank_locator === 'S') {
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
            $vol = $soundingModel->where('tank_id', $tank->id)->where('trim_index', $trim)->where('sounding_cm', $ullage)->first();
            $vol = $vol?->mt ?? 0;
            $data["{$tank->tank_position}_mt"] = $vol;
        }

        return $data;
    }
}
