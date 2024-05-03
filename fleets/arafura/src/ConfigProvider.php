<?php

namespace Smartship\Arafura;

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
                \Smartship\Arafura\Handler::class => \Smartship\Arafura\HandlerFactory::class
            ],
            'publish' => [
                [
                    'id' => 'config',
                    'description' => 'The config of smartship arafura.',
                    'source' => __DIR__ . '/../publish/arafura.php',
                    'destination' => BASE_PATH . '/config/autoload/arafura.php',
                ],
            ],
        ];
    }
}