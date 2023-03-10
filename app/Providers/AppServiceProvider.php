<?php

namespace App\Providers;

use App\Services\MovieService;
use App\Services\SessionService;
use App\Services\SliderService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(MovieService::class, function ($app) {
            return new MovieService();
        });
        $this->app->bind(SessionService::class, function ($app) {
            return new SessionService();
        });
        $this->app->bind(SliderService::class, function ($app) {
            return new SliderService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
