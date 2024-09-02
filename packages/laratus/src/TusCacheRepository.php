<?php

namespace Hollyit\Laratus;

use Illuminate\Cache\Repository;

class TusCacheRepository
{
    protected Repository $cache;

    protected int $ttl = 86400;

    protected string $keyPrefix = 'laratus_';

    public function __construct(Repository $cache)
    {
        $this->cache = $cache;
    }

    public function getTtl(): int
    {
        return $this->ttl;
    }

    public function setTtl(int $ttl): TusCacheRepository
    {
        $this->ttl = $ttl;

        return $this;
    }

    protected function makeKey(string $key): string
    {
        return $this->keyPrefix.$key;
    }

    public function get(string $key)
    {
        $key = $this->makeKey($key);
        if ($data = $this->cache->get($key)) {
            return $data;
        }

        return null;
    }

    public function put(string $key, mixed $value, mixed $ttl = null): static
    {
        $key = $this->makeKey($key);
        $ttl = $ttl ?? $this->ttl;

        $this->cache->put($key, $value, $ttl);

        return $this;
    }

    public function forget(string $key): static
    {
        $key = $this->makeKey($key);
        $this->cache->forget($key);

        return $this;
    }
}
