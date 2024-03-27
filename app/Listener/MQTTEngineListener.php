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

use Carbon\Carbon;
use App\Model\Fleet;
use App\Event\MQTTReceived;
use Hyperf\Event\Annotation\Listener;
use Psr\Container\ContainerInterface;
use Hyperf\Event\Contract\ListenerInterface;

#[Listener]
class MQTTEngineListener implements ListenerInterface
{
    protected $redis;

    public function __construct(protected ContainerInterface $container)
    {
        $this->redis = $container->get(\Redis::class);
    }

    public function listen(): array
    {
        return [
            MQTTReceived::class,
        ];
    }

    public function process(object $event): void
    {
        if ($event instanceof MQTTReceived) {
            $data = $event->data;
            $fleet = $event->device?->fleet;
            $device = $event->device;

            $fleetId = $fleet->id;

            $last = $this->redis->get('FLEET_ENGINE_'.$fleetId);
            
            if(!$last) {
                $this->redis->set('FLEET_ENGINE_'.$fleetId, Carbon::now()->format('Y-m-d H:i:s'));
            }

            if($last && Carbon::parse($last) < Carbon::now()->subSeconds(2)) { 
                
                $this->redis->set('FLEET_ENGINE_'.$fleetId, Carbon::now()->format('Y-m-d H:i:s'));

                if ($fleet) {
                    // var_dump('engine', $data);
                    if (key_exists('engine', $data)) {
                        $model = $device->log_model;
                        if (class_exists($model)) {
                            $v = Fleet::find($fleet->id);
                            $v->setEngine($model, $data);
                        }
                    }
                }
            }
        }
    }
}
