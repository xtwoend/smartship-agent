<?php

namespace App\Mqtt\Kakap;

use Carbon\Carbon;
use Hyperf\Utils\Str;
use Hyperf\Utils\Codec\Json;

class Alarm
{
    protected string $message;

    public function __construct(string $message) {
       
        $this->message = $message;
    }
    
    public function extract()
    {
        $data = Json::decode($this->message);
        $value = $data['alarm_status'];

        $alarms = [];
        foreach($value as $index => $val) {
            if($val) {
                $alarms[] = [
                    'property' => 'ams',
                    'property_key' => $index,
                    'message' => $this->mapArray[$index]
                ];
            }
        }

        return [
            'alarm' => $alarms
        ];
    }

    function arrayToSnake() : array {
        $snake = [];
        foreach($this->mapArray as $in => $val) {
            if(is_null($val)) continue;
            $key = Str::snake(strtolower($val));
            $snake[$key] = $in;
        } 
        return $snake;
    }

    protected $mapArray = [
        'TRUST BEARING TEMPERATURE',
        'FUEL OIL LEAKAGE INJECTION PIPES',
        'FUEL OIL LEAKAGE DIRTY FUEL ',
        'CHARGE AIR BYPASS VALVE POSITION FAILURE',
        'OIL MIST DETECTOR FAILURE',
        'OIL MIST DETECTOR ALARM & LOAD REDUCTION',
        'TRUNING GEAR POSITION',
        'STOP LEVER IN STOP POSITION',
        'ENGINE SPEED SENSOR FAILUR PRIMARY',
        'ENGINE SPEED SENSOR FALURE SECONDARY',
        'ENGINE READY FOR STAR',
        'ENGINE START BLOCK ACTIVE',
        'LOCAL CONTROL MODE',
        'START FAILURE',
        'LOAD REDUCTION REQUEST',
        'STOP SHUTDOWN OVERRIDE',
        'ENGINE BLOW',
        'ENGINE NOR PRE LUBRICATED',
        'TURNING GEAR ENGAGED',
        'STOP LEVEL IN STOP POSITION',
        'LOCAL SELECTOR IN BLOCKED POSTION',
        'ENTERNAL START BLOCKING 1',
        'ENTERNAL START BLOCKING 2',
        'ENTERNAL START BLOCKING 3',
        'CHARGE AIR SHUT OFF VALVE POSITION',
        'ENGINE SPEED SENSOR FAILURE EMERGENCY',
        'OVERSPEED SHUTDOWN STATUSFROM ESM',
        'LUBE OIL PRESS SHUTDOWN STATUS FROM ESM',
        'OILMIST DETECTOR SHUTDOWN',
        NULL,
        NULL,
        'EXTERNAL SHUTDOWN STATUS  1',
        'EXTERNAL SHUTDOWN STATUS  2',
        'EXTERNAL SHUTDOWN STATUS  3',
        'EMERGENCY STOP FROM ESM',
        'TEMPERATURE IN MCM 11-1',
        'TEMPERATURE IN MCM 11-2',
        'TEMPERATURE IN IOM DE',
        'TEMPERATURE IN IOM FE',
        'TEMPERATURE IN IOM TC',
        'TEMPERATURE IN IOM A1',
        'TEMPERATURE IN IOM A2',
        'TEMPERATURE IN IOM A3',
        NULL,
        'CA SHUT OFF VALVE POSITION',
        'PDM SYSTEM SUPPLY EATRH FAULT',
        NULL,
        'PDM SYSTEM SUPPLY FAILURE',
        NULL,
        NULL,
    ];
}