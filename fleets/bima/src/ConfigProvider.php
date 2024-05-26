<?php

namespace Smartship\Bima;

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
                \Smartship\Bima\Handler::class => \Smartship\Bima\HandlerFactory::class
            ],
            'publish' => [
                [
                    'id' => 'config',
                    'description' => 'The config of smartship bima.',
                    'source' => __DIR__ . '/../publish/bima.php',
                    'destination' => BASE_PATH . '/config/autoload/bima.php',
                ],
            ],
        ];
    }
}