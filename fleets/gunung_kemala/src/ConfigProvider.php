<?php

namespace Smartship\GunungKemala;

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
                \Smartship\GunungKemala\Handler::class => \Smartship\GunungKemala\HandlerFactory::class
            ],
            'publish' => [
                [
                    'id' => 'config',
                    'description' => 'The config of smartship Gunung Kemala.',
                    'source' => __DIR__ . '/../publish/gunung_kemala.php',
                    'destination' => BASE_PATH . '/config/autoload/gunung_kemala.php',
                ],
            ],
        ];
    }
}