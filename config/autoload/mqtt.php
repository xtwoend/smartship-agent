<?php

return [
    'default' => 'default',
    'interval_save' => 60,
    'servers' => [
        'default' => [
            'host' => env('MQTT1_HOST', 'mqtt.mix.my.id'),
            'port' => (int) env('MQTT1_PORT', 1883),
            'username' => env('MQTT1_USERNAME'),
            'password' => env('MQTT1_PASSWORD'),
        ],
        'hivemq' => [
            'host' => env('MQTT2_HOST', 'broker.hivemq.com'),
            'port' => (int) env('MQTT2_PORT', 1883),
            'username' => env('MQTT2_USERNAME'),
            'password' => env('MQTT2_PASSWORD'),
        ]
    ]
];