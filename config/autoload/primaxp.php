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
        'data/primaxp/vdr/#' => [
            'parser' => Smartship\Primaxp\Parser\VDR::class,
            'model' => App\Model\Navigation::class,
        ],
        'data/primaxp/ecr/engine' => [
            'parser' => Smartship\Primaxp\Parser\Engine::class,
            'model' => Smartship\Primaxp\Model\Engine::class,
        ],
        'data/primaxp/cargo/ccr' => [
            'parser' => Smartship\Primaxp\Parser\Cargo::class,
            'model' => Smartship\Primaxp\Model\Cargo::class,
        ],
        'data/primaxp/pumpstatus/ccr' => [
            'parser' => Smartship\Primaxp\Parser\Pump::class,
            'model' => Smartship\Primaxp\Model\Cargo::class,
        ]
    ]
];