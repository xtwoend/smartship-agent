<?php

use function Hyperf\Support\env;

return [
    'enable' => true,
    'fleet_id' => 40,
    'fleet_model' => App\Model\Fleet::class,
    'logger' => App\Model\ErrorLog::class,
    'mqtt_connection' => [
        'host' => env('MQTT1_HOST', 'mqtt.mix.my.id'),
        'port' => (int) env('MQTT1_PORT', 1883),
        'username' => env('MQTT1_USERNAME'),
        'password' => env('MQTT1_PASSWORD'),
    ],
    'topics' => [
        'data/aries/vdr/#' => [
            'parser' => Smartship\Aries\Parser\VDR::class,
            'model' => App\Model\Navigation::class,
        ],
        // 'data/aries/hanla/ccr' => [
        //     'parser' => Smartship\Aries\Parser\Hanla::class,
        //     'model' => Smartship\Aries\Model\Cargo::class,
        // ],
        // 'data/aries/cargo/ccr' => [
        //     'parser' => Smartship\Aries\Parser\Cargo::class,
        //     'model' => Smartship\Aries\Model\Cargo::class,
        // ],
        // 'data/aries/pumpstatus/ccr' => [
        //     'parser' => Smartship\Aries\Parser\Pump::class,
        //     'model' => Smartship\Aries\Model\Cargo::class,
        // ]
    ]
];