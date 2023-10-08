<?php

namespace App\Mqtt\Kakap;

use Carbon\Carbon;
use Hyperf\Utils\Str;
use Hyperf\Utils\Codec\Json;

class Alarm
{
    protected string $message;
    protected array $alarms;

    public function __construct(string $message) {
       
        $this->message = $message;
    }
    
    public function extract()
    {
        $data = Json::decode($this->message);
        $arrayAms = $data['values'];

        foreach($arrayAms as $ams) {
            switch ($ams['id']) {
                case 'arar_engine.arar_me.New PLC 1.21':
                    $this->setAlarm($ams['v'], 'channel21');
                    break;
                case 'arar_engine.arar_me.New PLC 1.22':
                    $this->setAlarm($ams['v'], 'channel22');
                    break;
                case 'arar_engine.arar_me.New PLC 1.23':
                    $this->setAlarm($ams['v'], 'channel23');
                    break;  
                case 'arar_engine.arar_me.New PLC 1.24':
                    $this->setAlarm($ams['v'], 'channel24');
                    break; 
                case 'arar_engine.arar_me.New PLC 1.400':
                    $this->setAlarm($ams['v'], 'channel400');
                    break;  
                case 'arar_engine.arar_me.New PLC 1.401':
                    $this->setAlarm($ams['v'], 'channel401');
                    break;
                case 'arar_engine.arar_me.New PLC 1.500':
                    $this->setAlarm($ams['v'], 'channel500');
                    break; 
                case 'arar_engine.arar_me.New PLC 1.501':
                    $this->setAlarm($ams['v'], 'channel501');
                    break;   
                default:
                    # code...
                    break;
            }
        }

        return [
            'alarm' => $this->alarms
        ];
    }

    function setAlarm(array $aValues, string $aName) : array {

        foreach($aValues as $index => $val) {
            
            if(! isset($this->{$aName}[$index])) continue;

            $this->alarms[] = [
                'property' => 'ams_' . $aName,
                'property_key' => $index,
                'message' => $this->{$aName}[$index]
            ];
        }
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