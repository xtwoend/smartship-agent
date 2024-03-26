<?php

return [
    'fleet_id' => 3,
    'fleet_model' => App\Model\Fleet::class,
    'mqtt_connection' => [
        'host' => env('MQTT1_HOST', 'mqtt.mix.my.id'),
        'port' => (int) env('MQTT1_PORT', 1883),
        'username' => env('MQTT1_USERNAME'),
        'password' => env('MQTT1_PASSWORD'),
    ],
    'topics' => [
        'data/seipakning/vdr/#' => [
            'parser' => Smartship\Seipakning\Parser\VDR::class,
            'model' => App\Model\Navigation::class,
        ],
        'data/seipakning/ecr/engine' => [
            'parser' => Smartship\Seipakning\Parser\Engine::class,
            'model' => Smartship\Seipakning\Model\Engine::class,
        ],
        'data/seipakning/ccr/hanla' => [
            'parser' => Smartship\Seipakning\Parser\Hanla::class,
            'model' => Smartship\Seipakning\Model\Cargo::class,
        ],
        'data/seipakning/ccr/cargo' => [
            'parser' => Smartship\Seipakning\Parser\CargoPump::class,
            'model' => Smartship\Seipakning\Model\CargoPump::class,
        ],
    ]
];