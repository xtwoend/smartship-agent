<?php

namespace Smartship\Matindok;

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
                \Smartship\Matindok\Handler::class => \Smartship\Matindok\HandlerFactory::class
            ],
            'publish' => [
                [
                    'id' => 'config',
                    'description' => 'The config of smartship matindok.',
                    'source' => __DIR__ . '/../publish/matindok.php',
                    'destination' => BASE_PATH . '/config/autoload/matindok.php',
                ],
            ],
        ];
    }
}