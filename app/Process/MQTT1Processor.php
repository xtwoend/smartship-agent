<?php

declare(strict_types=1);

namespace App\Process;

use Carbon\Carbon;
use App\Model\Device;
use Hyperf\Utils\Str;
use App\Event\MQTTReceived;
use PhpMqtt\Client\MqttClient;
use Hyperf\Process\AbstractProcess;
use Hyperf\Process\Annotation\Process;
use Hyperf\Contract\StdoutLoggerInterface;

#[Process(name: 'MQTT1Processor', redirectStdinStdout: false, pipeType: 2, nums: 1, enableCoroutine: true)]
class MQTT1Processor extends AbstractProcess
{
    public function handle(): void
    {
        $server = 'default';
        $config = config('mqtt.servers')[$server];
        
        $clientId = Str::random(10);
        
        $logger = $this->container->get(StdoutLoggerInterface::class);
        $event = $this->event;
        $mqtt = new MqttClient($config['host'], $config['port'], $clientId);
        
        $config = (new \PhpMqtt\Client\ConnectionSettings)
            ->setUsername($config['username'])
            ->setPassword($config['password']);

        $mqtt->connect($config, true);

        foreach(Device::active()->where('mqtt_server', $server)->get() as $device) {
            $mqtt->subscribe($device->topic, function ($topic, $message) use ($logger, $event, $device) {
                $device->update(['last_message' => $message, 'last_connected' => Carbon::now()]);
                $class = $device->extractor;
                // var_dump($topic, $message, $class);
                if(!class_exists($class)){
                    return;
                }
               
                $data = (new $class($message))->extract();
               
                $event->dispatch(new MQTTReceived($data, $message, $topic, $device));
               
                $logger->debug('Received Topic: '. $topic);
            }, 0);
        }

        $mqtt->loop(true);
        $mqtt->disconnect();
    }
}
