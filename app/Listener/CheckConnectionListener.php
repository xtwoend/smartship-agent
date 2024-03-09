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
class CheckConnectionListener implements ListenerInterface
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
        $device = $event->device;
        $now = Carbon::now();
        
        $last_connection = $fleet->last_connection;

        // save interval 60 detik
        if ($now->diffInSeconds($last_connection) < config('mqtt.interval_save', 60)) {
            return;
        }

        $fleet = Fleet::find($device->fleet_id);
        $fleet->update([
            'connected' => 1,
            'last_connection' => $now->format('Y-m-d H:i:s'),
        ]);
    }
}
