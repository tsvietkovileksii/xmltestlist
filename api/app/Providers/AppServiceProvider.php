<?php

namespace App\Providers;

use App\Contracts\ApiServiceInterface;
use App\Repositories\UserListRepository;
use App\Services\ApiSwitchService;
use App\Services\BoredApiService;
use App\Services\RandomUserApiService;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ApiSwitchService::class, function ($app) {
            return new ApiSwitchService(
                $app->make(RandomUserApiService::class),
                $app->make(BoredApiService::class)
            );
        });

        $this->app->singleton(BoredApiService::class, function ($app) {
            return new BoredApiService(
                $app->make(Client::class)
            );
        });

        $this->app->singleton(RandomUserApiService::class, function ($app) {
            return new RandomUserApiService(
                $app->make(Client::class)
            );
        });

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
