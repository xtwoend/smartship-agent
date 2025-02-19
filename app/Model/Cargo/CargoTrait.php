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

    public function getBunkers($model)
    {
        foreach($this->bunkerTanks as $k => $bunker) {
            Tank::firstOrCreate([
                'fleet_id' => $this->fleet_id,
                'type' => Tank::TYPE_BUNKER,
                'tank_position' => $bunker[0],
            ], [
                'tank_locator' => ($bunker[1] === 'stb') ? 'S' : 'P',
            ]);
        }
        return Tank::where('fleet_id', $this->fleet_id)->where('type', Tank::TYPE_BUNKER)->get();
    }
}
