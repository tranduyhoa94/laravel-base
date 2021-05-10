<?php

namespace Ky\FCM;

use Illuminate\Support\ServiceProvider;

class FCMServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/fcm.php', 'fcm');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPublish();
    }

    private function registerPublish()
    {
        $this->publishes([
            __DIR__.'/../config/fcm.php' => config_path('fcm.php'),
        ]);
    }
}