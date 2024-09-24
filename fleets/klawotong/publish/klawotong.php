<?php

use function Hyperf\Support\env;

return [
    'enable' => true,
    'fleet_id' => 50,
    'fleet_model' => App\Model\Fleet::class,
    'logger' => App\Model\ErrorLog::class,
    'mqtt_connection' => [
        'host' => env('MQTT1_HOST', 'mqtt.mix.my.id'),
        'port' => (int) env('MQTT1_PORT', 1883),
        'username' => env('MQTT1_USERNAME'),
        'password' => env('MQTT1_PASSWORD'),
    ],
    'topics' => [
        'data/klawotong/vdr/#' => [
            'parser' => Smartship\Klawotong\Parser\VDR::class,
            'model' => App\Model\Navigation::class,
        ],
        // 'data/klawotong/ecr/engine' => [
        //     'parser' => Smartship\Klawotong\Parser\Engine::class,
        //     'model' => Smartship\Klawotong\Model\Engine::class,
        // ],
        // 'data/klawotong/cargo/ccr' => [
        //     'parser' => Smartship\Klawotong\Parser\Cargo::class,
        //     'model' => Smartship\Klawotong\Model\Cargo::class,
        // ],
        // 'data/klawotong/pumpstatus/ccr' => [
        //     'parser' => Smartship\Klawotong\Parser\Pump::class,
        //     'model' => Smartship\Klawotong\Model\Cargo::class,
        // ]
    ]
];