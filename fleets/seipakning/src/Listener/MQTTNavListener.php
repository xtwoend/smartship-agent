<?php

namespace Smartship\Seipakning\Listener;

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
