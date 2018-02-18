<?php

namespace Laraspace\Providers;

use Illuminate\Support\ServiceProvider;
use Solarium\Client;

class SolariumServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Client::class, function ($app) {
            return new Client($app['config']['solarium']);
        });
    }

    public function provides()
    {
        return [Client::class];
    }
}
