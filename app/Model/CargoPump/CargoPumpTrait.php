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
namespace App\Model\CargoPump;

trait CargoPumpTrait
{
    public function setCargoPump($model, array $data)
    {
        if (isset($data['cargo_pump'])) {
            $model = (new $model())->table($this->id);
            $log = $model->updateOrCreate([
                'fleet_id' => $this->id,
            ], $data['cargo_pump']);

            $this->logger('cargo_pump', $log);

            return $log;
        }
    }
}
