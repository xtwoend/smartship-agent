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
namespace App\Mqtt\Panderman;

use Carbon\Carbon;
use Hyperf\Utils\Codec\Json;
use Hyperf\Utils\Str;

class Pump
{
    protected string $message;

    protected $mappArray = [
        'temp_casing_wbp1',
        'temp_bearing_wbp1',
        'temp_stuffingbox_wbp1',
        'temp_casing_wbp2',
        'temp_bearing_wbp2',
        'temp_stuffingbox_wbp2',
        'temp_casing_sp',
        'temp_bearing_sp',
        'temp_stuffingbox_sp',
        'temp_casing_tcp',
        'temp_bearing_tcp',
        'temp_stuffingbox_tcp',
        'temp_casing_cp1',
        'temp_bearing_cp1',
        'temp_stuffingbox_cp1',
        'temp_casing_cp2',
        'temp_bearing_cp2',
        'temp_stuffingbox_cp2',
        'temp_casing_cp3',
        'temp_bearing_cp3',
        'temp_stuffingbox_cp3',
        'press_discharge_wbp1',
        'press_suction_wbp1',
        'press_discharge_wbp2',
        'press_suction_wbp2',
        'press_discharge_tcp',
        'press_suction_tcp',
        'press_discharge_sp',
        'press_suction_sp',
        'press_discharge_cp1',
        'press_suction_cp1',
        'press_discharge_cp2',
        'press_suction_cp2',
        'press_discharge_cp3',
        'press_suction_cp3',
    ];

    public function __construct(string $message)
    {
        $this->message = $message;
    }

    public function extract()
    {
        $data = Json::decode($this->message);

        return [
            'cargo' => [
                'terminal_time' => Carbon::now()->format('Y-m-d H:i:s'),
                'temp_casing_wbp1' => $data['temp_casing_wbp1'],
                'temp_bearing_wbp1' => $data['temp_bearing_wbp1'],
                'temp_stuffingbox_wbp1' => $data['temp_stuffingbox_wbp1'],
                'temp_casing_wbp2' => $data['temp_casing_wbp2'],
                'temp_bearing_wbp2' => $data['temp_bearing_wbp2'],
                'temp_stuffingbox_wbp2' => $data['temp_stuffingbox_wbp2'],
                'temp_casing_sp' => $data['temp_casing_sp'],
                'temp_bearing_sp' => $data['temp_bearing_sp'],
                'temp_stuffingbox_sp' => $data['temp_stuffingbox_sp'],
                'temp_casing_tcp' => $data['temp_casing_tcp'],
                'temp_bearing_tcp' => $data['temp_bearing_tcp'],
                'temp_stuffingbox_tcp' => $data['temp_stuffingbox_tcp'],
                'temp_casing_cp1' => $data['temp_casing_cp1'],
                'temp_bearing_cp1' => $data['temp_bearing_cp1'],
                'temp_stuffingbox_cp1' => $data['temp_stuffingbox_cp1'],
                'temp_casing_cp2' => $data['temp_casing_cp2'],
                'temp_bearing_cp2' => $data['temp_bearing_cp2'],
                'temp_stuffingbox_cp2' => $data['temp_stuffingbox_cp2'],
                'temp_casing_cp3' => $data['temp_casing_cp3'],
                'temp_bearing_cp3' => $data['temp_bearing_cp3'],
                'temp_stuffingbox_cp3' => $data['temp_stuffingbox_cp3'],
                'press_discharge_wbp1' => $data['press_discharge_wbp1'],
                'press_suction_wbp1' => $data['press_suction_wbp1'],
                'press_discharge_wbp2' => $data['press_discharge_wbp2'],
                'press_suction_wbp2' => $data['press_suction_wbp2'],
                'press_discharge_tcp' => $data['press_discharge_tcp'],
                'press_suction_tcp' => $data['press_suction_tcp'],
                'press_discharge_sp' => $data['press_discharge_sp'],
                'press_suction_sp' => $data['press_suction_sp'],
                'press_discharge_cp1' => $data['press_discharge_cp1'],
                'press_suction_cp1' => $data['press_suction_cp1'],
                'press_discharge_cp2' => $data['press_discharge_cp2'],
                'press_suction_cp2' => $data['press_suction_cp2'],
                'press_discharge_cp3' => $data['press_discharge_cp3'],
                'press_suction_cp3' => $data['press_suction_cp3'],
            ],
        ];
    }

    public function arrayToSnake(): array
    {
        $snake = [];
        foreach ($this->mappArray as $in => $val) {
            if (is_null($val)) {
                continue;
            }
            $key = Str::snake(strtolower($val));
            $snake[$key] = $val;
        }
        return $snake;
    }
}
