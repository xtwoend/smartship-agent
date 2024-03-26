<?php

namespace Smartship\Seipakning;

use Hyperf\Config\Config;
use Smartship\Seipakning\Handler;
use Psr\Container\ContainerInterface;


class HandlerFactory
{
    public function __construct(protected ContainerInterface $container)
    {
    }
    
    public function __invoke()
    {
        return new Handler;
    }
}