<?php

namespace App\Task;

use Carbon\Carbon;
use App\Model\Fleet;
use App\Model\Alarm\Alarm;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Crontab\Annotation\Crontab;
use Hyperf\Contract\StdoutLoggerInterface;

#[Crontab(name: "CloseAlarm", rule: "*\/5 * * * * *", callback: "execute", memo: "Close alarm if opened until 1 minutes")]
class CloseAlarm
{
    #[Inject]
    private StdoutLoggerInterface $logger;

    public function execute()
    {
        $this->logger->info('Crontab alarm runing '. date('Y-m-d H:i:s', time()));

        foreach(Fleet::where('active', 1)->get() as $fleet) {
            $alarm = Alarm::table($fleet->id)
            ->where('status', 1)
            ->where('finished_at', '<', Carbon::now()->subMinutes(2)->format('Y-m-d H:i:s'))
            ->first();

            if($alarm) {
                $alarm->update(['status' => 0]);
            }
        }
    }
}