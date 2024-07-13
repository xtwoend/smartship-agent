<?php

use function Hyperf\Support\env;

return [
    'enable' => true,
    'fleet_id' => 37,
    'fleet_model' => App\Model\Fleet::class,
    'logger' => App\Model\ErrorLog::class,
    'mqtt_connection' => [
        'host' => env('MQTT1_HOST', 'mqtt.mix.my.id'),
        'port' => (int) env('MQTT1_PORT', 1883),
        'username' => env('MQTT1_USERNAME'),
        'password' => env('MQTT1_PASSWORD'),
    ],
    'topics' => [
        'data/merauke/vdr/#' => [
            'parser' => Smartship\Merauke\Parser\VDR::class,
            'model' => App\Model\Navigation::class,
        ],
        // 'data/merauke/hanla/ccr' => [
        //     'parser' => Smartship\Merauke\Parser\Hanla::class,
        //     'model' => Smartship\Merauke\Model\Cargo::class,
        // ],
        // 'data/merauke/cargo/ccr' => [
        //     'parser' => Smartship\Merauke\Parser\Cargo::class,
        //     'model' => Smartship\Merauke\Model\Cargo::class,
        // ],
        // 'data/merauke/pumpstatus/ccr' => [
        //     'parser' => Smartship\Merauke\Parser\Pump::class,
        //     'model' => Smartship\Merauke\Model\Cargo::class,
        // ]
    ]
];