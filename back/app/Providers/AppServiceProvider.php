<?php

namespace App\Providers;

use App\Interfaces\ICryptoCurrencyRepository;
use App\Repositories\CryptoCurrencyRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ICryptoCurrencyRepository::class, CryptoCurrencyRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
