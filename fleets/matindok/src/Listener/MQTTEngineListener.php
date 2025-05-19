<?php

namespace Smartship\Matindok\Listener;

use Carbon\Carbon;
use Hyperf\Di\Annotation\Inject;
use Smartship\Matindok\Handler;
use Hyperf\Event\Annotation\Listener;
use Psr\Container\ContainerInterface;
use Hyperf\Event\Contract\ListenerInterface;
use Smartship\Matindok\Event\MQTTReceived;

use function Hyperf\Config\config;

#[Listener]
class MQTTEngineListener implements ListenerInterface
{
    #[Inject]
    protected ?Handler $handler;

    protected $redis;

    public function __construct(protected ContainerInterface $container)
    {
        $this->redis = $container->get(\Hyperf\Redis\Redis::class);
    }

    public function listen(): array
    {
        return [
            // MQTTReceived::class,
        ];
    }

    public function process(object $event): void
    {   
        $fleetId = config('matindok.fleet_id', null);
        $lockerKey = 'FLEET_ENGINE_' . $fleetId;

        if(! $this->redis->get($lockerKey)) { 
            $this->redis->set($lockerKey, 1);
            $this->redis->expire($lockerKey, (60 * 5)); // set per 5 menit

            $fleet = $this->handler->fleet();
            if ($event instanceof MQTTReceived && $fleetId) {
                $data = $event->data;
                $model = $event->model;
                // var_dump($data);
                $fleet = $fleet->find($fleetId);
                if ($fleet) {
                    if (key_exists('engine', $data)) {
                        $fleet->setEngine($model, $data);
                    }
                }
            }
        }
    }
}
