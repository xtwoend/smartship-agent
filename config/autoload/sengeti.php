<?php

use function Hyperf\Support\env;

return [
    'enable' => true,
    'fleet_id' => 52,
    'fleet_model' => App\Model\Fleet::class,
    'logger' => App\Model\ErrorLog::class,
    'mqtt_connection' => [
        'host' => env('MQTT1_HOST', 'mqtt.mix.my.id'),
        'port' => (int) env('MQTT1_PORT', 1883),
        'username' => env('MQTT1_USERNAME'),
        'password' => env('MQTT1_PASSWORD'),
    ],
    'topics' => [
        'data/sengeti/vdr/#' => [
            'parser' => Smartship\Sengeti\Parser\VDR::class,
            'model' => App\Model\Navigation::class,
        ],
        // 'data/sengeti/ecr/engine' => [
        //     'parser' => Smartship\Sengeti\Parser\Engine::class,
        //     'model' => Smartship\Sengeti\Model\Engine::class,
        // ],
        // 'data/sengeti/cargo/ccr' => [
        //     'parser' => Smartship\Sengeti\Parser\Cargo::class,
        //     'model' => Smartship\Sengeti\Model\Cargo::class,
        // ],
        // 'data/sengeti/pumpstatus/ccr' => [
        //     'parser' => Smartship\Sengeti\Parser\Pump::class,
        //     'model' => Smartship\Sengeti\Model\Cargo::class,
        // ]
    ]
];