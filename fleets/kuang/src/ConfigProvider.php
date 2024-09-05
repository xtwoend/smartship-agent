<?php

namespace Smartship\Kuang;

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
                \Smartship\Kuang\Handler::class => \Smartship\Kuang\HandlerFactory::class
            ],
            'publish' => [
                [
                    'id' => 'config',
                    'description' => 'The config of smartship kuang.',
                    'source' => __DIR__ . '/../publish/kuang.php',
                    'destination' => BASE_PATH . '/config/autoload/kuang.php',
                ],
            ],
        ];
    }
}