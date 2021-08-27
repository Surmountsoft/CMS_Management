<?php

namespace CSoftech\Cms;

use Illuminate\Support\ServiceProvider;

class CmsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__.'/lang', 'tran');
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadViewsFrom(__DIR__.'/views', 'view');
        $this->loadMigrationsFrom(__DIR__.'/migrations');

        $this->publishes([
            __DIR__.'/public/js' => public_path('js'),
        ], 'js');
        $this->publishes([
            __DIR__.'/public/css' => public_path('css'),
        ], 'css');
        $this->publishes([
            __DIR__.'/public/assets' => public_path('assets'),
        ], 'assets');
        $this->publishes([
            __DIR__.'/config/contentSlug.php' => config_path('contentSlug.php'),
        ], 'cSlug');
    }
}
