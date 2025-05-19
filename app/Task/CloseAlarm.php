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

use App\Model\Alarm\Alarm;
use App\Model\Fleet;
use Carbon\Carbon;
use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\Crontab\Annotation\Crontab;
use Hyperf\Di\Annotation\Inject;

#[Crontab(name: 'CloseAlarm', rule: '*/10 * * * *', callback: 'execute', memo: 'Close alarm if opened until 1 minutes')]
class CloseAlarm
{
    #[Inject]
    private StdoutLoggerInterface $logger;

    public function execute()
    {
        $this->logger->info('Crontab alarm runing ' . date('Y-m-d H:i:s', time()));

        foreach (Fleet::where('active', 1)->get() as $fleet) {
            $alarm = Alarm::table($fleet->id)
                ->where('status', 1)
                ->where('finished_at', '<', Carbon::now()->subMinutes(2)->format('Y-m-d H:i:s'))
                ->first();

            if ($alarm) {
                $alarm->update(['status' => 0]);
            }
        }
    }
}
