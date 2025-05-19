<?php

namespace Smartship\Pg2\Listener;

use Carbon\Carbon;
use Hyperf\Di\Annotation\Inject;
use Smartship\Pg2\Handler;
use Hyperf\Event\Annotation\Listener;
use Psr\Container\ContainerInterface;
use Hyperf\Event\Contract\ListenerInterface;
use Smartship\Pg2\Event\MQTTReceived;

use function Hyperf\Config\config;

#[Listener]
class MQTTConnectionListener implements ListenerInterface
{
    #[Inject]
    protected ?Handler $handler;

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
        $fleetId = config('pg2.fleet_id', null);
        $lockerKey = 'FLEET_CONNECTION_' . $fleetId;

        if(! $this->redis->get($lockerKey)) { 
            $this->redis->set($lockerKey, 1);
            $this->redis->expire($lockerKey, (60 * 5)); // set per 5 menit

            $fleet = $this->handler->fleet();
            
            if ($event instanceof MQTTReceived && $fleetId) {
                
                $fleet = $fleet->find($fleetId);
                
                if ($fleet) {
                    // sett connection fleets
                    $lastConnection = Carbon::parse($fleet->last_connection);
                    $now = Carbon::now();
                    
                    // check interval 60 detik
                    if ($now->diffInSeconds($lastConnection) < config('mqtt.interval_save', 60)) {
                        return;
                    }
                    
                    $fleet->connected = 1;
                    $fleet->last_connection = Carbon::now();
                    $fleet->save();
                }
            }
        }
    }
}
