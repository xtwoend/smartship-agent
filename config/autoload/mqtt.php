<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
return [
    'default' => 'default',
    'agent' => env('SERVER_AGENT', 'agent_01'),
    'interval_save' => 10,
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
        ],
    ],
];
