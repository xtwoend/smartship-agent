<?php

use function Hyperf\Support\env;

return [
    'enable' => true,
    'fleet_id' => 32,
    'fleet_model' => App\Model\Fleet::class,
    'logger' => App\Model\ErrorLog::class,
    'mqtt_connection' => [
        'host' => env('MQTT1_HOST', 'mqtt.mix.my.id'),
        'port' => (int) env('MQTT1_PORT', 1883),
        'username' => env('MQTT1_USERNAME'),
        'password' => env('MQTT1_PASSWORD'),
    ],
    'topics' => [
        'data/meditran/vdr/#' => [
            'parser' => Smartship\Krasak\Parser\VDR::class,
            'model' => App\Model\Navigation::class,
        ],
        'data/meditran/ccr/hanla' => [
            'parser' => Smartship\Krasak\Parser\Hanla::class,
            'model' => Smartship\Krasak\Model\Cargo::class,
        ],
        // 'data/arafura/cargo/ccr' => [
        //     'parser' => Smartship\Krasak\Parser\Cargo::class,
        //     'model' => Smartship\Krasak\Model\Cargo::class,
        // ],
        // 'data/arafura/pumpstatus/ccr' => [
        //     'parser' => Smartship\Krasak\Parser\Pump::class,
        //     'model' => Smartship\Krasak\Model\Cargo::class,
        // ]
    ]
];