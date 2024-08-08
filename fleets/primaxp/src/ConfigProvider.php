<?php

namespace Smartship\Primaxp;

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
                \Smartship\Primaxp\Handler::class => \Smartship\Primaxp\HandlerFactory::class
            ],
            'publish' => [
                [
                    'id' => 'config',
                    'description' => 'The config of smartship primaxp.',
                    'source' => __DIR__ . '/../publish/primaxp.php',
                    'destination' => BASE_PATH . '/config/autoload/primaxp.php',
                ],
            ],
        ];
    }
}