<?php

declare(strict_types=1);

namespace App\Listener;

use Carbon\Carbon;
use App\Model\Logger;
use App\Event\MQTTReceived;
use Hyperf\Utils\Codec\Json;
use Xtwoend\HyperfMqttClient\MQTT;
use Hyperf\Event\Annotation\Listener;
use Psr\Container\ContainerInterface;
use Hyperf\Event\Contract\ListenerInterface;

#[Listener]
class MQTTReceiverListener implements ListenerInterface
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
        if($event instanceof MQTTReceived) {
            $message = $event->message;
            $topic = $event->topic;

            $data = Logger::create([
                'topic' => $topic,
                'message' => $message,
                'sync' => false
            ]);

            $this->syncToServer($data);
        }
    }

    public function syncToServer($data)
    {
        $mqtt = MQTT::connection('default')->instance();
        if($mqtt->isConnected()) {
            $message = Json::encode(Json::decode($data->message));
            $time = Carbon::parse($data->created_at);
            $send = $mqtt->publish(
                $data->topic, 
                Json::encode(['data' => $message, 'timestamp' => $time->toAtomString()]), 
                1);
            $data->update(['sync' => true]);
        }
    }
}
