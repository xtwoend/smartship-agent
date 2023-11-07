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
            ->where('last_connection', '<', $now->subMinutes(15)->format('Y-m-d H:i:s'))
            ->update([
                'connected' => 0,
                'fleet_status' => 'lost_connection'
            ]);

        $loses = Fleet::where('connected', 0)->get();
        foreach($loses as $lost) {
            $hi = $lost->status_durations()->firstOrCreate([
                'fleet_status' => 'lost_connection',
                'status' => 1,
            ], [
                'started_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
            $hi->finished_at = Carbon::now()->format('Y-m-d H:i:s');
            $hi->save();
        }
    }
}
