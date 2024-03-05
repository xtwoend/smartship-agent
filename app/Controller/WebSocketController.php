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
namespace App\Controller;

use Hyperf\SocketIOServer\Annotation\Event;
use Hyperf\SocketIOServer\Annotation\SocketIONamespace;
use Hyperf\SocketIOServer\BaseNamespace;
use Hyperf\SocketIOServer\Socket;

#[SocketIONamespace('/')]
class WebSocketController extends BaseNamespace
{
    /**
     * @param string $data
     */
    #[Event('subscribe')]
    public function onSubscribe(Socket $socket, $data)
    {
        // Add the current user to the room
        $socket->join($data);
    }
}
