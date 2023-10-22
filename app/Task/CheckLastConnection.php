<?php
namespace App\Task;

use Carbon\Carbon;
use App\Model\Fleet;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Crontab\Annotation\Crontab;
use Hyperf\Contract\StdoutLoggerInterface;

#[Crontab(name: "CheckLastConnection", rule: "* * * * *", callback: "execute", memo: "Check last connection & set disconnect")]
class CheckLastConnection
{
     #[Inject]
    private StdoutLoggerInterface $logger;

    public function execute()
    {
        $now = Carbon::now();

        Fleet::where('connected', 1)
            ->where('last_connection', '<', $now->subMinutes(5)->format('Y-m-d H:i:s'))
            ->update([
                'connected' => 0
            ]);

        Fleet::where('connected', 0)
            ->where('last_connection', '<', $now->subMinutes(5)->format('Y-m-d H:i:s'))
            ->update([
                'fleet_status' => 'lost_connection'
            ]);
    }
}
