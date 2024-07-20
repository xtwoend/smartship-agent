<?php

use function Hyperf\Support\env;

return [
    'enable' => true,
    'fleet_id' => 38,
    'fleet_model' => App\Model\Fleet::class,
    'logger' => App\Model\ErrorLog::class,
    'mqtt_connection' => [
        'host' => env('MQTT1_HOST', 'mqtt.mix.my.id'),
        'port' => (int) env('MQTT1_PORT', 1883),
        'username' => env('MQTT1_USERNAME'),
        'password' => env('MQTT1_PASSWORD'),
    ],
    'topics' => [
        'data/katomas/vdr/#' => [
            'parser' => Smartship\Katomas\Parser\VDR::class,
            'model' => App\Model\Navigation::class,
        ],
        // 'data/katomas/hanla/ccr' => [
        //     'parser' => Smartship\Katomas\Parser\Hanla::class,
        //     'model' => Smartship\Katomas\Model\Cargo::class,
        // ],
        // 'data/katomas/cargo/ccr' => [
        //     'parser' => Smartship\Katomas\Parser\Cargo::class,
        //     'model' => Smartship\Katomas\Model\Cargo::class,
        // ],
        // 'data/katomas/pumpstatus/ccr' => [
        //     'parser' => Smartship\Katomas\Parser\Pump::class,
        //     'model' => Smartship\Katomas\Model\Cargo::class,
        // ]
    ]
];