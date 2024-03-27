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

#[Process(name: 'MQTT1Processor', redirectStdinStdout: false, pipeType: 2, nums: 1, enableCoroutine: true)]
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
                // $device->update(['last_message' => $message, 'last_connected' => Carbon::now()]);
                    
                // updated last connected
                // $device->fleet->update([
                //     'last_connection' => Carbon::now(),
                //     'connected' => 1
                // ]);

                $class = $device->extractor;

                // MqttLog::create([
                //     'fleet_id' => $device->fleet_id,
                //     'topic' => $topic,
                //     'message' => $message,
                // ]);

                // var_dump($topic, $message, $class);
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
