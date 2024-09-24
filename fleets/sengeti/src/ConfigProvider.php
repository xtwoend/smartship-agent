<?php

namespace Smartship\Sengeti;

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
                \Smartship\Sengeti\Handler::class => \Smartship\Sengeti\HandlerFactory::class
            ],
            'publish' => [
                [
                    'id' => 'config',
                    'description' => 'The config of smartship sengeti.',
                    'source' => __DIR__ . '/../publish/sengeti.php',
                    'destination' => BASE_PATH . '/config/autoload/sengeti.php',
                ],
            ],
        ];
    }
}