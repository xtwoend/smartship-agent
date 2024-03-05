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
namespace App\Mqtt\Papandayan;

use Carbon\Carbon;
use Hyperf\Utils\Codec\Json;
use Hyperf\Utils\Str;

class Cargo
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
                'cargo_timestamp' => Carbon::now()->format('Y-m-d H:i:s'),
                'temp_casing_wbp1' => (float) $data['temp_casing_wbp1'],
                'temp_bearing_wbp1' => (float) $data['temp_bearing_wbp1'],
                'temp_stuffingbox_wbp1' => (float) $data['temp_stuffingbox_wbp1'],
                'temp_casing_wbp2' => (float) $data['temp_casing_wbp2'],
                'temp_bearing_wbp2' => (float) $data['temp_bearing_wbp2'],
                'temp_stuffingbox_wbp2' => (float) $data['temp_stuffingbox_wbp2'],
                'temp_casing_sp' => (float) $data['temp_casing_sp'],
                'temp_bearing_sp' => (float) $data['temp_bearing_sp'],
                'temp_stuffingbox_sp' => (float) $data['temp_stuffingbox_sp'],
                'temp_casing_tcp' => (float) $data['temp_casing_tcp'],
                'temp_bearing_tcp' => (float) $data['temp_bearing_tcp'],
                'temp_stuffingbox_tcp' => (float) $data['temp_stuffingbox_tcp'],
                'temp_casing_cp1' => (float) $data['temp_casing_cp1'],
                'temp_bearing_cp1' => (float) $data['temp_bearing_cp1'],
                'temp_stuffingbox_cp1' => (float) $data['temp_stuffingbox_cp1'],
                'temp_casing_cp2' => (float) $data['temp_casing_cp2'],
                'temp_bearing_cp2' => (float) $data['temp_bearing_cp2'],
                'temp_stuffingbox_cp2' => (float) $data['temp_stuffingbox_cp2'],
                'temp_casing_cp3' => (float) $data['temp_casing_cp3'],
                'temp_bearing_cp3' => (float) $data['temp_bearing_cp3'],
                'temp_stuffingbox_cp3' => (float) $data['temp_stuffingbox_cp3'],
                'press_discharge_wbp1' => (float) $data['press_discharge_wbp1'],
                'press_suction_wbp1' => (float) $data['press_suction_wbp1'],
                'press_discharge_wbp2' => (float) $data['press_discharge_wbp2'],
                'press_suction_wbp2' => (float) $data['press_suction_wbp2'],
                'press_discharge_tcp' => (float) $data['press_discharge_tcp'],
                'press_suction_tcp' => (float) $data['press_suction_tcp'],
                'press_discharge_sp' => (float) $data['press_discharge_sp'],
                'press_suction_sp' => (float) $data['press_suction_sp'],
                'press_discharge_cp1' => (float) $data['press_discharge_cp1'],
                'press_suction_cp1' => (float) $data['press_suction_cp1'],
                'press_discharge_cp2' => (float) $data['press_discharge_cp2'],
                'press_suction_cp2' => (float) $data['press_suction_cp2'],
                'press_discharge_cp3' => (float) $data['press_discharge_cp3'],
                'press_suction_cp3' => (float) $data['press_suction_cp3'],
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
