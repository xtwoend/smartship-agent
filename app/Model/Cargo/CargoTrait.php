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

namespace App\Model\Cargo;

use App\Model\Tank;

trait CargoTrait
{
    public function setCargo($model, array $data)
    {
        // var_dump('CargoTrait->Model', $model);
        // var_dump('CargoTrait->data', $data);
        if (isset($data['cargo'])) {
            $model = (new $model())->table($this->id);
            $log = $model->updateOrCreate([
                'fleet_id' => $this->id,
            ], $data['cargo']);

            $this->logger('cargo', $log);

            return $log;
        }
    }
    public function bunkers()
    {
        return $this->hasMany(Tank::class, 'fleet_id', 'fleet_id')->where('type', Tank::TYPE_BUNKER);
    }
    public function cargos()
    {
        return $this->hasMany(Tank::class, 'fleet_id', 'fleet_id')->where('type', Tank::TYPE_CARGO);
    }

    public function getBunkers()
    {
        return $this->getTanks(Tank::TYPE_BUNKER, $this->bunkerTanks);
    }
    public function getCargos()
    {
        return $this->getTanks(Tank::TYPE_CARGO, $this->cargoTanks);
    }
    private function getTanks(string $type, array $initialData = [])
    {
        foreach ($initialData as $tank) {
            Tank::firstOrCreate([
                'fleet_id' => $this->fleet_id,
                'type' => $type,
                'tank_position' => $tank[0],
            ], [
                'tank_locator' => ($tank[1] === 'stb') ? 'S' : 'P',
            ]);
        }
        return Tank::where('fleet_id', $this->fleet_id)->where('type', $type)->get();
    }
}
