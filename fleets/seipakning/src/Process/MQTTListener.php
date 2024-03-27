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
namespace Smartship\Seipakning\Process;

use Smartship\Seipakning\Event\MQTTReceived;
use Carbon\Carbon;
use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\Process\AbstractProcess;
use Hyperf\Process\Annotation\Process;
use Hyperf\Utils\Str;
use PhpMqtt\Client\MqttClient;

#[Process(name: 'smartship-seipakning', redirectStdinStdout: false, pipeType: 1, nums: 1, enableCoroutine: false)]
class MQTTListener extends AbstractProcess
{
    public function handle(): void
    {
        $config = config('seipakning.mqtt_connection');
        $clientId = Str::random(10);

        $logger = $this->container->get(StdoutLoggerInterface::class);
        $event = $this->event;
        $mqtt = new MqttClient($config['host'], $config['port'], $clientId);

        $config = (new \PhpMqtt\Client\ConnectionSettings())
            ->setUsername($config['username'])
            ->setPassword($config['password']);

        $mqtt->connect($config, true);

        $topics = config('seipakning.topics', []);
        foreach($topics as $topic => $handler) {
            $mqtt->subscribe($topic, function ($topic, $message) use ($logger, $event, $handler) {
                $class = $handler['parser'];
                $model = $handler['model'];
                if (! class_exists($class) || ! class_exists($model)) {
                    return;
                }
                $data = (new $class($message))->extract();
                $model = (new $model);
                $event->dispatch(new MQTTReceived($data, $message, $topic, $model));
            }, 0);
        }

        $mqtt->loop(true);
        $mqtt->disconnect();
    }

    public function isEnable($server): bool
    {
        return (bool) config('seipakning.enable', false);
    }
}
