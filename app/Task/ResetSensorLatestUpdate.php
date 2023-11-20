<?php

namespace App\Task;

use Carbon\Carbon;
use App\Model\Sensor;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Crontab\Annotation\Crontab;
use Hyperf\Contract\StdoutLoggerInterface;

#[Crontab(name: "ResetSensorLatestUpdate", rule: "0 5 * * *", callback: "execute", memo: "ResetSensorLatestUpdate")]
class ResetSensorLatestUpdate
{
    #[Inject]
    private StdoutLoggerInterface $logger;

    public function execute()
    {
        $this->logger->info('Crontab reset sensor runing '. date('Y-m-d H:i:s', time()));
       
        Sensor::update([
            'condition' => NULL,
            'value' => NULL
        ]);
    }
}