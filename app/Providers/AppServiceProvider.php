<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\GenreService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(GenreService::class, function ($app) {
            return new GenreService();
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
