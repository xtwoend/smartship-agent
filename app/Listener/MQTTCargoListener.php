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

use App\Event\MQTTReceived;
use App\Model\Fleet;
use Hyperf\Event\Annotation\Listener;
use Hyperf\Event\Contract\ListenerInterface;
use Psr\Container\ContainerInterface;

#[Listener]
class MQTTCargoListener implements ListenerInterface
{
    public function __construct(protected ContainerInterface $container)
    {
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

            if ($fleet) {
                if (key_exists('cargo', $data)) {
                    // var_dump('cargo', $data);
                    $model = $device->log_model;
                    if (class_exists($model)) {
                        // var_dump($model);
                        $v = Fleet::find($fleet->id);
                        $v->setCargo($model, $data);
                    }
                }
            }
        }
    }
}
