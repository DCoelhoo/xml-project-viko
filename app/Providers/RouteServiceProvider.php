<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Register middleware aliases (Laravel 11+).
     */
    public function boot(): void
    {
        $router = $this->app['router'];

        // Register aliases
        $router->aliasMiddleware('admin', \App\Http\Middleware\AdminMiddleware::class);
        $router->aliasMiddleware('guestAdmin', \App\Http\Middleware\GuestAdmin::class);
    }
}