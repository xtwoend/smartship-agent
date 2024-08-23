<?php

use function Hyperf\Support\env;

return [
    'enable' => true,
    'fleet_id' => 46,
    'fleet_model' => App\Model\Fleet::class,
    'logger' => App\Model\ErrorLog::class,
    'mqtt_connection' => [
        'host' => env('MQTT1_HOST', 'mqtt.mix.my.id'),
        'port' => (int) env('MQTT1_PORT', 1883),
        'username' => env('MQTT1_USERNAME'),
        'password' => env('MQTT1_PASSWORD'),
    ],
    'topics' => [
        'data/gasparta2/vdr/#' => [
            'parser' => Smartship\Gasparta2\Parser\VDR::class,
            'model' => App\Model\Navigation::class,
        ],
        // 'data/gasparta2/hanla/ccr' => [
        //     'parser' => Smartship\Gasparta2\Parser\Hanla::class,
        //     'model' => Smartship\Gasparta2\Model\Cargo::class,
        // ],
        // 'data/gasparta2/cargo/ccr' => [
        //     'parser' => Smartship\Gasparta2\Parser\Cargo::class,
        //     'model' => Smartship\Gasparta2\Model\Cargo::class,
        // ],
        // 'data/gasparta2/pumpstatus/ccr' => [
        //     'parser' => Smartship\Gasparta2\Parser\Pump::class,
        //     'model' => Smartship\Gasparta2\Model\Cargo::class,
        // ]
    ]
];