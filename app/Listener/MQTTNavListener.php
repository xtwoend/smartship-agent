<?php

declare(strict_types=1);

namespace App\Listener;

use App\Model\Fleet;
use App\Event\MQTTReceived;
use Hyperf\Event\Annotation\Listener;
use Psr\Container\ContainerInterface;
use Hyperf\Event\Contract\ListenerInterface;

#[Listener]
class MQTTNavListener implements ListenerInterface
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
            $fleet = $event->device?->Fleet;
            
            if($fleet) {
                if(key_exists('nav', $data)) {
                    // var_dump('nav', $fleet->id);
                    $v = Fleet::find($fleet->id);
                    $v->setNav($data);
                }

            }
        }
    }
}
