<?php

namespace Smartship\Gasparta2\Listener;

use Carbon\Carbon;
use Hyperf\Di\Annotation\Inject;
use Smartship\Gasparta2\Handler;
use Hyperf\Event\Annotation\Listener;
use Psr\Container\ContainerInterface;
use Hyperf\Event\Contract\ListenerInterface;
use Smartship\Gasparta2\Event\MQTTReceived;

use function Hyperf\Config\config;

#[Listener]
class MQTTNavListener implements ListenerInterface
{
    #[Inject]
    protected ?Handler $handler;

    public function __construct(protected ContainerInterface $container)
    {
        // 
    }

    public function listen(): array
    {
        return [
            MQTTReceived::class,
        ];
    }

    public function process(object $event): void
    {   
        $fleetId = config('gasparta2.fleet_id', null);
        $fleet = $this->handler->fleet();

        if ($event instanceof MQTTReceived && $fleetId) {
            $data = $event->data;
            $fleet = $fleet->find($fleetId);
            if ($fleet) {
                if (key_exists('nav', $data) && !is_null($data['nav'])) {
                    $fleet->setNav($data);
                }
            }
        }
    
    }
}
