<?php

use function Hyperf\Support\env;

return [
    'enable' => true,
    'fleet_id' => 39,
    'fleet_model' => App\Model\Fleet::class,
    'logger' => App\Model\ErrorLog::class,
    'mqtt_connection' => [
        'host' => env('MQTT1_HOST', 'mqtt.mix.my.id'),
        'port' => (int) env('MQTT1_PORT', 1883),
        'username' => env('MQTT1_USERNAME'),
        'password' => env('MQTT1_PASSWORD'),
    ],
    'topics' => [
        'data/matindok/vdr/#' => [
            'parser' => Smartship\Matindok\Parser\VDR::class,
            'model' => App\Model\Navigation::class,
        ],
        // 'data/matindok/hanla/ccr' => [
        //     'parser' => Smartship\Matindok\Parser\Hanla::class,
        //     'model' => Smartship\Matindok\Model\Cargo::class,
        // ],
        // 'data/matindok/cargo/ccr' => [
        //     'parser' => Smartship\Matindok\Parser\Cargo::class,
        //     'model' => Smartship\Matindok\Model\Cargo::class,
        // ],
        // 'data/matindok/pumpstatus/ccr' => [
        //     'parser' => Smartship\Matindok\Parser\Pump::class,
        //     'model' => Smartship\Matindok\Model\Cargo::class,
        // ]
    ]
];