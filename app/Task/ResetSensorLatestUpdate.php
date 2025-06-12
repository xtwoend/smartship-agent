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

use App\Model\Sensor;
use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\Crontab\Annotation\Crontab;
use Hyperf\Di\Annotation\Inject;

#[Crontab(name: 'ResetSensorLatestUpdate', rule: '*/5 * * * *', callback: 'execute', memo: 'ResetSensorLatestUpdate')]
class ResetSensorLatestUpdate
{
    #[Inject]
    private StdoutLoggerInterface $logger;

    public function execute()
    {
        $this->logger->info('Crontab reset sensor runing ' . date('Y-m-d H:i:s', time()));

        Sensor::update([
            'condition' => null,
            'value' => null,
        ]);
    }
}
