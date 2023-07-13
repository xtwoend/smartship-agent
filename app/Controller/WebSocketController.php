<?php

declare(strict_types=1);

namespace App\Controller;

use Hyperf\Utils\Codec\Json;
use Hyperf\SocketIOServer\Socket;
use Hyperf\SocketIOServer\BaseNamespace;
use Hyperf\SocketIOServer\Annotation\Event;
use Hyperf\SocketIOServer\Annotation\SocketIONamespace;

#[SocketIONamespace("/")]
class WebSocketController extends BaseNamespace
{
    /**
     * @param string $data
     */
    #[Event("subscribe")]
    public function onSubscribe(Socket $socket, $data)
    {
        // Add the current user to the room
        $socket->join($data);
    }
}
