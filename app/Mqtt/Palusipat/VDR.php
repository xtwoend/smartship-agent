<?php

namespace App\Mqtt\Palusipat;

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
        $parse = null;
        if(str_contains($this->message, 'GGA')) {
            $parse = $this->parseGPS($this->message);
        }elseif(str_contains($this->message, 'HEHDT')) {
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

    protected function parseGPS(string $message, $header = 'GGA')
    {
        $aData  = explode(',', $message);
       
        $lat    = $aData[2];
        $latDir = $aData[3];
        $lng    = $aData[4];
        $lngDir = $aData[5]; // satellites count

        $lat = DMSToDec($lat, $latDir);
        $lng = DMSToDec($lng, $lngDir);

        return [
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
            'cog' => (float) $aData[1],
            'sog' => (float) $aData[5]
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