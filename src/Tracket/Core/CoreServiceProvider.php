<?php

namespace Tracket\Core;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class CoreServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/config/core.php' => config_path('core.php'),
            ], 'config');
        }

        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/core.php', 'core');
    }
}
