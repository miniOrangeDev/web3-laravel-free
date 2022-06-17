<?php

namespace provider;

use Illuminate\Support\ServiceProvider;

class web3ServiceProvider extends ServiceProvider
{

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $app = app();
        $version = floatval($app->version());
        if ($version <= 5.3) {
            if (!$this->app->routesAreCached()) {
                require __DIR__ . '/../src/routes.php';
            }
            $this->loadViewsFrom(__DIR__ . '/../src/', 'moweb3');

        }else {
        $this->loadMigrationsFrom(__DIR__ . '/../src/migrations');
        $this->loadRoutesFrom(__DIR__ . '/../src/routes.php');
        $this->loadViewsFrom(__DIR__ . '/../src/', 'moweb3');}
    }
}
