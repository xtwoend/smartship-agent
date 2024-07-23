<?php

use function Hyperf\Support\env;

return [
    'enable' => true,
    'fleet_id' => 42,
    'fleet_model' => App\Model\Fleet::class,
    'logger' => App\Model\ErrorLog::class,
    'mqtt_connection' => [
        'host' => env('MQTT1_HOST', 'mqtt.mix.my.id'),
        'port' => (int) env('MQTT1_PORT', 1883),
        'username' => env('MQTT1_USERNAME'),
        'password' => env('MQTT1_PASSWORD'),
    ],
    'topics' => [
        'data/plaju/vdr/#' => [
            'parser' => Smartship\Plaju\Parser\VDR::class,
            'model' => App\Model\Navigation::class,
        ],
        // 'data/plaju/hanla/ccr' => [
        //     'parser' => Smartship\Plaju\Parser\Hanla::class,
        //     'model' => Smartship\Plaju\Model\Cargo::class,
        // ],
        // 'data/plaju/cargo/ccr' => [
        //     'parser' => Smartship\Plaju\Parser\Cargo::class,
        //     'model' => Smartship\Plaju\Model\Cargo::class,
        // ],
        // 'data/plaju/pumpstatus/ccr' => [
        //     'parser' => Smartship\Plaju\Parser\Pump::class,
        //     'model' => Smartship\Plaju\Model\Cargo::class,
        // ]
    ]
];