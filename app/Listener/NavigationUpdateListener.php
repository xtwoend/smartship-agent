<?php

declare(strict_types=1);

namespace App\Listener;

use App\Model\Port;
use App\Model\Fleet;
use App\Event\NavigationUpdateEvent;
use Hyperf\Event\Annotation\Listener;
use Psr\Container\ContainerInterface;
use Hyperf\Event\Contract\ListenerInterface;

#[Listener]
class NavigationUpdateListener implements ListenerInterface
{
    public function __construct(protected ContainerInterface $container)
    {
    }

    public function listen(): array
    {
        return [
            NavigationUpdateEvent::class
        ];
    }

    public function process(object $event): void
    {
        $data = $event->data;

        $ports = Port::all();

        foreach($ports as $port) {
            if(calc_crow($port->lat, $port->lng, $data->lat, $data->lng) <= 5) {
                Fleet::find($data->fleet_id)->update([
                    'fleet_status' => 'at_port',
                    'last_port' => $port->name .', '. $port->location 
                ]);
            }
        }
        
    }
}
