<?php

namespace App\Mqtt\Pagerungan;

use Carbon\Carbon;
use Hyperf\Utils\Codec\Json;

class Engine
{
    protected string $message;

    public function __construct(string $message) {
       
        $this->message = $message;
    }
    
    public function extract()
    {
        $data = Json::decode($this->message);
        
        return [
            'engine' => [
                'terminal_time' => Carbon::now()->format('Y-m-d H:i:s'),
                'lo_inlet_pressure_ge1' => $data['lo_inlet_pressure_ge1'],
                'cfw_inlet_pressure_ge1' => $data['cfw_inlet_pressure_ge1'],
                'fo_inlet_pressure_ge1' => $data['fo_inlet_pressure_ge1'],
                'lo_inlet_pressure_ge2' => $data['lo_inlet_pressure_ge2'],
                'cfw_inlet_pressure_ge2' => $data['cfw_inlet_pressure_ge2'],
                'fo_inlet_pressure_ge2' => $data['fo_inlet_pressure_ge2'],
                'lo_inlet_pressure_ge3' => $data['lo_inlet_pressure_ge3'],
                'cfw_inlet_pressure_ge3' => $data['cfw_inlet_pressure_ge3'],
                'fo_inlet_pressure_ge3' => $data['fo_inlet_pressure_ge3'],
                'exgas_tc_inlet_temp_ge1' => $data['exgas_tc_inlet_temp_ge1'],
                'lo_inlet_temp_ge1' => $data['lo_inlet_temp_ge1'],
                'cfw_outlet_temp_ge1' => $data['cfw_outlet_temp_ge1'],
                'exgas_tc_inlet_temp_ge2' => $data['exgas_tc_inlet_temp_ge2'],
                'lo_inlet_temp_ge2' => $data['lo_inlet_temp_ge2'],
                'cfw_outlet_temp_ge2' => $data['cfw_outlet_temp_ge2'],
                'exgas_tc_inlet_temp_ge3' => $data['exgas_tc_inlet_temp_ge3'],
                'lo_inlet_temp_ge3' => $data['lo_inlet_temp_ge3'],
                'cfw_outlet_temp_ge3' => $data['cfw_outlet_temp_ge3'],
                'sea_water_temp_ecr' => $data['sea_water_temp_ecr'],
                'stern_tube_fwd_bearing_temp' => $data['stern_tube_fwd_bearing_temp'],
                'stern_tube_aft_bearing_temp' => $data['stern_tube_aft_bearing_temp'],
                'intermediate_shaft_bearing_temp' => $data['intermediate_shaft_bearing_temp'],
                'fo_service_tank1_temp' => $data['fo_service_tank1_temp'],
                'fo_service_tank2_temp' => $data['fo_service_tank2_temp'],
                'fo_service_tank3_temp' => $data['fo_service_tank3_temp'],
                'me_fo_inlet_pressure' => $data['me_fo_inlet_pressure'],
                'tc_lo_inlet_pressure' => $data['tc_lo_inlet_pressure'],
                'me_main_low_pco_inlet_pressure' => $data['me_main_low_pco_inlet_pressure'],
                'me_jacket_cw_inlet_pressure' => $data['me_jacket_cw_inlet_pressure'],
                'me_air_cooler_cw_inlet_pressure' => $data['me_air_cooler_cw_inlet_pressure'],
                'me_start_air_inlet_pressure' => $data['me_start_air_inlet_pressure'],
                'me_scavenge_air_pressure' => $data['me_scavenge_air_pressure'],
                'me_control_air_inlet_pressure' => $data['me_control_air_inlet_pressure'],
                'main_air_reservoir_1_pressure' => $data['main_air_reservoir_1_pressure'],
                'main_air_reservoir_2_pressure' => $data['main_air_reservoir_2_pressure'],
                'me_cyl1_jcw_outlet_temp' => $data['me_cyl1_jcw_outlet_temp'],
                'me_cyl2_jcw_outlet_temp' => $data['me_cyl2_jcw_outlet_temp'],
                'me_cyl3_jcw_outlet_temp' => $data['me_cyl3_jcw_outlet_temp'],
                'me_cyl4_jcw_outlet_temp' => $data['me_cyl4_jcw_outlet_temp'],
                'me_cyl5_jcw_outlet_temp' => $data['me_cyl5_jcw_outlet_temp'],
                'me_cyl6_jcw_outlet_temp' => $data['me_cyl6_jcw_outlet_temp'],
                'me_jacket_cw_inlet_temp' => $data['me_jacket_cw_inlet_temp'],
                'me_fo_inlet_temp' => $data['me_fo_inlet_temp'],
                'me_thruster_bearing_temp' => $data['me_thruster_bearing_temp'],
                'me_tc_lo_outlet_temp' => $data['me_tc_lo_outlet_temp'],
                'me_scav_air_receiver_temp' => $data['me_scav_air_receiver_temp'],
                'me_air_cooler_cw_inlet_temp' => $data['me_air_cooler_cw_inlet_temp'],
                'me_cyl1_exhgas_outlet_temp' => $data['me_cyl1_exhgas_outlet_temp'],
                'me_cyl2_exhgas_outlet_temp' => $data['me_cyl2_exhgas_outlet_temp'],
                'me_cyl3_exhgas_outlet_temp' => $data['me_cyl3_exhgas_outlet_temp'],
                'me_cyl4_exhgas_outlet_temp' => $data['me_cyl4_exhgas_outlet_temp'],
                'me_cyl5_exhgas_outlet_temp' => $data['me_cyl5_exhgas_outlet_temp'],
                'me_cyl6_exhgas_outlet_temp' => $data['me_cyl6_exhgas_outlet_temp'],
                'me_tc_exhgas_inlet_temp' => $data['me_tc_exhgas_inlet_temp'],
                'me_tc_exhgas_outlet_temp' => $data['me_tc_exhgas_outlet_temp'],
                'me_cyl1_scav_air_fire_temp' => $data['me_cyl1_scav_air_fire_temp'],
                'me_cyl2_scav_air_fire_temp' => $data['me_cyl2_scav_air_fire_temp'],
                'me_cyl3_scav_air_fire_temp' => $data['me_cyl3_scav_air_fire_temp'],
                'me_cyl4_scav_air_fire_temp' => $data['me_cyl4_scav_air_fire_temp'],
                'me_cyl5_scav_air_fire_temp' => $data['me_cyl5_scav_air_fire_temp'],
                'me_cyl6_scav_air_fire_temp' => $data['me_cyl6_scav_air_fire_temp'],
                'me_main_lo_pco_inlet_temp' => $data['me_main_lo_pco_inlet_temp'],
                'me_cyl1_pco_outlet_temp' => $data['me_cyl1_pco_outlet_temp'],
                'me_cyl2_pco_outlet_temp' => $data['me_cyl2_pco_outlet_temp'],
                'me_cyl3_pco_outlet_temp' => $data['me_cyl3_pco_outlet_temp'],
                'me_cyl4_pco_outlet_temp' => $data['me_cyl4_pco_outlet_temp'],
                'me_cyl5_pco_outlet_temp' => $data['me_cyl5_pco_outlet_temp'],
                'me_cyl6_pco_outlet_temp' => $data['me_cyl6_pco_outlet_temp'],
                'me_cyl1_fore_main_bear_temp' => $data['me_cyl1_fore_main_bear_temp'],
                'me_cyl1_main__bearing_temp' => $data['me_cyl1_main__bearing_temp'],
                'me_cyl2_main__bearing_temp' => $data['me_cyl2_main__bearing_temp'],
                'me_cyl3_main__bearing_temp' => $data['me_cyl3_main__bearing_temp'],
                'me_cyl4_main__bearing_temp' => $data['me_cyl4_main__bearing_temp'],
                'me_cyl5_main__bearing_temp' => $data['me_cyl5_main__bearing_temp'],
                'me_cyl6_main__bearing_temp' => $data['me_cyl6_main__bearing_temp'],
                'me_thrust_radial_bearing_temp' => $data['me_thrust_radial_bearing_temp'],
                'control_air_inlet_pressure' => $data['control_air_inlet_pressure'],
            ]
        ];
    }
}