<?php

namespace Smartship\Primaxp;

use Smartship\Primaxp\Handler;
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