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
        
                if($fleet->fleet_status == 'lost_connection') {
                    $fleet->fleet_status = 'other';
                }
                
                $fleet->save();

                // save duration fleet status
                $hi = $fleet->status_durations()->where([
                        'fleet_id' => $fleetId,
                        'fleet_status' => $fleet->fleet_status,
                        'status' => 1
                    ])->first();
                if($hi) {
                    $hi->finished_at = Carbon::now()->format('Y-m-d H:i:s');
                    $hi->save(); 
                }else{
                    $fleet->status_durations()->update(['status' => 0]);
                    $fleet->status_durations()->create([
                        'fleet_id' => $fleetId,
                        'fleet_status' => $fleet->fleet_status,
                        'status' => 1,
                        'started_at' => Carbon::now()->format('Y-m-d H:i:s')
                    ]);
                }
            }
        }
    }
}
