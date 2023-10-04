<?php

declare(strict_types=1);

namespace App\Listener;

use App\Model\Fleet;
use App\Event\MQTTReceived;
use Hyperf\Event\Annotation\Listener;
use Psr\Container\ContainerInterface;
use Hyperf\Event\Contract\ListenerInterface;

#[Listener]
class MQTTEngineListener implements ListenerInterface
{
    public function __construct(protected ContainerInterface $container)
    {
    }

    public function listen(): array
    {
        return [
            MQTTReceived::class
        ];
    }

    public function process(object $event): void
    {
        if($event instanceof MQTTReceived) {
            $data = $event->data;
            $fleet = $event->device?->fleet;
            $device = $event->device;
            
            if($fleet) {
                if(key_exists('engine', $data)) {
                   
                    $model = $device->log_model;
                    var_dump(class_exists($model));
                    if(class_exists($model)){
                        
                        $v = Fleet::find($fleet->id);
                        $v->setEngine($model, $data);
                    }
                }
            }
        }
    }
}
