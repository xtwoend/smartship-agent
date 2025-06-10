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

use App\Event\MQTTReceived;
use Carbon\Carbon;
use Hyperf\Event\Annotation\Listener;
use Hyperf\Event\Contract\ListenerInterface;
use Psr\Container\ContainerInterface;

#[Listener]
class MQTTReceivedDataListener implements ListenerInterface
{
    protected $redis;

    public function __construct(protected ContainerInterface $container)
    {
        $this->redis = $container->get(\Hyperf\Redis\Redis::class);
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
            $fleet = $event->device?->fleet;
            $fleetId = $fleet->id;
            $lockerKey = 'FLEET_NAV_STATUS_' . $fleetId;

            if(! $this->redis->get($lockerKey)) { 
                
                $this->redis->set($lockerKey, 1);
                $this->redis->expire($lockerKey, 5); // set per 5 detik
               
                if ($fleet) {
                    $fleet->connected = 1;
                    $fleet->last_connection = Carbon::now();

                    if ($fleet->fleet_status == 'lost_connection') {
                        $fleet->fleet_status = 'other';
                    }

                    $fleet->save();
                }
            }
        }
    }
}
