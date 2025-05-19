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
namespace App\Listener;

use Carbon\Carbon;
use App\Model\Fleet;
use Hyperf\Redis\Redis;
use App\Event\MQTTReceived;
use Hyperf\Event\Annotation\Listener;
use Psr\Container\ContainerInterface;
use Hyperf\Event\Contract\ListenerInterface;

#[Listener]
class MQTTCargoListener implements ListenerInterface
{
    protected $redis;

    public function __construct(protected ContainerInterface $container)
    {
        $this->redis = $container->get(Redis::class);
    }

    public function listen(): array
    {
        return [
            MQTTReceived::class,
        ];
    }

    public function process(object $event): void
    {
        if ($event instanceof MQTTReceived) {
            $data = $event->data;
            $fleet = $event->device?->fleet;
            $device = $event->device;

            $fleetId = $fleet->id;

            $lockerKey = 'FLEET_CARGO_' . $fleetId;

            if(! $this->redis->get($lockerKey)) { 
                
                $this->redis->set($lockerKey, 1);
                $this->redis->expire($lockerKey, (60 * 5)); // set per 5 menit

                if ($fleet) {
                    if (key_exists('cargo', $data)) {
                        // var_dump('cargo', $data);
                        $model = $device->log_model;
                        if (class_exists($model)) {
                            // var_dump($model);
                            $v = Fleet::find($fleet->id);
                            $v->setCargo($model, $data);
                        }
                    }
                }
            }
        }
    }
}
