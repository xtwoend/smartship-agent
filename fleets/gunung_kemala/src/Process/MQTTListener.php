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
namespace Smartship\GunungKemala\Process;

use Carbon\Carbon;
use Hyperf\Stringable\Str;
use PhpMqtt\Client\MqttClient;
use Hyperf\Process\AbstractProcess;
use Hyperf\Process\Annotation\Process;
use Smartship\GunungKemala\Event\MQTTReceived;

use function Hyperf\Config\config;

#[Process(name: 'smartship-gn-kemala', redirectStdinStdout: false, pipeType: 1, nums: 1, enableCoroutine: false)]
class MQTTListener extends AbstractProcess
{
    public function handle(): void
    {
        $fleet_id = config('gunung_kemala.fleet_id');
        $config = config('gunung_kemala.mqtt_connection');
        $clientId = Str::random(10);
        $classLogger = config('gunung_kemala.logger');
        
        $logger = class_exists($classLogger) ? new $classLogger : null;
        $event = $this->event;
        $mqtt = new MqttClient($config['host'], $config['port'], $clientId);

        $config = (new \PhpMqtt\Client\ConnectionSettings())
            ->setUsername($config['username'])
            ->setPassword($config['password']);

        $mqtt->connect($config, true);

        $topics = config('gunung_kemala.topics', []);
        foreach($topics as $topic => $handler) {
            $mqtt->subscribe($topic, function ($topic, $message) use ($logger, $event, $handler, $fleet_id) {
                try {
                    $class = $handler['parser'];
                    $model = $handler['model'];
                    
                    if (! class_exists($class) || ! class_exists($model)) {
                        return;
                    }
                    $data = (new $class($message))->extract();
                    $model = (new $model);
                    $event->dispatch(new MQTTReceived($data, $message, $topic, $model));
                } catch (\Throwable $th) {
                    if(! is_null($logger)) {
                        $logger->where('created_at', '<=', Carbon::now()->subHours(2)->format('Y-m-d H:i:s'))->delete();
                        $logger->create([
                            'fleet_id' => $fleet_id,
                            'topic' => $topic,
                            'message' => $message,
                            'file' => $th->getFile(),
                            'error' => $th->getMessage(),
                            'trace' => $th->getTraceAsString()
                        ]);
                    }
                }
            }, 0);
        }

        $mqtt->loop(true);
        $mqtt->disconnect();
    }

    public function isEnable($server): bool
    {
        return (bool) config('gunung_kemala.enable', false);
    }
}
