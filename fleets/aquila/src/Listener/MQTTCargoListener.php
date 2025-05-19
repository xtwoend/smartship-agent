<?php

namespace Smartship\Aquila\Listener;

use Hyperf\Di\Annotation\Inject;
use Smartship\Aquila\Handler;
use Hyperf\Event\Annotation\Listener;
use Psr\Container\ContainerInterface;
use Hyperf\Event\Contract\ListenerInterface;
use Smartship\Aquila\Event\MQTTReceived;
use function Hyperf\Config\config;

#[Listener]
class MQTTCargoListener implements ListenerInterface
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
            MQTTReceived::class,
        ];
    }

    public function process(object $event): void
    {   
        $fleetId = config('aquila.fleet_id', null);
        $fleet = $this->handler->fleet();
        
        $fleetId = $fleet->id;
        $lockerKey = 'FLEET_CARGO_' . $fleetId;
        if(! $this->redis->get($lockerKey)) { 
            $this->redis->set($lockerKey, 1);
            $this->redis->expire($lockerKey, (60 * 5)); // set per 5 menit

            if ($event instanceof MQTTReceived && $fleetId) {
                $data = $event->data;
                // var_dump($data);
                $model = $event->model;
                
                $fleet = $fleet->find($fleetId);
                
                if ($fleet) {
                    if (key_exists('cargo', $data)) {
                        $fleet->setCargo($model, $data);
                    }
                }
            }
        }
    }
}
