<?php

use function Hyperf\Support\env;

return [
    'enable' => true,
    'fleet_id' => 48,
    'fleet_model' => App\Model\Fleet::class,
    'logger' => App\Model\ErrorLog::class,
    'mqtt_connection' => [
        'host' => env('MQTT1_HOST', 'mqtt.mix.my.id'),
        'port' => (int) env('MQTT1_PORT', 1883),
        'username' => env('MQTT1_USERNAME'),
        'password' => env('MQTT1_PASSWORD'),
    ],
    'topics' => [
        'data/klasogun/vdr/#' => [
            'parser' => Smartship\Klasogun\Parser\VDR::class,
            'model' => App\Model\Navigation::class,
        ],
        // 'data/klasogun/ccr/hanla' => [
        //     'parser' => Smartship\Klasogun\Parser\Hanla::class,
        //     'model' => Smartship\Klasogun\Model\Cargo::class,
        // ],
        // 'data/klasogun/ccr/cargo' => [
        //     'parser' => Smartship\Klasogun\Parser\Cargo::class,
        //     'model' => Smartship\Klasogun\Model\Cargo::class,
        // ],
        // 'data/klasogun/ccr/pump_status' => [
        //     'parser' => Smartship\Klasogun\Parser\Pump::class,
        //     'model' => Smartship\Klasogun\Model\Cargo::class,
        // ],
        // 'data/klasogun/ecr/engine' => [
        //     'parser' => Smartship\Klasogun\Parser\Engine::class,
        //     'model' => Smartship\Klasogun\Model\Engine::class,
        // ]
    ]
];