<?php

namespace Smartship\Ketaling;

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
                \Smartship\Ketaling\Handler::class => \Smartship\Ketaling\HandlerFactory::class
            ],
            'publish' => [
                [
                    'id' => 'config',
                    'description' => 'The config of smartship ketaling.',
                    'source' => __DIR__ . '/../publish/ketaling.php',
                    'destination' => BASE_PATH . '/config/autoload/ketaling.php',
                ],
            ],
        ];
    }
}