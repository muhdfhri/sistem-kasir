<?php

namespace App\Filament\Resources\ForecastingResource\Pages;

use App\Filament\Resources\ForecastingResource;
use Filament\Resources\Pages\CreateRecord;
use App\Services\MovingAverageService;

class CreateForecasting extends CreateRecord
{
    protected static string $resource = ForecastingResource::class;

    protected function afterCreate(): void
    {
        $movingAverageService = new MovingAverageService();
        $movingAverageService->saveForecast($this->record);
    }
}