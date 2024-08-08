<?php

use function Hyperf\Support\env;

return [
    'enable' => true,
    'fleet_id' => 43,
    'fleet_model' => App\Model\Fleet::class,
    'logger' => App\Model\ErrorLog::class,
    'mqtt_connection' => [
        'host' => env('MQTT1_HOST', 'mqtt.mix.my.id'),
        'port' => (int) env('MQTT1_PORT', 1883),
        'username' => env('MQTT1_USERNAME'),
        'password' => env('MQTT1_PASSWORD'),
    ],
    'topics' => [
        'data/pagaden/vdr/#' => [
            'parser' => Smartship\Pagaden\Parser\VDR::class,
            'model' => App\Model\Navigation::class,
        ],
        // 'data/pagaden/ccr/hanla' => [
        //     'parser' => Smartship\Pagaden\Parser\Hanla::class,
        //     'model' => Smartship\Pagaden\Model\Cargo::class,
        // ],
        // 'data/pagaden/cargo/ccr' => [
        //     'parser' => Smartship\Pagaden\Parser\Cargo::class,
        //     'model' => Smartship\Pagaden\Model\Cargo::class,
        // ],
        // 'data/pagaden/pumpstatus/ccr' => [
        //     'parser' => Smartship\Pagaden\Parser\Pump::class,
        //     'model' => Smartship\Pagaden\Model\Cargo::class,
        // ]
    ]
];