<?php

declare(strict_types=1);

namespace App\Process;

use App\Model\Topic;
use Hyperf\Utils\Str;
use App\Event\MQTTReceived;
use PhpMqtt\Client\MqttClient;
use Hyperf\Process\AbstractProcess;
use Hyperf\Process\Annotation\Process;
use Hyperf\Contract\StdoutLoggerInterface;

#[Process(name: 'MQTTProcessor')]
class MQTTProcessor extends AbstractProcess
{
    public function handle(): void
    {
        $server = 'local';
        $config = config('mqtt.servers')[$server];
        
        $clientId = Str::random(10);
        
        $logger = $this->container->get(StdoutLoggerInterface::class);
        $event = $this->event;
        $mqtt = new MqttClient($config['host'], $config['port'], $clientId);
        
        $config = (new \PhpMqtt\Client\ConnectionSettings)
            ->setUsername($config['username'])
            ->setPassword($config['password']);

        $mqtt->connect($config, true);

        foreach(Topic::all() as $row) {
            $mqtt->subscribe($row->topic, function ($topic, $message) use ($logger, $event, $row) {
                $event->dispatch(new MQTTReceived($message, $topic, $row));
                $logger->debug('Received Topic: '. $topic);
            }, 0);
        }

        $mqtt->loop(true);
        $mqtt->disconnect();
    }
}
