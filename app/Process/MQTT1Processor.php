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

use Carbon\Carbon;
use App\Model\Device;
use Hyperf\Utils\Str;
use App\Model\MqttLog;
use App\Model\ErrorLog;
use App\Event\MQTTReceived;
use PhpMqtt\Client\MqttClient;
use Hyperf\Process\AbstractProcess;
use Hyperf\Process\Annotation\Process;
use Hyperf\Contract\StdoutLoggerInterface;

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
                // var_dump($topic);
                try {
                    $class = $device->extractor;
                    if (! class_exists($class)) {
                        return;
                    }

                    $data = (new $class($message))->extract();

                    $event->dispatch(new MQTTReceived($data, $message, $topic, $device));
                } catch (\Throwable $th) {
                    $error = $th->getMessage();
                    // var_dump($error);
                    ErrorLog::where('created_at', '<=', Carbon::now()->subHours(2)->format('Y-m-d H:i:s'))->delete();
                    ErrorLog::create([
                        'fleet_id' => $device->fleet_id,
                        'topic' => $topic,
                        'error' => $error
                    ]);
                }
            }, 0);
        }

        $mqtt->loop(true);
        $mqtt->disconnect();
    }
}
