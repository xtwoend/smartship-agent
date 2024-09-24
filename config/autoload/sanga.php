<?php

use function Hyperf\Support\env;

return [
    'enable' => true,
    'fleet_id' => 50,
    'fleet_model' => App\Model\Fleet::class,
    'logger' => App\Model\ErrorLog::class,
    'mqtt_connection' => [
        'host' => env('MQTT1_HOST', 'mqtt.mix.my.id'),
        'port' => (int) env('MQTT1_PORT', 1883),
        'username' => env('MQTT1_USERNAME'),
        'password' => env('MQTT1_PASSWORD'),
    ],
    'topics' => [
        'data/sangasanga/vdr/#' => [
            'parser' => Smartship\SangaSanga\Parser\VDR::class,
            'model' => App\Model\Navigation::class,
        ],
        // 'data/sangasanga/ecr/engine' => [
        //     'parser' => Smartship\SangaSanga\Parser\Engine::class,
        //     'model' => Smartship\SangaSanga\Model\Engine::class,
        // ],
        // 'data/sangasanga/cargo/ccr' => [
        //     'parser' => Smartship\SangaSanga\Parser\Cargo::class,
        //     'model' => Smartship\SangaSanga\Model\Cargo::class,
        // ],
        // 'data/sangasanga/pumpstatus/ccr' => [
        //     'parser' => Smartship\SangaSanga\Parser\Pump::class,
        //     'model' => Smartship\SangaSanga\Model\Cargo::class,
        // ]
    ]
];