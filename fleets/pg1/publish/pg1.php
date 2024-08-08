<?php

use function Hyperf\Support\env;

return [
    'enable' => true,
    'fleet_id' => 34,
    'fleet_model' => App\Model\Fleet::class,
    'logger' => App\Model\ErrorLog::class,
    'mqtt_connection' => [
        'host' => env('MQTT1_HOST', 'mqtt.mix.my.id'),
        'port' => (int) env('MQTT1_PORT', 1883),
        'username' => env('MQTT1_USERNAME'),
        'password' => env('MQTT1_PASSWORD'),
    ],
    'topics' => [
        'data/pg1/vdr/#' => [
            'parser' => Smartship\Pg1\Parser\VDR::class,
            'model' => App\Model\Navigation::class,
        ],
        'data/pg1/ecr/engine' => [
            'parser' => Smartship\Pg1\Parser\Engine::class,
            'model' => Smartship\Pg1\Model\Engine::class,
        ],
        // 'data/pg1/hanla/ccr' => [
        //     'parser' => Smartship\Pg1\Parser\Hanla::class,
        //     'model' => Smartship\Pg1\Model\Cargo::class,
        // ],
        // 'data/pg1/cargo/ccr' => [
        //     'parser' => Smartship\Pg1\Parser\Cargo::class,
        //     'model' => Smartship\Pg1\Model\Cargo::class,
        // ],
        // 'data/pg1/pumpstatus/ccr' => [
        //     'parser' => Smartship\Pg1\Parser\Pump::class,
        //     'model' => Smartship\Pg1\Model\Cargo::class,
        // ]
    ]
];