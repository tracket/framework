<?php

namespace Tracket\Admin;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/config/web.php' => config_path('web.php'),
            ], 'config');

            $this->publishes([
                __DIR__ . '/resources/views' => base_path('resources/views/vendor/web'),
            ], 'views');
        }

        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'admin');
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/web.php', 'web');
    }
}
