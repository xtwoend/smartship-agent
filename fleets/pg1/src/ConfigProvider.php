<?php

namespace Smartship\Pg1;

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
                \Smartship\Pg1\Handler::class => \Smartship\Pg1\HandlerFactory::class
            ],
            'publish' => [
                [
                    'id' => 'config',
                    'description' => 'The config of smartship pg1.',
                    'source' => __DIR__ . '/../publish/pg1.php',
                    'destination' => BASE_PATH . '/config/autoload/pg1.php',
                ],
            ],
        ];
    }
}