<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ForecastingResource\Pages;
use App\Models\Product;
use App\Models\SalesForecasting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ForecastingResource extends Resource
{
    protected static ?string $model = SalesForecasting::class;
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static ?string $navigationGroup = 'Forecasting';
    protected static ?string $navigationLabel = 'Sales Forecasting';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('product_id')
                    ->label('Product')
                    ->options(Product::all()->pluck('name', 'id'))
                    ->required(),

                Forms\Components\DatePicker::make('date')
                    ->label('Start Date')
                    ->required(),

                Forms\Components\DatePicker::make('end_date')
                    ->label('End Date')
                    ->required()
                    ->after('date'),

                Forms\Components\TextInput::make('moving_average_period')
                    ->numeric()
                    ->default(3)
                    ->required(),

                Forms\Components\Textarea::make('sales_details_formatted')
                    ->label('Sales Details')
                    ->disabled()
                    ->columnSpanFull()
                    ->rows(10),

                Forms\Components\TextInput::make('actual_sales')
                    ->label('Actual Sales')
                    ->disabled(),

                Forms\Components\TextInput::make('forecasted_sales')
                    ->label('Forecasted Sales')
                    ->disabled(),

                Forms\Components\TextInput::make('accuracy_rate')
                    ->label('Accuracy Rate')
                    ->disabled()
                    ->suffix('%'),

                Forms\Components\TextInput::make('error_rate')
                    ->label('Error Rate')
                    ->disabled()
                    ->suffix('%'),

                Forms\Components\TextInput::make('mae')
                    ->label('MAE')
                    ->disabled(),

                Forms\Components\TextInput::make('mse')
                    ->label('MSE')
                    ->disabled(),

                Forms\Components\TextInput::make('mape')
                    ->label('MAPE')
                    ->disabled()
                    ->suffix('%'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('product.name')
                    ->label('Product')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('date')
                    ->label('Start Date')
                    ->date()
                    ->sortable(),

                Tables\Columns\TextColumn::make('end_date')
                    ->label('End Date')
                    ->date()
                    ->sortable(),

                Tables\Columns\TextColumn::make('actual_sales')
                    ->label('Actual Sales')
                    ->sortable(),

                Tables\Columns\TextColumn::make('forecasted_sales')
                    ->label('Forecasted Sales')
                    ->sortable(),

                Tables\Columns\TextColumn::make('accuracy_rate')
                    ->label('Accuracy Rate')
                    ->suffix('%')
                    ->sortable(),

                Tables\Columns\TextColumn::make('error_rate')
                    ->label('Error Rate')
                    ->suffix('%')
                    ->sortable(),

                Tables\Columns\TextColumn::make('mae')
                    ->label('MAE')
                    ->sortable(),

                Tables\Columns\TextColumn::make('mse')
                    ->label('MSE')
                    ->sortable(),

                Tables\Columns\TextColumn::make('mape')
                    ->label('MAPE')
                    ->suffix('%')
                    ->sortable(),

                Tables\Columns\TextColumn::make('moving_average_period')
                    ->label('Moving Avg. Period')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('product_id')
                    ->label('Product')
                    ->options(Product::pluck('name', 'id')),

                Tables\Filters\Filter::make('date')
                    ->form([
                        Forms\Components\DatePicker::make('from_date')->label('From'),
                        Forms\Components\DatePicker::make('until_date')->label('Until'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['from_date'], fn ($query) => $query->whereDate('date', '>=', $data['from_date']))
                            ->when($data['until_date'], fn ($query) => $query->whereDate('date', '<=', $data['until_date']));
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListForecasting::route('/'),
            'create' => Pages\CreateForecasting::route('/create'),
            'edit' => Pages\EditForecasting::route('/{record}/edit'),
        ];
    }
}
