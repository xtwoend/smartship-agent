<?php

namespace Smartship\Meditran;

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
                \Smartship\Meditran\Handler::class => \Smartship\Meditran\HandlerFactory::class
            ],
            'publish' => [
                [
                    'id' => 'config',
                    'description' => 'The config of smartship meditran.',
                    'source' => __DIR__ . '/../publish/meditran.php',
                    'destination' => BASE_PATH . '/config/autoload/meditran.php',
                ],
            ],
        ];
    }
}