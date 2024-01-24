<?php

namespace App\Mqtt\PBrandan;

use Carbon\Carbon;
use Hyperf\Utils\Codec\Json;

class Cargo
{
    protected string $message;

    public function __construct(string $message) {
        $this->message = $message;
    }

    public function extract()
    {
        $data = Json::decode($this->message);

        return [
            'cargo' => [
                'terminal_time' => Carbon::now()->format('Y-m-d H:i:s'),
                'pump_non_drvend_c1' => (float) $data['pump_non_drvend_c1'],
                'pump_casing_c1' => (float) $data['pump_casing_c1'],
                'bulk_head_c1' => (float) $data['bulk_head_c1'],
                'transmission_sealing_c1' => (float) $data['transmission_sealing_c1'],
                'pump_non_drvend_c2' => (float) $data['pump_non_drvend_c2'],
                'pump_casing_c2' => (float) $data['pump_casing_c2'],
                'bulk_head_c2' => (float) $data['bulk_head_c2'],
                'transmission_sealing_c2' => (float) $data['transmission_sealing_c2'],
                'pump_non_drvend_c3' => (float) $data['pump_non_drvend_c3'],
                'pump_casing_c3' => (float) $data['pump_casing_c3'],
                'bulk_head_c3' => (float) $data['bulk_head_c3'],
                'transmission_sealing_c3' => (float) $data['transmission_sealing_c3'],
                'pump_non_drvend_bp1' => (float) $data['pump_non_drvend_bp1'],
                'pump_casing_bp1' => (float) $data['pump_casing_bp1'],
                'bulk_head_bp1' => (float) $data['bulk_head_bp1'],
                'tansmission_sealing_bp1' => (float) $data['tansmission_sealing_bp1'],
                'pump_non_drvend_bp2' => (float) $data['pump_non_drvend_bp2'],
                'pump_casing_bp2' => (float) $data['pump_casing_bp2'],
                'bulk_head_bp2' => (float) $data['bulk_head_bp2'],
                'transmission_sealing_bp2' => (float) $data['transmission_sealing_bp2'],
                'pump_non_drvend_sp1' => (float) $data['pump_non_drvend_sp1'],
                'pump_casing_sp1' => (float) $data['pump_casing_sp1'],
                'bulk_head_sp1' => (float) $data['bulk_head_sp1'],
                'transmission_sealing_sp1' => (float) $data['transmission_sealing_sp1'],
                'pump_non_drvend_tcp' => (float) $data['pump_non_drvend_tcp'],
                'pump_casing_tcp' => (float) $data['pump_casing_tcp'],
                'bulk_head_tcp' => (float) $data['bulk_head_tcp'],
                'transmission_sealing_tcp' => (float) $data['transmission_sealing_tcp'],
            ]
        ];
    }
}