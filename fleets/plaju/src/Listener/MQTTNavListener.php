<?php

namespace Smartship\Plaju\Listener;

use Carbon\Carbon;
use Hyperf\Di\Annotation\Inject;
use Smartship\Plaju\Handler;
use Hyperf\Event\Annotation\Listener;
use Psr\Container\ContainerInterface;
use Hyperf\Event\Contract\ListenerInterface;
use Smartship\Plaju\Event\MQTTReceived;

use function Hyperf\Config\config;

#[Listener]
class MQTTNavListener implements ListenerInterface
{
    #[Inject]
    protected ?Handler $handler;

    protected $redis;

    public function __construct(protected ContainerInterface $container)
    {
        $this->redis = $container->get(\Redis::class);
    }

    public function listen(): array
    {
        return [
            MQTTReceived::class,
        ];
    }

    public function process(object $event): void
    {   
        $fleetId = config('plaju.fleet_id', null);
        $fleet = $this->handler->fleet();
        // $last = $this->redis->get('FLEET_NAV_'.$fleetId);
        
        // if(! $last) {
        //     $this->redis->set('FLEET_NAV_'.$fleetId, Carbon::now()->format('Y-m-d H:i:s'));
        // }
        
        // if($last && Carbon::parse($last) < Carbon::now()->subSeconds(2)) { 
           
            // $this->redis->set('FLEET_NAV_'.$fleetId, Carbon::now()->format('Y-m-d H:i:s'));

            if ($event instanceof MQTTReceived && $fleetId) {
                $data = $event->data;
                $fleet = $fleet->find($fleetId);
                if ($fleet) {
                    if (key_exists('nav', $data) && !is_null($data['nav'])) {
                        $fleet->setNav($data);
                    }
                }
            }
        // }
    }
}
