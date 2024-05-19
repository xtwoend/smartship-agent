<?php

use function Hyperf\Support\env;

return [
    'enable' => true,
    'fleet_id' => 29,
    'fleet_model' => App\Model\Fleet::class,
    'logger' => App\Model\ErrorLog::class,
    'mqtt_connection' => [
        'host' => env('MQTT1_HOST', 'mqtt.mix.my.id'),
        'port' => (int) env('MQTT1_PORT', 1883),
        'username' => env('MQTT1_USERNAME'),
        'password' => env('MQTT1_PASSWORD'),
    ],
    'topics' => [
        // 'data/taurus/vdr/#' => [
        //     'parser' => Smartship\Taurus\Parser\VDR::class,
        //     'model' => App\Model\Navigation::class,
        // ],
        // 'data/taurus/ccr/hanla' => [
        //     'parser' => Smartship\Taurus\Parser\Hanla::class,
        //     'model' => Smartship\Taurus\Model\Cargo::class,
        // ],
        'data/taurus/ecr/engine' => [
            'parser' => Smartship\Taurus\Parser\Engine::class,
            'model' => Smartship\Taurus\Model\Engine::class,
        ],
        // 'data/taurus/ccr/pump_status' => [
        //     'parser' => Smartship\Taurus\Parser\Pump::class,
        //     'model' => Smartship\Taurus\Model\Cargo::class,
        // ]
    ]
];