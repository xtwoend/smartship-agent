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
namespace App\Task;

use App\Model\Fleet;
use App\Model\FleetDailyReport;
use App\Model\NavigationLog;
use Carbon\Carbon;
use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\Crontab\Annotation\Crontab;
use Hyperf\Di\Annotation\Inject;

#[Crontab(name: 'EverageSpeedCalc', rule: '0 */1 * * *', callback: 'execute', memo: 'EverageSpeedCalc')]
class EverageSpeedCalc
{
    #[Inject]
    private StdoutLoggerInterface $logger;

    public function execute()
    {
        $this->logger->info('Crontab reset sensor runing ' . date('Y-m-d H:i:s', time()));

        $fleets = Fleet::where('active', 1)->get();
        $date = Carbon::now()->format('Y-m-d');
        foreach ($fleets as $fleet) {
            $avg = NavigationLog::table($fleet->id, $date)->where('sog', '>=', 2)->where('sog', '<=', 30)->avg('sog');
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
                $fsr->after = $avg;
                $fsr->value = $avg;
                $fsr->save();
            }
        }
    }
}
