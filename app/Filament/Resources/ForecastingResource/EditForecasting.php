<?php

namespace App\Filament\Resources\ForecastingResource\Pages;

use App\Filament\Resources\ForecastingResource;
use Filament\Resources\Pages\EditRecord;
use App\Services\MovingAverageService;

class EditForecasting extends EditRecord
{
    protected static string $resource = ForecastingResource::class;

    protected function afterSave(): void
    {
        $movingAverageService = new MovingAverageService();
        $movingAverageService->saveForecast($this->record);
    }
}