<?php

namespace Smartship\GunungKemala\Listener;

use Hyperf\Di\Annotation\Inject;
use Smartship\GunungKemala\Handler;
use Hyperf\Event\Annotation\Listener;
use Psr\Container\ContainerInterface;
use Hyperf\Event\Contract\ListenerInterface;
use Smartship\GunungKemala\Event\MQTTReceived;

use function Hyperf\Config\config;

#[Listener]
class MQTTCargoListener implements ListenerInterface
{
    #[Inject]
    protected ?Handler $handler;

    protected $redis;

    public function __construct(protected ContainerInterface $container)
    {
        // $this->redis = $container->get(\Redis::class);
    }

    public function listen(): array
    {
        return [
            MQTTReceived::class,
        ];
    }

    public function process(object $event): void
    {   
        $fleetId = config('gunung_kemala.fleet_id', null);
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
