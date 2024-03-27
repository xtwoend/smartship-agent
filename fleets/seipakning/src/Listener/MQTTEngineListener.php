<?php

namespace Smartship\Seipakning\Listener;

use Carbon\Carbon;
use Hyperf\Redis\Redis;
use Hyperf\Di\Annotation\Inject;
use Smartship\Seipakning\Handler;
use Hyperf\Event\Annotation\Listener;
use Psr\Container\ContainerInterface;
use Hyperf\Event\Contract\ListenerInterface;
use Smartship\Seipakning\Event\MQTTReceived;

#[Listener]
class MQTTEngineListener implements ListenerInterface
{
    #[Inject]
    protected ?Handler $handler;

    #[Inject]
    protected Redis $redis;
    
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
        $fleetId = config('seipakning.fleet_id', null);
        $fleet = $this->handler->fleet();

        $last = $this->redis->get('FLEET_ENGINE_'.$fleetId);
        if($last && Carbon::parse($last) < Carbon::now()->subSeconds(30)) {  
            if ($event instanceof MQTTReceived && $fleetId) {
                $data = $event->data;
                $model = $event->model;
                
                $fleet = $fleet->find($fleetId);
                if ($fleet) {
                    if (key_exists('engine', $data)) {
                        $fleet->setEngine($model, $data);
                    }
                }
            }
        }
        $this->redis->set('FLEET_ENGINE_'.$fleetId, Carbon::now()->format('Y-m-d H:i:s'));
    }
}
