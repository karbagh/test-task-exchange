<?php

namespace App\Providers;

use App\Console\Commands\Rates\UpdateRatesCommand;
use App\Services\Currency\Rate\CurrencyRateService;
use Illuminate\Support\ServiceProvider;
use L5Swagger\L5SwaggerServiceProvider;
use Laravel\Telescope\TelescopeServiceProvider as TelescopeAppServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ($this->app->environment('local')) {
            $this->app->register(TelescopeAppServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
        $this->app->register(L5SwaggerServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
