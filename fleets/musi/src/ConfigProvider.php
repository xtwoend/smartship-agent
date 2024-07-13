<?php

namespace Smartship\Musi;

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
                \Smartship\Musi\Handler::class => \Smartship\Musi\HandlerFactory::class
            ],
            'publish' => [
                [
                    'id' => 'config',
                    'description' => 'The config of smartship musi.',
                    'source' => __DIR__ . '/../publish/musi.php',
                    'destination' => BASE_PATH . '/config/autoload/musi.php',
                ],
            ],
        ];
    }
}