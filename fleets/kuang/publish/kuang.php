<?php

use function Hyperf\Support\env;

return [
    'enable' => true,
    'fleet_id' => 41,
    'fleet_model' => App\Model\Fleet::class,
    'logger' => App\Model\ErrorLog::class,
    'mqtt_connection' => [
        'host' => env('MQTT1_HOST', 'mqtt.mix.my.id'),
        'port' => (int) env('MQTT1_PORT', 1883),
        'username' => env('MQTT1_USERNAME'),
        'password' => env('MQTT1_PASSWORD'),
    ],
    'topics' => [
        'data/kuang/vdr/#' => [
            'parser' => Smartship\Kuang\Parser\VDR::class,
            'model' => App\Model\Navigation::class,
        ],
        // 'data/kuang/hanla/ccr' => [
        //     'parser' => Smartship\Kuang\Parser\Hanla::class,
        //     'model' => Smartship\Kuang\Model\Cargo::class,
        // ],
        // 'data/kuang/cargo/ccr' => [
        //     'parser' => Smartship\Kuang\Parser\Cargo::class,
        //     'model' => Smartship\Kuang\Model\Cargo::class,
        // ],
        // 'data/kuang/pumpstatus/ccr' => [
        //     'parser' => Smartship\Kuang\Parser\Pump::class,
        //     'model' => Smartship\Kuang\Model\Cargo::class,
        // ]
    ]
];