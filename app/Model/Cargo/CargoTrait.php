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

use App\Model\ProcessLog;
use App\Model\Tank;

trait CargoTrait
{
    public function setCargo($model, array $data)
    {
        // var_dump('CargoTrait->Model', $model);
        // var_dump('CargoTrait->data', $data);
        if (isset($data['cargo'])) {
            // $log = ( new ProcessLog())->table('s');
            // $log->create([
            //     'title' => 'CargoTrait',
            //     'data' => [
            //         'fleet_id' => $this->id,
            //         'cargo' => $data['cargo'],
            //     ]
            // ]);
            $model = (new $model())->table($this->id);
            // var_dump([
            //     'CargoTrait' => get_class($model),
            //     'fleet_id' => $this->id,
            //     'cargo' => $data['cargo'],
            // ]);
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
        foreach ($initialData as $tank=>$payload) {
            $meta = (isset($payload[2]) && is_array($payload[2])) ? $payload[2] : [];
            Tank::firstOrCreate([
                'fleet_id' => $this->fleet_id,
                'type' => $type,
                'tank_position' => $tank,
            ], [
                'tank_locator' => ($payload[0] === 'stb') ? 'S' : 'P',
                'content_type' => (isset($meta['content']) && !empty($meta['content'])) ? $meta['content'] : null,
                'mes_type' => (isset($meta['mes_type']) && $meta['mes_type'] === 'ullage') ? 'ullage' : 'level',
            ]);
        }
        return Tank::where('fleet_id', $this->fleet_id)->where('type', $type)->get();
    }
    public function tablePayloadBuilder($model): array
    {
        $source = array_merge($model->cargoTanks, $model->bunkerTanks);
        $payload = [];

        foreach ($source as $tankField => $src) {
            foreach ($src[1] ?? [] as $key => $newField) {
                if (is_array($newField)) {
                    foreach($newField as $nf => $nfItem) {
                        $payload[] = [
                            'type' => 'float',
                            'name' => $nf,
                            'after' => $tankField,
                        ];
                    }
                } else {
                    $payload[] = [
                        'type' => 'float',
                        'name' => $newField,
                        'after' => $tankField,
                    ];
                }
            }
        }
        return $payload;
    }
}
