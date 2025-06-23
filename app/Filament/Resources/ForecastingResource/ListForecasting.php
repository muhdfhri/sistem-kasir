<?php

namespace App\Filament\Resources\ForecastingResource\Pages;

use App\Filament\Resources\ForecastingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListForecasting extends ListRecords
{
    protected static string $resource = ForecastingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}