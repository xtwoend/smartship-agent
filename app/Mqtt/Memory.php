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
namespace App\Mqtt;

use Hyperf\Di\Annotation\Inject;
use Psr\SimpleCache\CacheInterface;

class Memory
{
    protected array $attributes;

    #[Inject]
    protected CacheInterface $cache;

    public function __construct(array $data = [])
    {
        $this->attributes = $data;
    }

    public function __set($key, $value)
    {
        $this->attributes[$key] = $value;
        return $this;
    }

    public function __get($key)
    {
        return $this->attributes[$key] ?? null;
    }

    public function load($name)
    {
        $saved = $this->cache->get($name, []);
        $this->attributes = array_merge_recursive($this->attributes, $saved);
        return $this;
    }

    public function save($name)
    {
        $this->cache->set($name, $this->attributes);
        return $this;
    }
}
