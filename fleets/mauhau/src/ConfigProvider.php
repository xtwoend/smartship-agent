<?php

namespace Smartship\Mauhau;

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
                \Smartship\Mauhau\Handler::class => \Smartship\Mauhau\HandlerFactory::class
            ],
            'publish' => [
                [
                    'id' => 'config',
                    'description' => 'The config of smartship mauhau.',
                    'source' => __DIR__ . '/../publish/mauhau.php',
                    'destination' => BASE_PATH . '/config/autoload/mauhau.php',
                ],
            ],
        ];
    }
}