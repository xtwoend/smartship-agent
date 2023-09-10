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
        return [
            'alarm' => [
                'terminal_time' => $data['ts'] ?: Carbon::now()->format('Y-m-d H:i:s'),
                'alarm_trust_bearing_temperature' => (bool) $data[0],
                'alarm_fuel_oil_leakage_injection_pipes' => (bool) $data[1],
                'alarm_fuel_oil_leakage_dirty_fuel' => (bool) $data[2],
                'alarm_charge_air_bypass_valve_position_failure' => (bool) $data[3],
                'alarm_oil_mist_detector_failure' => (bool) $data[4],
                'alarm_oil_mist_detector_alarm_load_reduction' => (bool) $data[5],
                'alarm_truning_gear_position' => (bool) $data[6],
                'alarm_stop_lever_in_stop_position' => (bool) $data[7],
                'alarm_engine_speed_sensor_failur_primary' => (bool) $data[8],
                'alarm_engine_speed_sensor_falure_secondary' => (bool) $data[9],
                'alarm_engine_ready_for_star' => (bool) $data[10],
                'alarm_engine_start_block_active' => (bool) $data[11],
                'alarm_local_control_mode' => (bool) $data[12],
                'alarm_start_failure' => (bool) $data[13],
                'alarm_load_reduction_request' => (bool) $data[14],
                'alarm_stop_shutdown_override' => (bool) $data[15],
                'alarm_engine_blow' => (bool) $data[16],
                'alarm_engine_nor_pre_lubricated' => (bool) $data[17],
                'alarm_turning_gear_engaged' => (bool) $data[18],
                'alarm_stop_level_in_stop_position' => (bool) $data[19],
                'alarm_local_selector_in_blocked_postion' => (bool) $data[20],
                'alarm_enternal_start_blocking1' => (bool) $data[21],
                'alarm_enternal_start_blocking2' => (bool) $data[22],
                'alarm_enternal_start_blocking3' => (bool) $data[23],
                'alarm_charge_air_shut_off_valve_position' => (bool) $data[24],
                'alarm_engine_speed_sensor_failure_emergency' => (bool) $data[25],
                'alarm_overspeed_shutdown_statusfrom_esm' => (bool) $data[26],
                'alarm_lube_oil_press_shutdown_status_from_esm' => (bool) $data[27],
                'alarm_oilmist_detector_shutdown' => (bool) $data[28],
                'alarm_external_shutdown_status1' => (bool) $data[31],
                'alarm_external_shutdown_status2' => (bool) $data[32],
                'alarm_external_shutdown_status3' => (bool) $data[33],
                'alarm_emergency_stop_from_esm' => (bool) $data[34],
                'alarm_temperature_in_mcm11-1' => (bool) $data[35],
                'alarm_temperature_in_mcm11-2' => (bool) $data[36],
                'alarm_temperature_in_iom_de' => (bool) $data[37],
                'alarm_temperature_in_iom_fe' => (bool) $data[38],
                'alarm_temperature_in_iom_tc' => (bool) $data[39],
                'alarm_temperature_in_iom_a1' => (bool) $data[40],
                'alarm_temperature_in_iom_a2' => (bool) $data[41],
                'alarm_temperature_in_iom_a3' => (bool) $data[42],
                'alarm_ca_shut_off_valve_position' => (bool) $data[44],
                'alarm_pdm_system_supply_eatrh_fault' => (bool) $data[45],
                'alarm_pdm_system_supply_failure' => (bool) $data[47],
            ]
        ];
    }

    function arrayToSnake() : array {
        $snake = [];
        foreach($this->mappArray as $in => $val) {
            if(is_null($val)) continue;
            $key = Str::snake(strtolower($val));
            $snake[$key] = $in;
        } 
        return $snake;
    }

    protected $mappArray = [
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