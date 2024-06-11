<?php

declare(strict_types=1);

namespace App\Listener;

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
            // $group = $event->group;
            
            try {  
                $equipments = Equipment::where('fleet_id', $model->fleet_id)->get();
                foreach($equipments as $equipment) {
                    $sensors = $equipment->sensors;
                    foreach($sensors as $sensor) {
                        if($model->{$sensor->sensor_trigger} > 0) {
                            $abnormal_count = $sensor->abnormal_count;
                            $total_value = $sensor->total_value;
                            $count_value = $sensor->count_value;
                            $treshold = $sensor->treshold;

                            if($treshold) {
                                $val = $model->{$treshold->sensor_name};
                                $val = number($val);
                                $total_value += $val;
                                $count_value += 1;
                                if ($val >= $treshold->danger) {
                                    $abnormal_count += 1;
                                } 
                            }  
                            

                            $avg = ($count_value > 0  && $total_value > $count_value) ? ($total_value / $count_value): 0;
                            // rumus performance = 100 - (avg - normal) / (danger - normal) * 100
                            $performance = $avg > $treshold->normal ? (100 - (($avg - $treshold->normal) / ($treshold->danger - $treshold->normal))) : 100; 
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
            } catch (\Throwable $th) {
                var_dump($th->getMessage());
            }
        }
    }
}
