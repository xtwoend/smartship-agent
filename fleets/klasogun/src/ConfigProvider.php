<?php

namespace Smartship\Klasogun;

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
                \Smartship\Klasogun\Handler::class => \Smartship\Klasogun\HandlerFactory::class
            ],
            'publish' => [
                [
                    'id' => 'config',
                    'description' => 'The config of smartship klasogun.',
                    'source' => __DIR__ . '/../publish/klasogun.php',
                    'destination' => BASE_PATH . '/config/autoload/klasogun.php',
                ],
            ],
        ];
    }
}