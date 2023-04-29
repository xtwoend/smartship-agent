<?php

return [
    'default' => 'local',
    'interval_save' => 60,
    'servers' => [
        'local' => [
            'host' => env('MQTT_HOST', '127.0.0.1'),
            'port' => (int) env('MQTT_PORT', 1883),
            'username' => env('MQTT_USERNAME'),
            'password' => env('MQTT_PASSWORD'),
        ],
        'default' => [
            'host' => env('MQTT_HOST_PUSAT', '127.0.0.1'),
            'port' => (int) env('MQTT_PORT_PUSAT', 1883),
            'username' => env('MQTT_USERNAME_PUSAT'),
            'password' => env('MQTT_PASSWORD_PUSAT'),
        ]
    ]
];