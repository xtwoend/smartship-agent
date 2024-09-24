<?php

namespace Smartship\Klawotong;

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
                \Smartship\Klawotong\Handler::class => \Smartship\Klawotong\HandlerFactory::class
            ],
            'publish' => [
                [
                    'id' => 'config',
                    'description' => 'The config of smartship klawotong.',
                    'source' => __DIR__ . '/../publish/klawotong.php',
                    'destination' => BASE_PATH . '/config/autoload/klawotong.php',
                ],
            ],
        ];
    }
}