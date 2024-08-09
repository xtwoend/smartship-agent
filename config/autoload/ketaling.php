<?php

use function Hyperf\Support\env;

return [
    'enable' => true,
    'fleet_id' => 45,
    'fleet_model' => App\Model\Fleet::class,
    'logger' => App\Model\ErrorLog::class,
    'mqtt_connection' => [
        'host' => env('MQTT1_HOST', 'mqtt.mix.my.id'),
        'port' => (int) env('MQTT1_PORT', 1883),
        'username' => env('MQTT1_USERNAME'),
        'password' => env('MQTT1_PASSWORD'),
    ],
    'topics' => [
        'data/ketaling/vdr/#' => [
            'parser' => Smartship\Ketaling\Parser\VDR::class,
            'model' => App\Model\Navigation::class,
        ],
        // 'data/ketaling/ecr/engine' => [
        //     'parser' => Smartship\Ketaling\Parser\Engine::class,
        //     'model' => Smartship\Ketaling\Model\Engine::class,
        // ],
        // 'data/ketaling/cargo/ccr' => [
        //     'parser' => Smartship\Ketaling\Parser\Cargo::class,
        //     'model' => Smartship\Ketaling\Model\Cargo::class,
        // ],
        // 'data/ketaling/pumpstatus/ccr' => [
        //     'parser' => Smartship\Ketaling\Parser\Pump::class,
        //     'model' => Smartship\Ketaling\Model\Cargo::class,
        // ]
    ]
];