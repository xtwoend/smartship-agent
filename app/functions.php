<?php

use Hyperf\Utils\Codec\Json;
use Hyperf\Context\ApplicationContext;
use Psr\EventDispatcher\EventDispatcherInterface;


if(! function_exists('calc_crow')) {
    function calc_crow($lat1, $lon1, $lat2, $lon2) {
        $radius = 6371; // in KM
        $dLat = to_rad($lat2 - $lat1);
        $dLon = to_rad($lon2 - $lat2);

        $a = sin($dLat / 2) * sin($dLat / 2) + sin($dLon / 2) * sin($dLon/2) * cos($lat1) * cos($lat2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $d = $radius * $c;

        return $d;
    }
}

if(! function_exists('to_rad')) {
    function to_rad($val) {
        return ($val * pi()) / 180;
    }
}

if (! function_exists('dispatch')) {
    function dispatch($event, int $priority = 1)
    {
        $eventDispatcher = container()->get(EventDispatcherInterface::class);
        $eventDispatcher->dispatch($event, $priority);
    }
}


if (! function_exists('container')) {
    function container()
    {
        if (! ApplicationContext::hasContainer()) {
            throw new \RuntimeException('The application context lacks the container.');
        }

        return ApplicationContext::getContainer();
    }
}


if (! function_exists('websocket_emit')) {
    function websocket_emit(array $data): void
    {
        $io = container()->get(\Hyperf\SocketIOServer\SocketIO::class);
        $io->emit('listen', Json::encode($data));
    } 
}