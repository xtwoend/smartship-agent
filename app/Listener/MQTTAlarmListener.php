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
use App\Event\MQTTReceived;
use Hyperf\Event\Annotation\Listener;
use Psr\Container\ContainerInterface;
use Hyperf\Event\Contract\ListenerInterface;

#[Listener]
class MQTTAlarmListener implements ListenerInterface
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

            $last = $this->redis->get('FLEET_ALARM_'.$fleetId);
            
            if(!$last) {
                $this->redis->set('FLEET_ALARM_'.$fleetId, Carbon::now()->format('Y-m-d H:i:s'));
            }

            if($last && Carbon::parse($last) < Carbon::now()->subSeconds(2)) { 
                
                $this->redis->set('FLEET_ALARM_'.$fleetId, Carbon::now()->format('Y-m-d H:i:s'));
                // var_dump($data);
                if ($fleet) {
                    if (key_exists('alarm', $data)) {
                        $alarmModel = $device->log_model;
                        if (class_exists($alarmModel)) {
                            $model = new $alarmModel();
                            $model->setAlarm($data['alarm'], $fleet->id);
                        }
                    }
                }
            }
        }
    }
}
