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
use App\Model\MqttLog;
use Carbon\Carbon;
use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\Process\AbstractProcess;
use Hyperf\Process\Annotation\Process;
use Hyperf\Utils\Str;
use PhpMqtt\Client\MqttClient;

#[Process(name: 'MQTT1Processor', redirectStdinStdout: false, pipeType: 1, nums: 1, enableCoroutine: true)]
class MQTT1Processor extends AbstractProcess
{
    public function handle(): void
    {
        $server = 'default';
        $config = config('mqtt.servers')[$server];
        $agent = config('mqtt.agent');
        $clientId = Str::random(10);

        $logger = $this->container->get(StdoutLoggerInterface::class);
        $event = $this->event;
        $mqtt = new MqttClient($config['host'], $config['port'], $clientId);

        $config = (new \PhpMqtt\Client\ConnectionSettings())
            ->setUsername($config['username'])
            ->setPassword($config['password']);

        $mqtt->connect($config, true);

        foreach (Device::active()->where('mqtt_server', $server)->where('agent', $agent)->get() as $device) {
            $mqtt->subscribe($device->topic, function ($topic, $message) use ($logger, $event, $device) {
                var_dump($topic);
             
                try {
                    $class = $device->extractor;
                    if (! class_exists($class)) {
                        return;
                    }

                    $data = (new $class($message))->extract();

                    $event->dispatch(new MQTTReceived($data, $message, $topic, $device));
                } catch (\Throwable $th) {
                    var_dump($th->getMessage());
                }
                

                $logger->debug('Received Topic: ' . $topic);
            }, 0);
        }

        $mqtt->loop(true);
        $mqtt->disconnect();
    }
}
