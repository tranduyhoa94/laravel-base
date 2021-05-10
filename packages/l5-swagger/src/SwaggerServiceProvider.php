<?php

namespace Mi\L5Swagger;

use Illuminate\Support\ServiceProvider;
use Mi\L5Swagger\Commands\GenerateSwagger;
use Illuminate\Support\Facades\Route;

class SwaggerServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/l5-swagger.php', 'l5-swagger');

        // Commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                GenerateSwagger::class,
            ]);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerRoutes();
        $this->registerPublish();

        // Views
        $this->loadViewsFrom(__DIR__.'/../views', 'l5-swagger');
    }

    /**
     * Register the package routes.
     *
     * @return void
     */
    private function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__.'/Http/routes.php');
        });
    }

    /**
     * Get the Telescope route group configuration array.
     *
     * @return array
     */
    private function routeConfiguration()
    {
        return [
            'namespace'  => 'Mi\L5Swagger\Http\Controllers'
        ];
    }

    private function registerPublish()
    {
        $this->publishes([
            __DIR__.'/../config/l5-swagger.php' => config_path('l5-swagger.php'),
        ]);
    }
}
