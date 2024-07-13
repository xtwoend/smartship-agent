<?php

namespace Smartship\Aquila;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'annotations' => [
                'scan' => [
                    'paths' => [
                        __DIR__,
                    ],
                    'collectors' => [
                        //    
                    ],
                ],
            ],
            'dependencies' => [
                \Smartship\Aquila\Handler::class => \Smartship\Aquila\HandlerFactory::class
            ],
            'publish' => [
                [
                    'id' => 'config',
                    'description' => 'The config of smartship aquila.',
                    'source' => __DIR__ . '/../publish/aquila.php',
                    'destination' => BASE_PATH . '/config/autoload/aquila.php',
                ],
            ],
        ];
    }
}