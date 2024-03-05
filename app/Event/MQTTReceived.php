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
namespace App\Event;

class MQTTReceived
{
    public array $data;

    public $message;

    public $topic;

    public $device;

    public function __construct($data, $message, $topic, $device)
    {
        $this->data = $data;
        $this->message = $message;
        $this->topic = $topic;
        $this->device = $device;
    }
}
