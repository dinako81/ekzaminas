<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\CatsService;
use Illuminate\Contracts\Foundation\Application;


class CatsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(CatsService::class, function (Application $app) {
            return new CatsService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}