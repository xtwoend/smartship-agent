<?php

use function Hyperf\Support\env;

return [
    'enable' => true,
    'fleet_id' => 35,
    'fleet_model' => App\Model\Fleet::class,
    'logger' => App\Model\ErrorLog::class,
    'mqtt_connection' => [
        'host' => env('MQTT1_HOST', 'mqtt.mix.my.id'),
        'port' => (int) env('MQTT1_PORT', 1883),
        'username' => env('MQTT1_USERNAME'),
        'password' => env('MQTT1_PASSWORD'),
    ],
    'topics' => [
        'data/mauhau/vdr/#' => [
            'parser' => Smartship\Mauhau\Parser\VDR::class,
            'model' => App\Model\Navigation::class,
        ],
        // 'data/mauhau/ecr/engine' => [
        //     'parser' => Smartship\Mauhau\Parser\Engine::class,
        //     'model' => Smartship\Mauhau\Model\Engine::class,
        // ],
        // 'data/mauhau/hanla/ccr' => [
        //     'parser' => Smartship\Pg2\Parser\Hanla::class,
        //     'model' => Smartship\Pg2\Model\Cargo::class,
        // ],
        // 'data/mauhau/cargo/ccr' => [
        //     'parser' => Smartship\Pg2\Parser\Cargo::class,
        //     'model' => Smartship\Pg2\Model\Cargo::class,
        // ],
        // 'data/mauhau/pumpstatus/ccr' => [
        //     'parser' => Smartship\Pg2\Parser\Pump::class,
        //     'model' => Smartship\Pg2\Model\Cargo::class,
        // ]
    ]
];