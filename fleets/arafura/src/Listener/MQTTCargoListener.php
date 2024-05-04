<?php

namespace Smartship\Arafura\Listener;

use Carbon\Carbon;
use Hyperf\Di\Annotation\Inject;
use Smartship\Arafura\Handler;
use Hyperf\Event\Annotation\Listener;
use Psr\Container\ContainerInterface;
use Hyperf\Event\Contract\ListenerInterface;
use Smartship\Arafura\Event\MQTTReceived;
use function Hyperf\Config\config;

#[Listener]
class MQTTCargoListener implements ListenerInterface
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
        $fleetId = config('arafura.fleet_id', null);
        $fleet = $this->handler->fleet();
        $last = $this->redis->get('FLEET_CARGO_'.$fleetId);
        
        // if(! $last) {
        //     $this->redis->set('FLEET_CARGO_'.$fleetId, Carbon::now()->format('Y-m-d H:i:s'));
        // }
        
        // if($last && Carbon::parse($last) < Carbon::now()->subSeconds(2)) {  
        //     $this->redis->set('FLEET_CARGO_'.$fleetId, Carbon::now()->format('Y-m-d H:i:s'));
            
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
        // }
    }
}
