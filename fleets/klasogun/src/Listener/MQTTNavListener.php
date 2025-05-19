<?php

namespace Smartship\Klasogun\Listener;

use Hyperf\Di\Annotation\Inject;
use Smartship\Klasogun\Handler;
use Hyperf\Event\Annotation\Listener;
use Psr\Container\ContainerInterface;
use Hyperf\Event\Contract\ListenerInterface;
use Smartship\Klasogun\Event\MQTTReceived;

use function Hyperf\Config\config;

#[Listener]
class MQTTNavListener implements ListenerInterface
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
        $fleetId = config('klasogun.fleet_id', null);
        $lockerKey = 'FLEET_NAV_' . $fleetId;

        if(! $this->redis->get($lockerKey)) { 
            $this->redis->set($lockerKey, 1);
            $this->redis->expire($lockerKey, (60 * 5)); // set per 5 menit
            $fleet = $this->handler->fleet();

            if ($event instanceof MQTTReceived && $fleetId) {
                $data = $event->data;
                $fleet = $fleet->find($fleetId);
                if ($fleet) {
                    if (key_exists('nav', $data) && !is_null($data['nav'])) {
                        $fleet->setNav($data);
                    }
                }
            }
        }
    }
}
