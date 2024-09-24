<?php

namespace Smartship\SangaSanga;

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
                \Smartship\SangaSanga\Handler::class => \Smartship\SangaSanga\HandlerFactory::class
            ],
            'publish' => [
                [
                    'id' => 'config',
                    'description' => 'The config of smartship Sanga Sanga.',
                    'source' => __DIR__ . '/../publish/sanga.php',
                    'destination' => BASE_PATH . '/config/autoload/sanga.php',
                ],
            ],
        ];
    }
}