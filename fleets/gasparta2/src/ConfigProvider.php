<?php

namespace Smartship\Gasparta2;

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
                \Smartship\Gasparta2\Handler::class => \Smartship\Gasparta2\HandlerFactory::class
            ],
            'publish' => [
                [
                    'id' => 'config',
                    'description' => 'The config of smartship gasparta2.',
                    'source' => __DIR__ . '/../publish/gasparta2.php',
                    'destination' => BASE_PATH . '/config/autoload/gasparta2.php',
                ],
            ],
        ];
    }
}