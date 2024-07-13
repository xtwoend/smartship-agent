<?php

namespace Smartship\Merauke;

use Smartship\Merauke\Handler;
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