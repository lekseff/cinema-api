<?php

namespace App\Providers;

use App\Services\CinemaService;
use App\Services\MovieService;
use App\Services\OrderService;
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
    public function register(): void
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
        $this->app->bind(CinemaService::class, function ($app) {
            return new CinemaService();
        });
        $this->app->bind(OrderService::class, function ($app) {
            return new OrderService();
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
