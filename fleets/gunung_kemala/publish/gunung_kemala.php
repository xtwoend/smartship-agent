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
        'data/gunungkemala/vdr/#' => [
            'parser' => Smartship\GunungKemala\Parser\VDR::class,
            'model' => App\Model\Navigation::class,
        ],
        // 'data/gunungkemala/ecr/engine' => [
        //     'parser' => Smartship\GunungKemala\Parser\Engine::class,
        //     'model' => Smartship\GunungKemala\Model\Engine::class,
        // ],
        // 'data/gunungkemala/cargo/ccr' => [
        //     'parser' => Smartship\GunungKemala\Parser\Cargo::class,
        //     'model' => Smartship\GunungKemala\Model\Cargo::class,
        // ],
        // 'data/gunungkemala/pumpstatus/ccr' => [
        //     'parser' => Smartship\GunungKemala\Parser\Pump::class,
        //     'model' => Smartship\GunungKemala\Model\Cargo::class,
        // ]
    ]
];