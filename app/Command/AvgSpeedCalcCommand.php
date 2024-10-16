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
namespace App\Command;

use App\Model\Fleet;
use App\Model\FleetDailyReport;
use App\Model\NavigationLog;
use Carbon\Carbon;
use Hyperf\Command\Annotation\Command;
use Hyperf\Command\Command as HyperfCommand;
use Psr\Container\ContainerInterface;
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

    public function handle()
    {
        $fleets = Fleet::where('active', 1)->get();
        $date = $this->input->getArgument('date') ?? Carbon::now()->format('Y-m-d');

        foreach ($fleets as $fleet) {
            $avg = NavigationLog::table($fleet->id, $date)->where('sog', '>=', 2)->where('sog', '<=', 30)->avg('sog');
            $max_speed = NavigationLog::table($fleet->id, $date)->where('sog', '>=', 2)->where('sog', '<=', 30)->max('sog');
            
            $fsr = FleetDailyReport::table($fleet->id)->where([
                'fleet_id' => $fleet->id,
                'date' => $date,
                'sensor' => 'speed',
            ])->first();

            if ($avg && ! $fsr) {
                $fsr = FleetDailyReport::table($fleet->id);
                $fsr->fleet_id = $fleet->id;
                $fsr->date = $date;
                $fsr->sensor = 'speed';
                $fsr->before = $avg;
            }

            if ($fsr) {
                $fsr->after = $max_speed;
                $fsr->value = $avg;
                $fsr->save();
            }
        }
    }

    protected function getArguments()
    {
        return [
            ['date', InputArgument::OPTIONAL, 'Calculate avg speed date'],
        ];
    }
}
