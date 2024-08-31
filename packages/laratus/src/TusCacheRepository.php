<?php

namespace Hollyit\Laratus;

use Illuminate\Cache\Repository;

class TusCacheRepository
{

    protected Repository $cache;

    public function __construct(Repository $cache)
    {
        $this->cache = $cache;
    }
}
