<?php

namespace Laravel\Shop;

use Illuminate\Support\ServiceProvider;
use Flysap\Support;

class ShopServiceProvider extends ServiceProvider {

    /**
     * Publish resources.
     */
    public function boot() {
        $this->loadRoutes();

        $this->publishes([
            __DIR__.'/../configuration' => config_path('yaml/shop'),
        ]);

        $this->publishes([
            __DIR__ . DIRECTORY_SEPARATOR . '../migrations/' => base_path('database/migrations')
        ], 'migrations');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        $this->loadConfiguration();

        Support\merge_yaml_config_from(
            config_path('yaml/shop/general.yaml') , 'laravel-shop'
        );
    }

    /**
     * Load configuration .
     *
     * @return $this
     */
    protected function loadConfiguration() {
        Support\set_config_from_yaml(
            __DIR__ . '/../configuration/general.yaml' , 'laravel-shop'
        );

        return $this;
    }

    /**
     * Load routes .
     *
     * @return $this
     */
    protected function loadRoutes() {
        /** Register routes . */
        if (! $this->app->routesAreCached())
            require __DIR__.'/../routes.php';

        return $this;
    }


}