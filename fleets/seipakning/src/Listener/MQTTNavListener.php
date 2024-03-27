<?php

namespace Smartship\Seipakning\Listener;

use Carbon\Carbon;
use Hyperf\Di\Annotation\Inject;
use Smartship\Seipakning\Handler;
use Hyperf\Event\Annotation\Listener;
use Psr\Container\ContainerInterface;
use Hyperf\Event\Contract\ListenerInterface;
use Smartship\Seipakning\Event\MQTTReceived;

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
        $fleetId = config('seipakning.fleet_id', null);
        $fleet = $this->handler->fleet();
        $last = $this->redis->get('FLEET_NAV_'.$fleetId);
        
        if(is_null($last)) {
            $this->redis->set('FLEET_NAV_'.$fleetId, Carbon::now()->format('Y-m-d H:i:s'));
        }

        if($last && Carbon::parse($last) < Carbon::now()->subSeconds(10)) { 
           
            $this->redis->set('FLEET_NAV_'.$fleetId, Carbon::now()->format('Y-m-d H:i:s'));

            if ($event instanceof MQTTReceived && $fleetId) {
                $data = $event->data;
                $model = $event->model;
                
                $fleet = $fleet->find($fleetId);
                if ($fleet) {
                    if (key_exists('nav', $data)) {
                        $fleet->setNav($data);
                    }
                }
            }

            
        }
    }
}
