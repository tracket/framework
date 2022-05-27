<?php

namespace Tracket\Theme;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class ThemeServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/config/theme.php' => config_path('theme.php'),
            ], 'config');
        }

        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->loadViewsFrom(base_path('themes'), 'theme');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/theme.php', 'theme');
    }
}
