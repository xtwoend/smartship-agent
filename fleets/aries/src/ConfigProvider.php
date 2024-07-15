<?php

namespace Smartship\Aries;

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
                \Smartship\Aries\Handler::class => \Smartship\Aries\HandlerFactory::class
            ],
            'publish' => [
                [
                    'id' => 'config',
                    'description' => 'The config of smartship aries.',
                    'source' => __DIR__ . '/../publish/aries.php',
                    'destination' => BASE_PATH . '/config/autoload/aries.php',
                ],
            ],
        ];
    }
}