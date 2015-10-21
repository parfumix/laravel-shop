<?php

namespace Laravel\Shop;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Flysap\Support;

class ShopServiceProvider extends ServiceProvider {

    /**
     * Publish resources.
     */
    public function boot() {
        $this->loadRoutes()
            ->loadViews();

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

        /** @var Register alias facade . $loader */
        #$loader = AliasLoader::getInstance();
        #$loader->alias('Widget', WidgetFacade::class);
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

    /**
     * Load views .
     *
     */
    protected function loadViews() {
        $this->loadViewsFrom(__DIR__.'/../views', 'shop');
    }

    /**
     * Register widgets .
     *
     */
    protected function registerWidgets() {

    }

}