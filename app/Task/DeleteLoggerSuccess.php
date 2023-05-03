<?php
namespace App\Task;

use Carbon\Carbon;
use App\Model\Logger;
use Hyperf\DbConnection\Db;
use Hyperf\Utils\Codec\Json;
use Hyperf\Di\Annotation\Inject;
use Xtwoend\HyperfMqttClient\MQTT;
use Hyperf\Crontab\Annotation\Crontab;
use Hyperf\Contract\StdoutLoggerInterface;

#[Crontab(name: "DeleteLoggerSuccess", rule: "* * * * *", callback: "execute", memo: "Delete data logger")]
class DeleteLoggerSuccess
{
     #[Inject]
    private StdoutLoggerInterface $logger;

    public function execute()
    {
        Logger::where('sync', 1)->where('created_at', '>=', Carbon::now()->subDay()->format('Y-m-d H:i:s'))->delete();
        $this->logger->info(date('Y-m-d H:i:s', time()));
    }
}