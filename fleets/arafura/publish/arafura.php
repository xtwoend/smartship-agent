<?php

use function Hyperf\Support\env;

return [
    'enable' => true,
    'fleet_id' => 4,
    'fleet_model' => App\Model\Fleet::class,
    'logger' => App\Model\ErrorLog::class,
    'mqtt_connection' => [
        'host' => env('MQTT1_HOST', 'mqtt.mix.my.id'),
        'port' => (int) env('MQTT1_PORT', 1883),
        'username' => env('MQTT1_USERNAME'),
        'password' => env('MQTT1_PASSWORD'),
    ],
    'topics' => [
        'data/arafura/vdr/#' => [
            'parser' => Smartship\Arafura\Parser\VDR::class,
            'model' => App\Model\Navigation::class,
        ],
        'data/arafura/hanla/ccr' => [
            'parser' => Smartship\Arafura\Parser\Hanla::class,
            'model' => Smartship\Arafura\Model\Cargo::class,
        ],
        'data/arafura/cargo/ccr' => [
            'parser' => Smartship\Arafura\Parser\Cargo::class,
            'model' => Smartship\Arafura\Model\Cargo::class,
        ],
        'data/arafura/pumpstatus/ccr' => [
            'parser' => Smartship\Arafura\Parser\Pump::class,
            'model' => Smartship\Arafura\Model\Cargo::class,
        ]
    ]
];