<?php

namespace Smartship\Pg2\Listener;

use Hyperf\Di\Annotation\Inject;
use Smartship\Pg2\Handler;
use Hyperf\Event\Annotation\Listener;
use Psr\Container\ContainerInterface;
use Hyperf\Event\Contract\ListenerInterface;
use Smartship\Pg2\Event\MQTTReceived;

use function Hyperf\Config\config;

#[Listener]
class MQTTCargoListener implements ListenerInterface
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
        $fleetId = config('Pg2.fleet_id', null);
        $fleet = $this->handler->fleet();

        if ($event instanceof MQTTReceived && $fleetId) {
            $data = $event->data;

            $model = $event->model;
            
            $fleet = $fleet->find($fleetId);
            
            if ($fleet) {
                if (key_exists('cargo', $data)) {
                    $fleet->setCargo($model, $data);
                }
            }
        }
    }
}
