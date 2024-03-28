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
class MQTTNavListener implements ListenerInterface
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
            
            $fleetId = $fleet->id;

            $last = $this->redis->get('FLEET_NAV_'.$fleetId);
            
            if(! $last) {
                $this->redis->set('FLEET_NAV_'.$fleetId, Carbon::now()->format('Y-m-d H:i:s'));
                var_dump('init set');
            }

            if($last && Carbon::parse($last) < Carbon::now()->subSeconds(2)) { 
                
                var_dump($fleetId, $last, Carbon::now()->format('Y-m-d H:i:s'));

                $this->redis->set('FLEET_NAV_'.$fleetId, Carbon::now()->format('Y-m-d H:i:s'));

                if ($fleet) {
                    // var_dump($data);
                    if (key_exists('nav', $data) && !is_null($data['nav'])) {
                        // var_dump('nav', $fleet->id);
                        $v = Fleet::find($fleet->id);
                        $v->setNav($data);
                    }
                }
            }
        }
    }
}
