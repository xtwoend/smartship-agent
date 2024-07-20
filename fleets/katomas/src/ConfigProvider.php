<?php

namespace Smartship\Katomas;

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
                \Smartship\Katomas\Handler::class => \Smartship\Katomas\HandlerFactory::class
            ],
            'publish' => [
                [
                    'id' => 'config',
                    'description' => 'The config of smartship katomas.',
                    'source' => __DIR__ . '/../publish/katomas.php',
                    'destination' => BASE_PATH . '/config/autoload/katomas.php',
                ],
            ],
        ];
    }
}