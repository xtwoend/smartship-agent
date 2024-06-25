<?php

declare(strict_types=1);

namespace App\Listener;

use Carbon\Carbon;
use App\Model\Equipment;
use App\Event\AlarmEvent;
use Hyperf\Event\Annotation\Listener;
use Psr\Container\ContainerInterface;
use Hyperf\Event\Contract\ListenerInterface;

#[Listener]
class ScoreCalculateListener implements ListenerInterface
{
    public function __construct(protected ContainerInterface $container)
    {
    }

    public function listen(): array
    {
        return [
            AlarmEvent::class
        ];
    }

    public function process(object $event): void
    {
        if($event instanceof AlarmEvent) {
            $model = $event->model;
            $group = $event->group;
            if(in_array('engine', $group)) {
                $this->engine($model);
            }elseif(in_array('cargo_pump', $group) || in_array('cargo', $group)) {
                $this->pump($model);
            }
        }
    }


    public function engine($model)
    {
        try {
            $equipments = Equipment::where('fleet_id', $model->fleet_id)->get();
            foreach($equipments as $equipment) {
                $sensors = $equipment->sensors()->with('treshold')->get();
                foreach($sensors as $sensor) {
                    $treshold = $sensor->treshold;
                    if($treshold) {
                        $val = $model->{$treshold->sensor_name};
                        
                        if(! is_null($val) && $val > $treshold->normal) {
                            
                            $abnormal_count = $sensor->abnormal_count;
                            $total_value = $sensor->total_value;
                            $count_value = $sensor->count_value;
                            
                            $total_value += $val;
                            $count_value += 1;

                            if ($val >= $treshold->danger) {
                                $abnormal_count += 1;
                            } 
                            
                            $avg = ($count_value > 0 && $total_value > $count_value) ? ($total_value / $count_value): 0;

                            // rumus performance = 100 - (avg - normal) / (danger - normal) * 100
                            $performance = ($avg >= $treshold->max_normal) ? (100 - (($avg - $treshold->normal) / ($treshold->danger - $treshold->normal))) : 100; 
                            $performance = $avg < $treshold->danger ? $performance : 0;

                            $sensor->update([
                                'avg_value' => $avg,
                                'abnormal_count' => $abnormal_count,
                                'total_value' => $total_value,
                                'count_value' => $count_value,
                                'performance' => $performance,
                            ]);
                        }
                    }
                }
            }

        } catch (\Throwable $th) {
            //throw $th;
        }

    }

    public function pump($model)
    {
        try {  
            $equipments = Equipment::where('fleet_id', $model->fleet_id)->get();
            
            foreach($equipments as $equipment) {

                // sensor di equipment
                $sensors = $equipment->sensors()->with('treshold')->get();
                foreach($sensors as $sensor) {
                    $treshold = $sensor->treshold;
                    if($treshold) {
                        $val = $model->{$treshold->sensor_name};
                        // var_dump($treshold->normal);
                        if(! is_null($val) && $val >= $treshold->normal) {
                            // var_dump('____ test ____');
                            $abnormal_count = $sensor->abnormal_count;
                            $total_value = $sensor->total_value;
                            $count_value = $sensor->count_value;
                            
                            $total_value += $val;
                            $count_value += 1;

                            if ($val >= $treshold->danger) {
                                $abnormal_count += 1;
                            } 
                            
                            $avg = ($count_value > 0 && $total_value > $count_value) ? ($total_value / $count_value): 0;

                            // rumus performance = 100 - (avg - normal) / (danger - normal) * 100
                            $performance = ($avg >= $treshold->max_normal) ? (100 - (($avg - $treshold->normal) / ($treshold->danger - $treshold->normal))) : 100; 
                            $performance = $avg < $treshold->danger ? $performance : 0;
                            
                            $sensor->update([
                                'avg_value' => $avg,
                                'abnormal_count' => $abnormal_count,
                                'total_value' => $total_value,
                                'count_value' => $count_value,
                                'performance' => $performance,
                            ]);
                        }
                    }
                }
            

                $A40 = $equipment->sensors()->sum('abnormal_count');
                $degradation_factor = exp(-0.1 * $A40);
                $predicted_time_repair = 0;
                $A38 = $equipment->sensors()->avg('performance');
                $C41 = $equipment->lifetime_hours;
                $B42 = $degradation_factor;
                
                $M2 = 1;
                $M3 = 0.75;
                $M4 = 0.5;

                if($A38 >= 80) {
                    $predicted_time_repair = $C41 * ($A38/100) * $B42 * $M2;
                    $status = 'normal';
                }elseif($A38 >= 50 && $A38 < 80) {
                    $predicted_time_repair = $C41 * ($A38/100) * $B42 * $M3;
                    $status = 'attention';
                }else{
                    $predicted_time_repair = ($C41 * ($A38/100) * $B42 * $M4);
                    $status = 'warning';
                }

                $B43 = $predicted_time_repair;
                $difference_lifetime = ($B43 - $C41) / $C41;
                $next_maintenance = $A40 > 0 ? $equipment->last_maintenance->addHours($predicted_time_repair) : ( ($status == 'normal')? $equipment->schedule_maintenance: null) ;

                $equipment->update([
                    'degradation_factor' => $degradation_factor,
                    'predicted_time_repair' => $predicted_time_repair,
                    'difference_lifetime' => $difference_lifetime,
                    'status' => $status,
                    'next_maintenance' => $next_maintenance,
                    'score' => $A38 ?: 0
                ]);
            }

        } catch (\Throwable $th) {
            var_dump($th->getMessage());
        }
    }
}
