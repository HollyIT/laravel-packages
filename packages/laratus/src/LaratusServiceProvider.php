<?php

namespace Hollyit\Laratus;

use Hollyit\Laratus\Contracts\TusStorageDriver;
use Illuminate\Cache\Repository;
use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;

class LaratusServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laratus.php', 'laratus');
        $this->loadRoutesFrom(__DIR__ . '/../routes/laratus.php');

        $this->app->when(TusCacheRepository::class)
            ->needs(Repository::class)
            ->give(function (): Repository {
                return app('cache')->store(config('laratus.cache_store', 'file'));
            });



    }

    public function boot(): void
    {
        if (Server::$shouldRegisterRoutes) {
            $this->loadRoutesFrom(__DIR__ . '/../routes/laratus.php');
        }
    }
}
