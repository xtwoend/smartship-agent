<?php

namespace App\Mqtt\Arar;

use Carbon\Carbon;
use Hyperf\Utils\Str;
use Hyperf\Utils\Codec\Json;

class Ams
{
    protected string $message;

    public function __construct(string $message) {
       
        $this->message = $message;
    }
    
    public function extract()
    {
        $data = Json::decode($this->message);
        $arrayAms = $data['values'];
        $alarms = [];
        $keys = [
            'arar_engine.arar_me.New PLC 1.21' => 'channel21',
            'arar_engine.arar_me.New PLC 1.22' => 'channel22',
            'arar_engine.arar_me.New PLC 1.23' => 'channel23',
            'arar_engine.arar_me.New PLC 1.24' => 'channel24',
            'arar_engine.arar_me.New PLC 1.400' => 'channel400',
            'arar_engine.arar_me.New PLC 1.401' => 'channel401',
            'arar_engine.arar_me.New PLC 1.500' => 'channel500',
            'arar_engine.arar_me.New PLC 1.501' => 'channel501',
        ];
        foreach($arrayAms as $ams) {
            
            $aName = $keys[$ams['id']] ?? null;
            if(is_null($aName)) continue;
        
            $array = Json::decode($ams['v']);
            foreach($array as $index => $val) {
                if(! isset($this->{$aName}[$index])) continue;
                if($val == 1) {
                    $alarms[] = [
                        'property' => 'ams_' . $aName,
                        'property_key' => $index,
                        'message' => $this->{$aName}[$index] ?? NULL
                    ];
                }
                
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

    protected $channel21 = [
        'ME RUN IND',
        'ME ALARM REPOSE1 IND',
        'ME ALARM REPOSE2 IND',
        'ME EMERGENCY STOP IND',
        'ME LO LOW PRESS SHUTDOWN IND',
        'ME OVERSPEED SHUTDOWN IND',
        'ME OIL MIST HIGH SHUTDOWN PRE W IND',
        'ME OIL MIST HIGH SHUTDOWN IND',
        'ME OIL MIST HIGH SHUTDOWN OVERRIDE IND',
        'ME FW HIGH TEMP SHUTDOWN PRE W IND',
        'ME FW HIGH TEMP SHUTDOWN IND',
        'RG LO LOW PRESS SHUTDOWN PRE W IND',
        'RG LO LOW PRESS SHUTDOWN IND',
        'ME AUTO SHUTDWN OVERRIDE IND',
        'AHD BRG H TEMP SLOWDOWN PRE W IND',
        'ASSIST LOW PRESS IND',
    ];

    protected $channel22 = [
        'CLUTCH LO HIGH TEMP SHUTDOWN PRE W IND',
        'ME AUTO SLOWDOWN IND',
        'ME AUTO SLOWDOWN OVERRIDE IND',
        'WH EMCY STOP PB LINE BREAK IND',
        'CR EMCY STOP PB LINE BREAK IND',
        'ME LO LOW PRESS SD SW LINE B IND',
        'OIL MIST HIGH SD SW LINE B IND',
        'ME FW HIGH TEMP SD SW LINE B IND',
        'RG LO LOW PRESS SD SW LINE B IND',
        'SAFETY STOP MV LINE B IND',
        'AHD BRG H T SLD SW LINE B IND',
        'CL LO H T SLD SW LINE B IND',
        'ME SPEED SW ABNORMAL IND',
        'ME HANDLE SW ABNORMAL IND',
    ];

    protected $channel23 = [
        'OIL MIST DETECTOR FAULT IND',
        'ME OILMIST HIGH IND',
        'TC LO LOW PRESS IND',
        'ME FO LEAKAGE IND',
        'ME LO FILTER DIFF PRESS HIGH IND',
        'START AIR LOW PRESS IND',
        'MONITOR ACDC CONV ABNORMAL IND',
        'MONITOR DCDC CONV ABNORMAL IND',
        'AST BRG H TEMP SLOWDOWN PRE W IND',
        'AST BRG H TEMP SLOWDOWN SW LINE B IND',
        'START FAIL IND',
    ];

    protected $channel24 = [
        'ME LO PRESS IND',
        'ME FO PRESS IND',
        'ME H TEMP FW PRESS IND',
        'CONTROL AIR PRESSURE IND',
        'ME LO INLET TEMP IND',
        'ME FW HIGH TEMP OUTLET TEMP IND',
    ];

    protected $channel400 = [
        'ME REV SPEED HIGH ALARM',
        'TC REV SPEED HIGH ALARM',
        'ME FO RACK HIGH ALARM',
        'PROPELLER REV HIGH ALARM',
        'ME LO PRESS HIGH ALARM',
        'ME FO PRESS HIGH ALARM',
        'ME H TEMP FW PRESS HIGH ALARM',
        'BOOSTER AIR PRESSURE HIGH ALARM',
        'CONTROL AIR PRESSURE HIGH ALARM',
        'ME LO INLET TEMP HIGH ALARM',
        'ME FW HIGH TEMP OUTLET TEMP HIGH ALARM',
        'ME BOOSTER AIR EMP HIGH ALARM',
        'ME EXH NO1 CYL TEMP HIGH ALARM',
        'ME EXH NO2 CYL TEMP HIGH ALARM',
        'ME EXH NO3 CYL TEMP HIGH ALARM',
        'ME EXH NO4 CYL TEMP HIGH ALARM',
    ];

    protected $channel401 = [
        'ME EXH NO5 CYL TEMP HIGH ALARM',
        'ME EXH NO6 CYL TEMP HIGH ALARM',
        'ME EXH NO7 CYL TEMP HIGH ALARM',
        'ME EXH NO8 CYL TEMP HIGH ALARM',
        'TC EXH IN TEMP1 HIGH ALARM',
        'TC EXH IN TEMP2 HIGH ALARM',
        'TC EXH OUT TEMP HIGH ALARM',
    ];

    protected $channel500 = [
        'ME REV SPEED LOW ALARM',
        'TC REV SPEED LOW ALARM',
        'ME FO RACK LOW ALARM',
        'PROPELLER REV LOW ALARM',
        'ME LO PRESS LOW ALARM',
        'ME FO PRESS LOW ALARM',
        'ME H TEMP FW PRESS LOW ALARM',
        'BOOSTER AIR PRESSURE LOW ALARM',
        'CONTROL AIR PRESSURE LOW ALARM',
        'ME LO INLET TEMP LOW ALARM',
        'ME FW HIGH TEMP OUTLET TEMP LOW ALARM',
        'ME BOOSTER AIR EMP LOW ALARM',
        'ME EXH NO1 CYL TEMP LOW ALARM',
        'ME EXH NO2 CYL TEMP LOW ALARM',
        'ME EXH NO3 CYL TEMP LOW ALARM',
        'ME EXH NO4 CYL TEMP LOW ALARM',
    ];

    protected $channel501 = [
        'ME EXH NO5 CYL TEMP LOW ALARM',
        'ME EXH NO6 CYL TEMP LOW ALARM',
        'ME EXH NO7 CYL TEMP LOW ALARM',
        'ME EXH NO8 CYL TEMP LOW ALARM',
        'TC EXH IN TEMP1 LOW ALARM',
        'TC EXH IN TEMP2 LOW ALARM',
        'TC EXH OUT TEMP LOW ALARM',
    ];
}