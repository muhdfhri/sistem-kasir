<?php

namespace App\Observers;

use App\Models\SalesForecasting;
use App\Services\MovingAverageService;

class SalesForecastingObserver
{
    protected MovingAverageService $movingAverageService;

    public function __construct(MovingAverageService $movingAverageService)
    {
        $this->movingAverageService = $movingAverageService;
    }

    public function created(SalesForecasting $salesForecasting)
    {
        $this->movingAverageService->saveForecast($salesForecasting);
    }

    public function updated(SalesForecasting $salesForecasting)
    {
        $this->movingAverageService->saveForecast($salesForecasting);
    }
}