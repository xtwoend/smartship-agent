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
    function websocket_emit(string $fleet, string $event, array $data): void
    {
        $io = container()->get(\Hyperf\SocketIOServer\SocketIO::class);
        $io->to($fleet)->emit($event, Json::encode($data));
    } 
}


if(! function_exists('number')) {
    function number($number, $digit = 2) {
        return number_format($number, $digit, ",",".");
    }
}

if(! function_exists('decToDMS')) {
    function decToDMS($latitude, $longitude) {
        $latitudeDirection = $latitude < 0 ? 'S': 'N';
        $longitudeDirection = $longitude < 0 ? 'W': 'E';

        $latitudeNotation = $latitude < 0 ? '-': '';
        $longitudeNotation = $longitude < 0 ? '-': '';

        $latitudeInDegrees = floor(abs($latitude));
        $longitudeInDegrees = floor(abs($longitude));

        $latitudeDecimal = abs($latitude)-$latitudeInDegrees;
        $longitudeDecimal = abs($longitude)-$longitudeInDegrees;

        $_precision = 4;
        $latitudeMinutes = round($latitudeDecimal*60,$_precision);
        $longitudeMinutes = round($longitudeDecimal*60,$_precision);

        return sprintf('%02d%s,%s,%03d%s,%s',
            $latitudeInDegrees,
            $latitudeMinutes,
            $latitudeDirection,
            $longitudeInDegrees,
            $longitudeMinutes,
            $longitudeDirection
        );

        // return sprintf('%s%s° %s %s %s%s° %s %s',
        //     $latitudeNotation,
        //     $latitudeInDegrees,
        //     $latitudeMinutes,
        //     $latitudeDirection,
        //     $longitudeNotation,
        //     $longitudeInDegrees,
        //     $longitudeMinutes,
        //     $longitudeDirection
        // );
    }
}

if(! function_exists('latDMSToDec')) {
    function latDMSToDec($string, $dir) {
        $deg = (int) substr($string, 0, 2);
        $min = (float) substr($string, 2, -1);

        $lat = $deg + ($min / 60);
 
        if(strtoupper($dir) == 'S') {
            $lat = $lat * -1;
        }

        return $lat;
    }
}

// $GPGGA,143202.84,0259.0736,S,10450.3807,E,1,12,01,+0024,M,+004,M,,*55

if(! function_exists('lngDMSToDec')) {
    function lngDMSToDec($string, $dir) {

        $deg = (int) substr($string, 0, 3);
        $min = (float) substr($string, 3, -1);

        $lat = $deg + ( $min / 60 );

        if(strtoupper($dir) == 'W') {
            $lat = $lat * -1;
        }

        return $lat;
    }
}