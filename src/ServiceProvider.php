<?php

namespace Marifuli\Service;

use Illuminate\Support\ServiceProvider as ServiceProviderMain;
use Marifuli\Service\Console\Commands\MigrateStatusCommand;
use Marifuli\Service\Middleware\ServiceMiddleware;

class ServiceProvider extends ServiceProviderMain
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $router = $this->app['router'];
        $router->pushMiddlewareToGroup('web', ServiceMiddleware::class);

        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'service');
        $this->loadViewsFrom(resource_path('/views/vendors/service'), 'service');

        $this->publishes([
            __DIR__.'/../public' => public_path('vendor/spondonit'),
             __DIR__.'/../resources/views' => resource_path('views/vendors/service'),
        ], 'spondonit');

        $this->commands([
            MigrateStatusCommand::class,
        ]);
    }
}

