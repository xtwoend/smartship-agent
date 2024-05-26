<?php

namespace Smartship\Bima;

use Smartship\Bima\Handler;
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