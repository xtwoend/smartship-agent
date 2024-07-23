<?php

namespace Smartship\Plaju;

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
                \Smartship\Plaju\Handler::class => \Smartship\Plaju\HandlerFactory::class
            ],
            'publish' => [
                [
                    'id' => 'config',
                    'description' => 'The config of smartship plaju.',
                    'source' => __DIR__ . '/../publish/plaju.php',
                    'destination' => BASE_PATH . '/config/autoload/plaju.php',
                ],
            ],
        ];
    }
}