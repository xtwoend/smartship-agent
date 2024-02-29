<?php

declare(strict_types=1);

namespace App\Command;

use Psr\Container\ContainerInterface;
use Hyperf\Command\Annotation\Command;
use Hyperf\Command\Command as HyperfCommand;
use Symfony\Component\Console\Input\InputArgument;

#[Command]
class AvgSpeedCalcCommand extends HyperfCommand
{
    public function __construct(protected ContainerInterface $container)
    {
        parent::__construct('report:speed-daily');
    }

    public function configure()
    {
        parent::configure();
        $this->setDescription('Calculation speed daily');
    }

    protected function getArguments()
    {
        return [
            ['date', InputArgument::OPTIONAL, 'Calculate avg speed date']
        ];
    }

    public function handle()
    {
        $fleets = Fleet::where('active', 1)->get();
        $date = $this->input->getArgument('date') ?? Carbon::now()->format('Y-m-d');

        foreach($fleets as $fleet) {
            $avg = NavigationLog::table($fleet->id, $date)->where('sog', '>=', 2)->where('sog', '<=', 30)->avg('sog');
            $fsr = FleetDailyReport::table($fleet->id)->where([
                'fleet_id' => $fleet->id,
                'date' => $date,
                'sensor' => 'speed'
            ])->first();
            
            if($avg && ! $fsr) {
                $fsr = FleetDailyReport::table($fleet->id);
                $fsr->fleet_id = $fleet->id;
                $fsr->date = $date;
                $fsr->sensor = 'speed';
                $fsr->before = $avg;
            }

            if($fsr){
                $fsr->after = $avg;
                $fsr->value = $avg;
                $fsr->save();
            }
        }
    }
}
