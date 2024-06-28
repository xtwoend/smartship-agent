<?php

namespace Smartship\Pg1\Listener;

use Carbon\Carbon;
use Hyperf\Di\Annotation\Inject;
use Smartship\Pg1\Handler;
use Hyperf\Event\Annotation\Listener;
use Psr\Container\ContainerInterface;
use Hyperf\Event\Contract\ListenerInterface;
use Smartship\Pg1\Event\MQTTReceived;

use function Hyperf\Config\config;

#[Listener]
class MQTTEngineListener implements ListenerInterface
{
    #[Inject]
    protected ?Handler $handler;

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
        $fleetId = config('pg1.fleet_id', null);
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
