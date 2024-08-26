<?php

namespace Hollyit\Laratus;

use Hollyit\Laratus\Contracts\TusStorageDriver;
use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;

class LaratusServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laratus.php', 'laratus');
        $this->loadRoutesFrom(__DIR__.'/../routes/tus.php');
        $this->app->singleton(TusStorageDriver::class, function ($app) {

            $options = config('laratus.storage');
            if (!isset($options['driver'])) {
                throw new \Exception('Tus storage driver not specified');
            }

            if (!class_exists($options['driver'])) {
                throw new \Exception('Tus storage driver does not exist');
            }

            return app($options['driver'], Arr::get($options,'options', []));
        });
    }

    public function boot(): void
    {
        if (LaratusServer::$shouldRegisterRoutes) {
            $this->loadRoutesFrom(__DIR__.'/../routes/tus.php');
        }
    }
}
