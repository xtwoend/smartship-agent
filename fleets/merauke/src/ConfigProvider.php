<?php

namespace Smartship\Merauke;

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
                \Smartship\Merauke\Handler::class => \Smartship\Merauke\HandlerFactory::class
            ],
            'publish' => [
                [
                    'id' => 'config',
                    'description' => 'The config of smartship merauke.',
                    'source' => __DIR__ . '/../publish/merauke.php',
                    'destination' => BASE_PATH . '/config/autoload/merauke.php',
                ],
            ],
        ];
    }
}