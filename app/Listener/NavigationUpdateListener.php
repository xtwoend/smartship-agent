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
        $fleet_location = ['lat' => $data->lat, 'lng' => $data->lng];
        $distances = [];
        foreach($ports as $port) {
        
            $lat1 = deg2rad($port->lat);
            $lon1 = deg2rad($port->lng);
            $lat2 = deg2rad($fleet_location['lat']);
            $lon2 = deg2rad($fleet_location['lng']);

            $delta_lat = $lat2 - $lat1;
            $delta_lng = $lon2 - $lon1;

            $hav_lat = (sin($delta_lat / 2))**2;
            $hav_lng = (sin($delta_lng / 2))**2;

            $distance = 2 * asin(sqrt($hav_lat + cos($lat1) * cos($lat2) * $hav_lng));
            $earth_radius_km = 6371.009;
            $actual_distance = $earth_radius_km * $distance;

            $distances[$port->id] = $actual_distance;
        }
        asort($distances);
        $key = key($distances);
        $distance_km = $distances[$key];
       
        $fleet = Fleet::find($data->fleet_id);
        if($distance_km <= 5) {
            $p = Port::find($key);
            $fleet->update([
                'fleet_status' => 'at_port',
                'last_port' => $p->name. ', ' . $p->location
            ]);
        }else{
            $fleet->update([
                'fleet_status' => 'ballast',
            ]);
        }
    }
}
