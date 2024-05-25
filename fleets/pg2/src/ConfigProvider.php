<?php

namespace Smartship\Pg2;

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
                \Smartship\Pg2\Handler::class => \Smartship\Pg2\HandlerFactory::class
            ],
            'publish' => [
                [
                    'id' => 'config',
                    'description' => 'The config of smartship pg2.',
                    'source' => __DIR__ . '/../publish/pg2.php',
                    'destination' => BASE_PATH . '/config/autoload/pg2.php',
                ],
            ],
        ];
    }
}