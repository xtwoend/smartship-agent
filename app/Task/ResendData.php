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

#[Crontab(name: "ResendData", rule: "* * * * *", callback: "execute", memo: "This is scheduled task for resync data after lost connection to server")]
class ResendData
{
     #[Inject]
    private StdoutLoggerInterface $logger;

    public function execute()
    {
        $mqtt = MQTT::connection('default')->instance();
        Db::table('loggers')->where('sync', 0)->orderBy('created_at')->chunk(100, function ($data) use ($mqtt) {
            foreach ($data as $row) {
                if($mqtt->isConnected()) {
                    $message = Json::encode(Json::decode($row->message));
                    $time = Carbon::parse($row->createda_at);
                    $send = $mqtt->publish(
                        $row->topic, 
                        Json::encode(['data' => $message, 'timestamp' => $time->toAtomString()]), 
                        1);
                        
                    Logger::find($row->id)->update(['sync' => true]);
                }
            }
        });

        $this->logger->info(date('Y-m-d H:i:s', time()));
    }
}