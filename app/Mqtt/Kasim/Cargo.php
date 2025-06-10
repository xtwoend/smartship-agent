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
namespace App\Mqtt\Kasim;

use Carbon\Carbon;
use Hyperf\Utils\Codec\Json;
use Hyperf\Utils\Str;

class Cargo
{
    protected string $message;

    protected $mappArray = [
    ];

    public function __construct(string $message)
    {
        $this->message = $message;
    }

    public function extract()
    {
        $data = Json::decode($this->message);

        $sensors = [];
        foreach ($data['values'] as $val) {
            $id = str_replace('plc.cop.q02h.', '', $val['id']);
            $sensors[$id] = (float) $val['v'];
        }

        return [
            'cargo' => [
                'cargo_timestamp' => Carbon::now()->format('Y-m-d H:i:s'),
                'bp1_casing_temp' => $sensors['bp1_casing_temp'] ?? 0,
                'bp1_transmission_brg_temp' => $sensors['bp1_transmission_brg_temp'] ?? 0,
                'bp1_drive_end_bearing_temp' => $sensors['bp1_drive_end_bearing_temp'] ?? 0,
                'bp1_nondrive_end_bearing_temp' => $sensors['bp1_nondrive_end_bearing_temp'] ?? 0,
                'bp1_transmission_seal_temp' => $sensors['bp1_transmission_seal_temp'] ?? 0,
                'bp2_drive_end_bearing_temp' => $sensors['bp2_drive_end_bearing_temp'] ?? 0,
                'bp2_casing_temp' => $sensors['bp2_casing_temp'] ?? 0,
                'bp2_transmission_brg_temp' => $sensors['bp2_transmission_brg_temp'] ?? 0,
                'bp2_nondrive_end_bearing_temp' => $sensors['bp2_nondrive_end_bearing_temp'] ?? 0,
                'bp2_transmission_seal_temp' => $sensors['bp2_transmission_seal_temp'] ?? 0,
                'cp1_casing_temp' => $sensors['cp1_casing_temp'] ?? 0,
                'cp1_bearing_temp' => $sensors['cp1_bearing_temp'] ?? 0,
                'cp1_transmission_brg_temp' => $sensors['cp1_transmission_brg_temp'] ?? 0,
                'cp1_discharge_pressure' => $sensors['cp1_discharge_pressure'] ?? 0,
                'cp1_transmission_seal_temp' => $sensors['cp1_transmission_seal_temp'] ?? 0,
                'cp2_casing_temp' => $sensors['cp2_casing_temp'] ?? 0,
                'cp2_bearing_temp' => $sensors['cp2_bearing_temp'] ?? 0,
                'cp2_transmission_brg_temp' => $sensors['cp2_transmission_brg_temp'] ?? 0,
                'cp2_discharge_pressure' => $sensors['cp2_discharge_pressure'] ?? 0,
                'cp2_transmission_seal_temp' => $sensors['cp2_transmission_seal_temp'] ?? 0,
                'cp3_bearing_temp' => $sensors['cp3_bearing_temp'] ?? 0,
                'cp3_casing_temp' => $sensors['cp3_casing_temp'] ?? 0,
                'cp3_discharge_pressure' => $sensors['cp3_discharge_pressure'] ?? 0,
                'cp3_transmission_brg_temp' => $sensors['cp3_transmission_brg_temp'] ?? 0,
                'cp3_transmission_seal_temp' => $sensors['cp3_transmission_seal_temp'] ?? 0,
                'sp1_discharge_pressure' => $sensors['sp1_discharge_pressure'] ?? 0,
                'sp1_drive_end_bearing_temp' => $sensors['sp1_drive_end_bearing_temp'] ?? 0,
                'sp1_casing_temp' => $sensors['sp1_casing_temp'] ?? 0,
                'sp1_nondrive_end_bearing_temp' => $sensors['sp1_nondrive_end_bearing_temp'] ?? 0,
                'sp1_transmission_brg_temp' => $sensors['sp1_transmission_brg_temp'] ?? 0,
                'sp2_casing_temp' => $sensors['sp2_casing_temp'] ?? 0,
                'sp1_transmission_seal_temp' => $sensors['sp1_transmission_seal_temp'] ?? 0,
                'sp2_discharge_pressure' => $sensors['sp2_discharge_pressure'] ?? 0,
                'sp2_drive_end_bearing_temp' => $sensors['sp2_drive_end_bearing_temp'] ?? 0,
                'sp2_nondrive_end_bearing_temp' => $sensors['sp2_nondrive_end_bearing_temp'] ?? 0,
                'sp2_transmission_brg_temp' => $sensors['sp2_transmission_brg_temp'] ?? 0,
                'sp2_transmission_seal_temp' => $sensors['sp2_transmission_seal_temp'] ?? 0,
                'tcp_casing_temp' => $sensors['tcp_casing_temp'] ?? 0,
                'tcp_discharge_pressure' => $sensors['tcp_discharge_pressure'] ?? 0,
                'tcp_nondrive_end_bearing_temp' => $sensors['tcp_nondrive_end_bearing_temp'] ?? 0,
                'tcp_drive_end_bearing_temp' => $sensors['tcp_drive_end_bearing_temp'] ?? 0,
                'tcp_transmission_brg_temp' => $sensors['tcp_transmission_brg_temp'] ?? 0,
                'tcp_transmission_seal_temp' => $sensors['tcp_transmission_seal_temp'] ?? 0,
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
