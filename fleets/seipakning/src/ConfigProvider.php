<?php

namespace Smartship\Seipakning;

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
                Smartship\Seipakning\Handler::class => Smartship\Seipakning\HandlerFactory::class
            ],
            'publish' => [
                [
                    'id' => 'config',
                    'description' => 'The config of smartship seipakning.',
                    'source' => __DIR__ . '/../publish/seipakning.php',
                    'destination' => BASE_PATH . '/config/autoload/seipakning.php',
                ],
            ],
        ];
    }
}