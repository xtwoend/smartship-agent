<?php

declare(strict_types=1);

namespace App\Listener;

use App\Model\Fleet;
use App\Event\MQTTReceived;
use Hyperf\Event\Annotation\Listener;
use Psr\Container\ContainerInterface;
use Hyperf\Event\Contract\ListenerInterface;

#[Listener]
class MQTTCargoListener implements ListenerInterface
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
                if(key_exists('cargo', $data)) {
                    // var_dump('cargo', $fleet->id);
                    $model = $device->log_model;
                    if(class_exists($model)){
                        $v = Fleet::find($fleet->id);
                        $v->setCargo($model, $data);
                    }
                }

            }
            
        }
    }
}
