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
namespace App\Process;

use App\Event\MQTTReceived;
use App\Model\Device;
use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\Process\AbstractProcess;
use Hyperf\Process\Annotation\Process;
use Hyperf\Utils\Str;
use PhpMqtt\Client\MqttClient;

// #[Process(name: 'MQTT2Processor')]
class MQTT2Processor extends AbstractProcess
{
    public function handle(): void
    {
        $server = 'hivemq';
        $config = config('mqtt.servers')[$server];

        $clientId = Str::random(10);

        $logger = $this->container->get(StdoutLoggerInterface::class);
        $event = $this->event;
        $mqtt = new MqttClient($config['host'], $config['port'], $clientId);

        $config = (new \PhpMqtt\Client\ConnectionSettings())
            ->setUsername($config['username'])
            ->setPassword($config['password']);

        $mqtt->connect($config, true);

        foreach (Device::active()->where('mqtt_server', $server)->get() as $device) {
            $mqtt->subscribe($device->topic, function ($topic, $message) use ($logger, $event, $device) {
                $class = $device->extractor;
                if (! class_exists($class)) {
                    return;
                }
                $data = (new $class($message))->extract();
                $event->dispatch(new MQTTReceived($data, $message, $topic, $device));
                $logger->debug('Received Topic: ' . $topic);
            }, 0);
        }

        $mqtt->loop(true);
        $mqtt->disconnect();
    }
}
