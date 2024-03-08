<?php


namespace App\Model\Traits;

use App\Model\CargoTankTable;
use App\Model\CargoTankCorrection;
use Hyperf\Database\Model\Events\Creating;


trait CargoTankCalculate
{
    // public ?array $tanks = [];

    public function calculate($model)
    {
        $fleetId = $model->fleet_id;
        $tabelTank = CargoTankTable::table($fleetId)->get();
        $tabelCorrection = CargoTankCorrection::table($fleetId)->get();
        $data = [];
        foreach($this->tanks as $key => $tank) {
            $ullage = $model->{$tank[0]};
            $temp = $model->{$tank[1]};
            $volRow = $tabelTank->where('tank_position', $tank[0])->where('ullage', $ullage)->first();
            $correctionRow = $tabelCorrection->where('temp', $temp)->first();
            $vol = $volRow?->volume ?? 0;
            $correction = $correctionRow?->correction ?? 0;
            
            $total_obs = $vol * $correction;

            $data[$key] = $total_obs;
        }

        return $data;
    }

    // public function creating(Creating $event)
    // {
    //     $model = $event->getModel();

    //     $data = $this->calculate($model);

    //     foreach($data as $key => $val) {
    //         $this->{$key} = $val;
    //     }
    // }
}
