<?php

declare(strict_types=1);

namespace App\Listener;

use Carbon\Carbon;
use App\Model\Fleet;
use App\Event\MQTTReceived;
use Hyperf\Event\Annotation\Listener;
use Psr\Container\ContainerInterface;
use Hyperf\Event\Contract\ListenerInterface;

#[Listener]
class CheckConnectionListener implements ListenerInterface
{   
    protected $redis;

    public function __construct(protected ContainerInterface $container)
    {
        $this->redis = $container->get(\Hyperf\Redis\Redis::class);
    }

    public function listen(): array
    {
        return [
            MQTTReceived::class
        ];
    }

    public function process(object $event): void
    {
        $device = $event->device;
        $now = Carbon::now();
        $fleet = Fleet::find($device->fleet_id);

        $fleetId = $fleet->id;
        $lockerKey = 'FLEET_CONNECTION_' . $fleetId;

        if(! $this->redis->get($lockerKey)) { 
            
            $this->redis->set($lockerKey, 1);
            $this->redis->expire($lockerKey, 5); // set per 5 detik
            
            $fleet->update([
                'connected' => 1,
                'last_connection' => $now->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
