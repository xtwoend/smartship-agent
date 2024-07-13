<?php

use function Hyperf\Support\env;

return [
    'enable' => true,
    'fleet_id' => 36,
    'fleet_model' => App\Model\Fleet::class,
    'logger' => App\Model\ErrorLog::class,
    'mqtt_connection' => [
        'host' => env('MQTT1_HOST', 'mqtt.mix.my.id'),
        'port' => (int) env('MQTT1_PORT', 1883),
        'username' => env('MQTT1_USERNAME'),
        'password' => env('MQTT1_PASSWORD'),
    ],
    'topics' => [
        'data/aquila/vdr/#' => [
            'parser' => Smartship\Aquila\Parser\VDR::class,
            'model' => App\Model\Navigation::class,
        ],
        // 'data/aquila/hanla/ccr' => [
        //     'parser' => Smartship\Aquila\Parser\Hanla::class,
        //     'model' => Smartship\Aquila\Model\Cargo::class,
        // ],
        // 'data/aquila/cargo/ccr' => [
        //     'parser' => Smartship\Aquila\Parser\Cargo::class,
        //     'model' => Smartship\Aquila\Model\Cargo::class,
        // ],
        // 'data/aquila/pumpstatus/ccr' => [
        //     'parser' => Smartship\Aquila\Parser\Pump::class,
        //     'model' => Smartship\Aquila\Model\Cargo::class,
        // ]
    ]
];