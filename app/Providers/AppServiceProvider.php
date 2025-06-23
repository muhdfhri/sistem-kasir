<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Dedoc\Scramble\Scramble;
use Dedoc\Scramble\Support\Generator\OpenApi;
use Dedoc\Scramble\Support\Generator\SecurityScheme;
use App\Models\SalesForecasting;
use App\Observers\SalesForecastingObserver;
use App\Services\MovingAverageService;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
{
    $this->app->singleton(MovingAverageService::class, function ($app) {
        return new MovingAverageService();
    });
}

    public function boot(): void
    {
        SalesForecasting::observe(SalesForecastingObserver::class);

        Scramble::afterOpenApiGenerated(function (OpenApi $openApi) {
            $openApi->secure(
                SecurityScheme::http('bearer')
            );
        });
    }
}