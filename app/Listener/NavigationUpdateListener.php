<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace App\Listener;

use App\Event\NavigationUpdateEvent;
use App\Model\Fleet;
use App\Model\FleetStatusDuration;
use App\Model\Port;
use Carbon\Carbon;
use Hyperf\Event\Annotation\Listener;
use Hyperf\Event\Contract\ListenerInterface;
use Psr\Container\ContainerInterface;

#[Listener]
class NavigationUpdateListener implements ListenerInterface
{
    public function __construct(protected ContainerInterface $container)
    {
    }

    public function listen(): array
    {
        return [
            NavigationUpdateEvent::class,
        ];
    }

    public function process(object $event): void
    {
        $data = $event->data;

        [$distance_km, $portId] = $this->toRadius($data->lat, $data->lng);
        $fleet = Fleet::find($data->fleet_id);
        
        $p = Port::find($portId);

        if ($distance_km < 1 && $data->sog <= 0.5) {
            $fleet->update([
                'fleet_status' => 'at_port',
                'last_port' => $p->name . ', ' . $p->location,
            ]);
        } elseif ($distance_km >= 1 && $distance_km <= 15 && $data->sog <= 0.5) {
            $fleet->update([
                'fleet_status' => 'at_anchorage',
                'last_port' => $p->location,
            ]);
        } elseif ($distance_km >= 15 && $data->sog <= 0.5) {
            $fleet->update([
                'fleet_status' => 'other',
                'last_port' => null,
            ]);
        } else {
            $fleet->update([
                'fleet_status' => 'underway',
                'last_port' => null,
            ]);
        }

        // save duration fleet status
        $hi = FleetStatusDuration::where([
            'fleet_id' => $fleet->id,
            'fleet_status' => $fleet->fleet_status,
            'port' => $fleet->last_port,
            'status' => 1,
        ])->first();

        if ($hi) {
            $hi->finished_at = Carbon::now()->format('Y-m-d H:i:s');
            $hi->save();
        } else {
            FleetStatusDuration::where('fleet_id', $fleet->id)->update(['status' => 0]);
            FleetStatusDuration::create([
                'fleet_id' => $fleet->id,
                'fleet_status' => $fleet->fleet_status,
                'port' => $fleet->last_port,
                'status' => 1,
                'started_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
    }

    protected function toRadius(float $lat, float $lng)
    {
        $fleet_location = ['lat' => $lat, 'lng' => $lng];
        $distances = [];
        $ports = Port::all();
        foreach ($ports as $port) {
            $lat1 = deg2rad($port->lat);
            $lon1 = deg2rad($port->lng);
            $lat2 = deg2rad($fleet_location['lat']);
            $lon2 = deg2rad($fleet_location['lng']);

            $delta_lat = $lat2 - $lat1;
            $delta_lng = $lon2 - $lon1;

            $hav_lat = sin($delta_lat / 2) ** 2;
            $hav_lng = sin($delta_lng / 2) ** 2;

            $distance = 2 * asin(sqrt($hav_lat + cos($lat1) * cos($lat2) * $hav_lng));
            $earth_radius_km = 6371.009;
            $actual_distance = $earth_radius_km * $distance;

            $distances[$port->id] = $actual_distance;
        }
        asort($distances);
        $key = key($distances);
        $distance_km = $distances[$key];

        return (array) [$distance_km, $key];
    }
}
