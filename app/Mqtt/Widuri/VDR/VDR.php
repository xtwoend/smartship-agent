<?php

namespace App\Mqtt\Widuri\VDR;

class VDR
{
    protected $message;

    public function __construct(string $message) {
        var_dump($message);
        $this->message = $message;
    }

    public function parse()
    {
        // $parse = [
        //     'wind_speed' => $this->_anemometer($this->message)['wind_speed'],
        //     'wind_direction' => $this->_anemometer($this->message)['wind_direction'],
        //     'lat' => $this->_gps($this->message)['lat'][0],
        //     'lat_dir' =>  $this->_gps($this->message)['lat'][1],
        //     'lng' =>  $this->_gps($this->message)['lng'][0],
        //     'lng_dir' =>  $this->_gps($this->message)['lng'][1],
        //     'datum_refrence' => null,
        //     'sog' => $this->_cog($this->message)['sog'],
        //     'cog' => $this->_cog($this->message)['cog'],
        //     'total_distance' => $this->_heading($this->message)['travel_accumulation'],
        //     'distance' => 0,
        //     'heading' => $this->_heading($this->message)['heading'],
        //     'rot' => 0,
        //     'depth' => $this->_echosounder($this->message)['depth'],
        // ];
        // var_dump($parse);
        // return $parse;
        return [];
    }

    public function extract(): ?array
    {
        return ['nav' => $this->parse()];
    }


    protected function _gps($data)
    {
        preg_match_all('/(\w+\.+\w+)(,S,|,W,|,N,|,E,)/', $data, $ext);
        // https://student-activity.binus.ac.id/himtek/2017/10/31/cara-membaca-gps-dan-menghitung-koordinat-latitude-longitude/
        // 06 degree 05menit .9353 second,S

        $value = $ext[0];
        
        $coordinate =  (array)[
            'lat' => $this->_latitude($value[0]),
            'lng' => $this->_longitude($value[1]),
        ];

        return $this->coordinate($coordinate);
    }


    protected function _latitude($val)
    {
        preg_match('/([0-9.]*),(S|W|E|N)/', $val, $extract);

        $pos = $extract[2];
        $latString = $extract[1];

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

    protected function _longitude($val)
    {
        preg_match('/([0-9.]*),(S|W|E|N)/', $val, $extract);

        $pos = $extract[2];
        $lngString = $extract[1];

        $second = (float) substr($lngString, -7);
        $second = $second / 60;
        
        $lng = explode('.', $lngString);
        $lng = (int) ($lng[0]/100);
        $lng = $lng + $second;

        if (strtoupper($pos) == 'W') {
            $lng = $lng * -1;
        }

        return [
            round($lng, 6, PHP_ROUND_HALF_UP), $pos
        ];
    }

    protected function _anemometer($data)
    {
        preg_match('/(WV,)(\w+\.+\w+)/', $data, $direction);
        preg_match('/(,R,)(\w+\.+\w+)/', $data, $speed);

        if (count($direction) > 2 && count($speed) > 2) {
            return (array)[
                'wind_direction' => (float) $direction[2],
                'wind_speed' => (float) $speed[2]
            ];
        }

        return [
            'wind_direction' => (float) 0,
            'wind_speed' => (float) 0
        ];
    }

    protected function _heading($data)
    {
        // $VDVLW, nilai seleah ini adalah nilai travel accumulation
        preg_match('/(DT,)(\w+\.+\w+)/', $data, $ex);
        preg_match('/(VDVLW,)(\w+\.+\w+)/', $data, $acc);

        if (count($ex) > 2 && count($acc) > 2) {
            return (array) [
                'heading' => (float) $ex[2],
                'travel_accumulation' => (float) $acc[2]
            ];
        }
        return (array) [
            'heading' => (float) 0,
            'travel_accumulation' => (float) 0
        ];
    }

    protected function _echosounder($data)
    {
        preg_match('/(PT,)(\w+\.+\w+)/', $data, $depth);
        if(count($depth) > 2) {
            $deep = (float) $depth[2];
            return (array) [
                'depth' => (float) $deep * -1,
            ];
        }
        return ['depth' => 0];
    }

    protected function _cog($data)
    {
        preg_match('/(TG,)(\w+\.+\w+)/', $data, $cog);
        preg_match('/(M,)(\w+\.+\w+)/', $data, $sog);

        if (count($cog) > 2 && count($sog) > 2) {
            // // note: nilai kecepatan sog tidak lebih dari 30, dan minus nilai minus dan lebihbdari 30 di anulir
            $sog = ($sog[2] <= 30 && $sog[2] >= 0) ? $sog[2] : 0;

            return (array) [
                'cog' => (float) $cog[2],
                'sog' => (float) $sog,
            ];
        }
        return (array) [
            'cog' => (float) 0,
            'sog' => (float) 0,
        ];
    }
}