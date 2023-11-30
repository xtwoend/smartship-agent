<?php

namespace App\Task;

use Carbon\Carbon;
use App\Model\Fleet;
use App\Model\NavigationLog;
use App\Model\FleetDailyReport;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Crontab\Annotation\Crontab;
use Hyperf\Contract\StdoutLoggerInterface;

#[Crontab(name: "EverageSpeedCalc", rule: "0 */1 * * *", callback: "execute", memo: "EverageSpeedCalc")]
class EverageSpeedCalc
{
    #[Inject]
    private StdoutLoggerInterface $logger;

    public function execute()
    {
        $this->logger->info('Crontab reset sensor runing '. date('Y-m-d H:i:s', time()));
       
        $fleets = Fleet::where('active', 1)->get();
        $date = Carbon::now()->format('Y-m-d');
        foreach($fleets as $fleet) {
            $avg = NavigationLog::table($fleet->id, $date)->where('sog', '>=', 2)->avg('sog');
            $fsr = FleetDailyReport::table($fleet->id)->where([
                'fleet_id' => $fleet->id,
                'date' => $date,
                'sensor' => 'speed'
            ])->first();
            
            if(! $fsr) {
                $fsr = FleetDailyReport::table($fleet->id);
                $fsr->fleet_id = $fleet->id;
                $fsr->date = $date;
                $fsr->sensor = 'speed';
                $fsr->before = $avg;
            }

            $fsr->after = $avg;
            $fsr->value = $avg;
            $fsr->save();
        }
    }
}