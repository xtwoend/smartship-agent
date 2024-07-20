<?php

namespace Smartship\Katomas\Listener;

use Hyperf\Di\Annotation\Inject;
use Smartship\Katomas\Handler;
use Hyperf\Event\Annotation\Listener;
use Psr\Container\ContainerInterface;
use Hyperf\Event\Contract\ListenerInterface;
use Smartship\Katomas\Event\MQTTReceived;
use function Hyperf\Config\config;

#[Listener]
class MQTTCargoListener implements ListenerInterface
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
        $fleetId = config('katomas.fleet_id', null);
        $fleet = $this->handler->fleet();
        
        if ($event instanceof MQTTReceived && $fleetId) {
            $data = $event->data;
            // var_dump($data);
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
