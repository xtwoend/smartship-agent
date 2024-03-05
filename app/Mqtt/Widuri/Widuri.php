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
namespace App\Mqtt\Widuri;

class Widuri
{
    protected $raw;

    protected $time;

    protected $attributes = [];

    protected $append = ['cargo_tanks'];

    public function __construct($raw)
    {
        $this->raw = $raw;
    }

    public function __get($name)
    {
        if (array_key_exists($name, $this->attributes)) {
            switch ($name) {
                case 'gps':
                case 'anemometer':
                case 'heading':
                case 'echosounder':
                case 'cog':
                case 'loadingdata':
                case 'loadingweight':
                case 'grade':
                    $data = $this->{"_{$name}"}($this->attributes[$name]);
                    break;
                case '_terminaltime':
                case '_groupname':
                    $data = (string) $this->attributes[$name];
                    break;
                case 'cargo_tanks':
                    $data = $this->cargoTanks();
                    break;
                default:
                    $data = (float) $this->attributes[$name];
                    break;
            }

            return $data;
        }
        return null;
    }

    public function getRaw()
    {
        return $this->raw;
    }

    public function extract()
    {
        try {
            $arrayData = json_decode($this->raw, true);
            $this->attributes = array_change_key_case($arrayData, CASE_LOWER);
            if (count($this->append) > 0) {
                foreach ($this->append as $key) {
                    $this->attributes[$key] = $this->{$key};
                }
            }
            return $this;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function toArray(): array
    {
        $keys = array_keys($this->attributes);
        $attributes = [];
        foreach ($keys as $key) {
            $attributes[$key] = $this->{$key};
        }
        $data = $this->formatting($attributes);

        return (array) $data;
    }

    public function coordinate(array $coordinate)
    {
        $lat = $coordinate['lat'];
        $lng = $coordinate['lng'];

        return $coordinate;
    }

    protected function _gps($data)
    {
        preg_match_all('/(\w+\.+\w+)(,S,|,W,|,N,|,E,)/', $data, $ext);
        // https://student-activity.binus.ac.id/himtek/2017/10/31/cara-membaca-gps-dan-menghitung-koordinat-latitude-longitude/
        // 06 degree 05menit .9353 second,S

        $value = $ext[0];

        $coordinate = (array) [
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
        $lat = $lat + $second;

        if (strtoupper($pos) == 'S') {
            $lat = $lat * -1;
        }

        return [
            round($lat, 6, PHP_ROUND_HALF_UP), $pos,
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
        $lng = (int) ($lng[0] / 100);
        $lng = $lng + $second;

        if (strtoupper($pos) == 'W') {
            $lng = $lng * -1;
        }

        return [
            round($lng, 6, PHP_ROUND_HALF_UP), $pos,
        ];
    }

    protected function _anemometer($data)
    {
        preg_match('/(WV,)(\w+\.+\w+)/', $data, $direction);
        preg_match('/(,R,)(\w+\.+\w+)/', $data, $speed);

        if (count($direction) > 2 && count($speed) > 2) {
            return (array) [
                'wind_direction' => (float) $direction[2],
                'wind_speed' => (float) $speed[2],
            ];
        }

        return [
            'wind_direction' => (float) 0,
            'wind_speed' => (float) 0,
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
                'travel_accumulation' => (float) $acc[2],
            ];
        }
        return (array) [
            'heading' => (float) 0,
            'travel_accumulation' => (float) 0,
        ];
    }

    protected function _echosounder($data)
    {
        preg_match('/(PT,)(\w+\.+\w+)/', $data, $depth);
        if (count($depth) > 2) {
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

    protected function _loadingdata($data)
    {
        $ex = explode(',', $data);

        if (count($ex) > 7) {
            return [
                'level_1_stb' => (float) $ex[1],
                'level_1_port' => (float) $ex[2],
                'level_2_stb' => (float) $ex[3],
                'level_2_port' => (float) $ex[4],
                'level_3_stb' => (float) $ex[5],
                'level_3_port' => (float) $ex[6],
            ];
        }

        // return $data;
    }

    protected function _loadingweight($data)
    {
        $ex = explode(',', $data);

        // margin of error

        if (count($ex) > 7) {
            return [
                'weight_1_stb' => (float) $ex[1],
                'weight_1_port' => (float) $ex[2],
                'weight_2_stb' => (float) $ex[3],
                'weight_2_port' => (float) $ex[4],
                'weight_3_stb' => (float) $ex[5],
                'weight_3_port' => (float) $ex[6],
            ];
        }

        // return $data;
    }

    protected function _grade($data)
    {
        $ex = explode(',', $data);

        if (count($ex) > 7) {
            return [
                'grade_1_stb' => $ex[1] . 'E',
                'grade_1_port' => $ex[2] . 'E',
                'grade_2_stb' => $ex[3] . 'E',
                'grade_2_port' => $ex[4] . 'E',
                'grade_3_stb' => $ex[5] . 'E',
                'grade_3_port' => $ex[6] . 'E',
            ];
        }

        // return $data;
    }

    protected function formatting(array $data): array
    {
        return [
            'Fleet_time' => \Carbon\Carbon::parse($data['_terminaltime'])->format('Y-m-d H:i:s'),
            'latitude' => $data['gps']['lat'],
            'longitude' => $data['gps']['lng'],
            'cog' => $data['cog']['cog'],
            'sog' => $data['cog']['sog'],
            'deep' => $data['echosounder']['depth'] ?? 0,
            'distance' => $data['heading']['travel_accumulation'] ?? 0,
            'wind_direction' => $data['anemometer']['wind_direction'],
            'wind_speed' => $data['anemometer']['wind_speed'],
            'heading' => $data['heading']['heading'],
            'grade_ct1_stb' => $data['grade']['grade_1_stb'],
            'grade_ct1_port' => $data['grade']['grade_1_port'],
            'grade_ct2_stb' => $data['grade']['grade_2_stb'],
            'grade_ct2_port' => $data['grade']['grade_2_port'],
            'grade_ct3_stb' => $data['grade']['grade_3_stb'],
            'grade_ct3_port' => $data['grade']['grade_3_port'],
            'level_ct1_stb' => $data['loadingdata']['level_1_stb'],
            'level_ct1_port' => $data['loadingdata']['level_1_port'],
            'level_ct2_stb' => $data['loadingdata']['level_2_stb'],
            'level_ct2_port' => $data['loadingdata']['level_2_port'],
            'level_ct3_stb' => $data['loadingdata']['level_3_stb'],
            'level_ct3_port' => $data['loadingdata']['level_3_port'],
            'weight_ct1_stb' => $data['loadingweight']['weight_1_stb'],
            'weight_ct1_port' => $data['loadingweight']['weight_1_port'],
            'weight_ct2_stb' => $data['loadingweight']['weight_2_stb'],
            'weight_ct2_port' => $data['loadingweight']['weight_2_port'],
            'weight_ct3_stb' => $data['loadingweight']['weight_3_stb'],
            'weight_ct3_port' => $data['loadingweight']['weight_3_port'],
            'total_cargo_1' => $data['loadingweight']['weight_1_stb'] + $data['loadingweight']['weight_1_port'],
            'total_cargo_2' => $data['loadingweight']['weight_2_stb'] + $data['loadingweight']['weight_2_port'],
            'total_cargo_3' => $data['loadingweight']['weight_3_stb'] + $data['loadingweight']['weight_3_port'],
            'total_all_cargo' => $data['loadingweight']['weight_1_stb'] + $data['loadingweight']['weight_1_port'] + $data['loadingweight']['weight_2_stb'] + $data['loadingweight']['weight_2_port'] + $data['loadingweight']['weight_3_stb'] + $data['loadingweight']['weight_3_port'],
            'dwp1_stb' => $data['dwp1_stb'],
            'dwp1_port' => $data['dwp1_port'],
            'dwp2_stb' => $data['dwp2_stb'],
            'dwp2_port' => $data['dwp2_port'],
            'dwp3_stb' => $data['dwp3_stb'],
            'dwp3_port' => $data['dwp3_port'],
            'hfo_bunker' => $data['hfobunkertank'],
            'hfo_service' => $data['hfoservicetank'],
            'hfo_setling' => $data['hfosetlingtank'],
            'fwd_hfo' => $data['fwdhfobunkertank'],
            'lshfo_bunker' => $data['lshfobunkertank'],
            'lshfo_service' => $data['lshfoservicetank'],
            'lshfo_setling' => $data['lshfosetlingtank'],
            'mdo_service' => $data['mdoservicetank'],
            'mdo_storage' => $data['mdostoragetank'],
            'igg_fuel' => $data['iggfueltank'],
            'total_hfo' => $data['hfobunkertank'] + $data['hfoservicetank'] + $data['hfosetlingtank'],
            'total_lshfo' => $data['lshfobunkertank'] + $data['lshfoservicetank'] + $data['lshfosetlingtank'],
            'total_mdo' => $data['mdoservicetank'] + $data['mdostoragetank'],
            'total_igg' => $data['iggfueltank'],
            'total_bunker_all' => $data['hfobunkertank'] + $data['hfoservicetank'] + $data['hfosetlingtank'] + $data['lshfobunkertank'] + $data['lshfoservicetank'] + $data['lshfosetlingtank'] + $data['mdoservicetank'] + $data['mdostoragetank'] + $data['iggfueltank'],
            'lo_inlet_pressure' => $data['meloinletpressure'],
            'jfw_inlet_pressure' => $data['mejfwinletpressure'],
            'fuel_viscosity' => $data['mehfoviscocity'],
            // "rpm_me" => $data['merpmindicator'],
            // "rpm_tc" => $data['meturbocharge'],
            'rpm_me' => $data['meturbocharge'],
            'rpm_tc' => $data['merpmindicator'],
            'cargo_tanks' => $this->cargoTanks(),
        ];
    }

    protected function cargoTanks(): array
    {
        $cargos = [];

        for ($i = 1; $i <= 3; ++$i) {
            $cargos[$i][] = [
                'cargo' => $i,
                'level' => $this->loadingdata["level_{$i}_stb"],
                'weight' => $this->loadingweight["weight_{$i}_stb"],
                'grade' => $this->grade["grade_{$i}_stb"],
                'pump' => $this->{"dwp{$i}_stb"},
                'position' => 'STB',
                'total' => $this->loadingweight["weight_{$i}_stb"] + $this->loadingweight["weight_{$i}_port"],
            ];
            $cargos[$i][] = [
                'cargo' => $i,
                'level' => $this->loadingdata["level_{$i}_port"],
                'weight' => $this->loadingweight["weight_{$i}_port"],
                'grade' => $this->grade["grade_{$i}_port"],
                'pump' => $this->{"dwp{$i}_port"},
                'position' => 'PORT',
                'total' => $this->loadingweight["weight_{$i}_stb"] + $this->loadingweight["weight_{$i}_port"],
            ];
        }

        return $cargos;
    }
}
