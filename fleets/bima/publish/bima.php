<?php

use function Hyperf\Support\env;

return [
    'enable' => true,
    'fleet_id' => 31,
    'fleet_model' => App\Model\Fleet::class,
    'logger' => App\Model\ErrorLog::class,
    'mqtt_connection' => [
        'host' => env('MQTT1_HOST', 'mqtt.mix.my.id'),
        'port' => (int) env('MQTT1_PORT', 1883),
        'username' => env('MQTT1_USERNAME'),
        'password' => env('MQTT1_PASSWORD'),
    ],
    'topics' => [
        'data/bima/vdr/#' => [
            'parser' => Smartship\Bima\Parser\VDR::class,
            'model' => App\Model\Navigation::class,
        ],
        // 'data/bima/ecr/engine' => [
        //     'parser' => Smartship\Bima\Parser\Engine::class,
        //     'model' => Smartship\Bima\Model\Engine::class,
        // ],
        // 'data/bima/hanla/ccr' => [
        //     'parser' => Smartship\Bima\Parser\Hanla::class,
        //     'model' => Smartship\Bima\Model\Cargo::class,
        // ],
        // 'data/bima/cargo/ccr' => [
        //     'parser' => Smartship\Bima\Parser\Cargo::class,
        //     'model' => Smartship\Bima\Model\Cargo::class,
        // ],
        // 'data/bima/pumpstatus/ccr' => [
        //     'parser' => Smartship\Bima\Parser\Pump::class,
        //     'model' => Smartship\Bima\Model\Cargo::class,
        // ]
    ]
];