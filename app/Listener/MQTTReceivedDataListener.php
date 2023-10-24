<?php

declare(strict_types=1);

namespace App\Listener;

use Carbon\Carbon;
use App\Model\Fleet;
use App\Event\MQTTReceived;
use Hyperf\Event\Annotation\Listener;
use Psr\Container\ContainerInterface;
use Hyperf\Event\Contract\ListenerInterface;

#[Listener]
class MQTTReceivedDataListener implements ListenerInterface
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
            $fleet = $event->device?->fleet;
            
            if($fleet) {
                $fleet->connected = 1;
                $fleet->last_connection = Carbon::now();
                $fleet->save();
            }
        }
    }
}
