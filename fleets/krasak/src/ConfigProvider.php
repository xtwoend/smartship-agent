<?php

namespace Smartship\Krasak;

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
                \Smartship\Krasak\Handler::class => \Smartship\Krasak\HandlerFactory::class
            ],
            'publish' => [
                [
                    'id' => 'config',
                    'description' => 'The config of smartship krasak.',
                    'source' => __DIR__ . '/../publish/krasak.php',
                    'destination' => BASE_PATH . '/config/autoload/krasak.php',
                ],
            ],
        ];
    }
}