<?php

namespace App\Mqtt\Walio\VDR;

use Carbon\Carbon;

class VDR
{
    protected $message;

    protected $data;

    public function __construct(string $message) {
        $this->message = $message;
    }

    public function parse()
    {
        $parse = [];
        if(str_contains($this->message, '$GPRMC')) {
            $parse = $this->parseGPS($this->message);
        }elseif(str_contains($this->message, 'HDT')) {
            $parse = $this->parseHeading($this->message);
        }elseif(str_contains($this->message, 'MWV')) {
            $parse = $this->parseMWV($this->message);
        }elseif(str_contains($this->message, 'VTG')) {
            $parse = $this->parseVTG($this->message);
        }elseif(str_contains($this->message, 'DTM')) {
            $parse = $this->parseDTM($this->message);
        }elseif(str_contains($this->message, 'VLW')) {
            $parse = $this->parseVLW($this->message);
        }elseif(str_contains($this->message, 'DPT')) {
            $parse = $this->parseDPT($this->message);
        }elseif(str_contains($this->message, 'ROT')) {
            $parse = $this->parseROT($this->message);
        }

        return $parse;
    }

    protected function parseGPS(string $message)
    {   
        $aData  = explode(',', $message);
        
        $time   = $aData[1];
        $lat    = $aData[3];
        $latDir = $aData[4];
        $lng    = $aData[5];
        $lngDir = $aData[6];
        $sog    = $aData[7];
        $cog    = $aData[8];
        $date   = $aData[9];

        $terminal_time = Carbon::createFromFormat('dmy His', $date .' '. explode('.', $time)[0]);
        
        $lat = DMSToDec($lat, $latDir);
        $lng = DMSToDec($lng, $lngDir);
        
        return [
            'terminal_time' => (string) $terminal_time->format('Y-m-d H:i:s'),
            'lat' =>  (float) $lat,
            'lat_dir' => (string) $latDir,
            'lng' => (float) $lng,
            'lng_dir' => (string) $lngDir
        ];
    }

    protected function parseHeading(string $message)
    {
        $aData  = explode(',', $message);
        $heading   = $aData[1];

        return [
            'heading' => (float) $heading
        ];
    }

    public function parseMWV(string $message)
    {
        $aData  = explode(',', $message);

        return [
            'wind_direction' => (float) $aData[1],
            'wind_speed' => (float) $aData[3]
        ];
    }

    public function parseVTG(string $message)
    {
        $aData  = explode(',', $message);
       
        return [
            'cog' => $aData[1] <= 360 ? (float) $aData[1] : NULL,
            'sog' => $aData[5] <= 50 ? (float) $aData[5] : NULL,
        ];
    }

    public function parseDTM(string $message)
    {
        $aData  = explode(',', $message);

        return [
            'datum_refrence' => (string) $aData[1]
        ];
    }

    public function parseVLW(string $message)
    {
        $aData  = explode(',', $message);
        
        return [
            'total_distance' => (float) $aData[1],
            'distance' => (float) $aData[3]
        ];
    }

    public function parseDPT(string $message)
    {
        $aData  = explode(',', $message);

        return [
            'depth' => (float) $aData[1]
        ];
    }

    public function parseROT(string $message)
    {
        $aData  = explode(',', $message);

        return [
            'rot' => (float) $aData[1]
        ];
    }

    public function extract(): ?array
    {
        return ['nav' => $this->parse()];
    }

    protected function _longitude($val, $pos)
    {
        $second = (float) substr($val, -7);
        $second = $second / 60;
        
        $lng = explode('.', $val);
        $lng = (int) ($lng[0]/100);
        $lng = $lng + $second;

        if (strtoupper($pos) == 'W') {
            $lng = $lng * -1;
        }

        return [
            round($lng, 6, PHP_ROUND_HALF_UP), $pos
        ];
    }

    protected function _latitude($latString, $pos)
    {
        $second = (float) substr($latString, -7);
        $second = $second / 60;
        
        $lat = explode('.', $latString);
        $lat = (int) ($lat[0] / 100);
        $lat =  $lat + $second;
    
        
        if (strtoupper($pos) == 'S') {
            $lat = $lat * -1;
        }

        return [
            round($lat, 6, PHP_ROUND_HALF_UP), $pos
        ];
    }
}