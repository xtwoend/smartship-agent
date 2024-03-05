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
namespace App\Model\Engine;

trait EngineTrait
{
    public function setEngine($model, array $data)
    {
        if (isset($data['engine'])) {
            $model = (new $model())->table($this->id);

            $log = $model->updateOrCreate([
                'fleet_id' => $this->id,
            ], $data['engine']);

            $this->logger('engine', $log);

            return $log;
        }
    }
}
