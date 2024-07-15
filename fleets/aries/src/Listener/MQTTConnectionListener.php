<?php

namespace Smartship\Aries\Listener;

use Carbon\Carbon;
use Hyperf\Di\Annotation\Inject;
use Smartship\Aries\Handler;
use Hyperf\Event\Annotation\Listener;
use Psr\Container\ContainerInterface;
use Hyperf\Event\Contract\ListenerInterface;
use Smartship\Aries\Event\MQTTReceived;

use function Hyperf\Config\config;

#[Listener]
class MQTTConnectionListener implements ListenerInterface
{
    #[Inject]
    protected ?Handler $handler;

    public function __construct(protected ContainerInterface $container)
    {
    }

    public function listen(): array
    {
        return [
            MQTTReceived::class,
        ];
    }

    public function process(object $event): void
    {   
        $fleetId = config('aries.fleet_id', null);
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
