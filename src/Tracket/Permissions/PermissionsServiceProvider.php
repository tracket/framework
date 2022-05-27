<?php

namespace Tracket\Permissions;

use Illuminate\Support\ServiceProvider;
use Tracket\Permissions\Commands\RoleAssign;

class PermissionsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/config/permissions.php' => config_path('permissions.php'),
            ], 'config');

            $this->commands([
                RoleAssign::class
            ]);
        }

        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/permissions.php', 'permissions');
    }
}
