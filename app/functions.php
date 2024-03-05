<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
use Hyperf\Context\ApplicationContext;
use Hyperf\Utils\Codec\Json;
use Psr\EventDispatcher\EventDispatcherInterface;

if (! function_exists('calc_crow')) {
    function calc_crow($lat1, $lon1, $lat2, $lon2)
    {
        $radius = 6371; // in KM
        $dLat = to_rad($lat2 - $lat1);
        $dLon = to_rad($lon2 - $lat2);

        $a = sin($dLat / 2) * sin($dLat / 2) + sin($dLon / 2) * sin($dLon / 2) * cos($lat1) * cos($lat2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        return $radius * $c;
    }
}

if (! function_exists('to_rad')) {
    function to_rad($val)
    {
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

if (! function_exists('number')) {
    function number($number, $digit = 2)
    {
        return number_format($number, $digit, ',', '.');
    }
}

if (! function_exists('decToDMS')) {
    function decToDMS($latitude, $longitude)
    {
        // "H9DQ","FASTRON","$PROVIDER,231117,A,0145.4166,N,12329.4246,E,010.8,080.0,031214,000.0,*68"

        $latitudeDirection = $latitude < 0 ? 'S' : 'N';
        $longitudeDirection = $longitude < 0 ? 'W' : 'E';

        $latitudeNotation = $latitude < 0 ? '-' : '';
        $longitudeNotation = $longitude < 0 ? '-' : '';

        $latitudeInDegrees = floor(abs($latitude));
        $longitudeInDegrees = floor(abs($longitude));

        $latitudeDecimal = abs($latitude) - $latitudeInDegrees;
        $longitudeDecimal = abs($longitude) - $longitudeInDegrees;

        $_precision = 6;
        $latitudeMinutes = round($latitudeDecimal * 60, $_precision);
        $longitudeMinutes = round($longitudeDecimal * 60, $_precision);

        return sprintf(
            '%02d%.4f,%s,%03d%.4f,%s',
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

if (! function_exists('DMSToDec')) {
    function DMSToDec($string, $dir)
    {
        $dd = (int) ((float) $string / 100);
        $ss = $string - $dd * 100;
        $dec = $dd + $ss / 60;

        $dec = $d + ($m / 60) + (($s * 60) / 3600);

        if (strtoupper($dir) == 'S' || strtoupper($dir) == 'W') {
            $dec = $dec * -1;
        }

        return $dec;
    }
}

if (! function_exists('NMEADateAndTimeToTimestamp')) {
    function NMEADateAndTimeToTimestamp($utcTime, $date)
    {
        // Get day components
        $day = substr($date, 0, 2);
        $month = substr($date, 2, 2);
        $year = substr($date, 4, 2);

        // Get time components
        $hour = substr($utcTime, 0, 2);
        $minute = substr($utcTime, 2, 2);
        $seconds = substr($utcTime, 4, 2);

        // create time stamp
        return mktime($hour, $minute, $seconds, $month, $day, $year);
    }
}

if (! function_exists('nmeaParser')) {
    function nmeaParser(string $message)
    {
        $parser = new \BultonFr\NMEA\Parser();
        return $parser->readLine($message);
    }
}
