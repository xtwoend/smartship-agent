<?php

use function Hyperf\Support\env;

return [
    'enable' => true,
    'fleet_id' => 38,
    'fleet_model' => App\Model\Fleet::class,
    'logger' => App\Model\ErrorLog::class,
    'mqtt_connection' => [
        'host' => env('MQTT1_HOST', 'mqtt.mix.my.id'),
        'port' => (int) env('MQTT1_PORT', 1883),
        'username' => env('MQTT1_USERNAME'),
        'password' => env('MQTT1_PASSWORD'),
    ],
    'topics' => [
        'data/musi/vdr/#' => [
            'parser' => Smartship\Musi\Parser\VDR::class,
            'model' => App\Model\Navigation::class,
        ],
        // 'data/musi/hanla/ccr' => [
        //     'parser' => Smartship\Musi\Parser\Hanla::class,
        //     'model' => Smartship\Musi\Model\Cargo::class,
        // ],
        // 'data/musi/cargo/ccr' => [
        //     'parser' => Smartship\Musi\Parser\Cargo::class,
        //     'model' => Smartship\Musi\Model\Cargo::class,
        // ],
        // 'data/musi/pumpstatus/ccr' => [
        //     'parser' => Smartship\Musi\Parser\Pump::class,
        //     'model' => Smartship\Musi\Model\Cargo::class,
        // ]
    ]
];