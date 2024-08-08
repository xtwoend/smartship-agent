<?php

namespace Smartship\Pagaden;

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
                \Smartship\Pagaden\Handler::class => \Smartship\Pagaden\HandlerFactory::class
            ],
            'publish' => [
                [
                    'id' => 'config',
                    'description' => 'The config of smartship pagaden.',
                    'source' => __DIR__ . '/../publish/pagaden.php',
                    'destination' => BASE_PATH . '/config/autoload/pagaden.php',
                ],
            ],
        ];
    }
}