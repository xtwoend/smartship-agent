<?php

declare(strict_types=1);

namespace App\Listener;

use App\Model\Vessel;
use App\Event\MQTTReceived;
use Hyperf\Event\Annotation\Listener;
use Psr\Container\ContainerInterface;
use Hyperf\Event\Contract\ListenerInterface;

#[Listener]
class MQTTVesselListener implements ListenerInterface
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
        // if($event instanceof MQTTReceived) {
        //     $data = $event->data;
        //     $vessel = $event->device?->vessel;
        //     $device = $event->device;
            
        //     if($vessel) {
        //         if(key_exists('nav', $data)) {
        //             $v = Vessel::find($vessel->id);
        //             $v->setNav($data);
        //         }

        //         if(key_exists('engine', $data)) {
        //             $v = Vessel::find($vessel->id);
        //             var_dump($v->id);
        //             $v->setEngine($data);
        //         }
                
        //         if(key_exists('cargo', $data)) {
        //             $model = $device->cargo_model;
        //             if(class_exists($model)){
        //                 $v = Vessel::find($vessel->id);
        //                 $v->setCargo($model, $data);
        //             }
        //         }
        //     }
        // }
    }
}
