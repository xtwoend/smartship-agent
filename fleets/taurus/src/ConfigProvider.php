<?php

namespace Smartship\Taurus;

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
                \Smartship\Taurus\Handler::class => \Smartship\Taurus\HandlerFactory::class
            ],
            'publish' => [
                [
                    'id' => 'config',
                    'description' => 'The config of smartship taurus.',
                    'source' => __DIR__ . '/../publish/taurus.php',
                    'destination' => BASE_PATH . '/config/autoload/taurus.php',
                ],
            ],
        ];
    }
}