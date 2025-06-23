<?php

namespace App\Services;

use App\Models\SalesForecasting;
use Carbon\Carbon;

class MovingAverageService
{
    public function saveForecast(SalesForecasting $forecast)
    {
        // Hitung actual sales terlebih dahulu
        $forecast->calculateActualSales();
        
        if (empty($forecast->sales_details)) {
            return;
        }

        $salesData = $forecast->sales_details;
        $period = $forecast->moving_average_period;
        
        // Urutkan data berdasarkan tanggal
        ksort($salesData);
        
        $forecasted = [];
        $values = array_values($salesData);
        $dates = array_keys($salesData);
        
        // Hitung moving average untuk setiap titik
        for ($i = 0; $i < count($values); $i++) {
            if ($i < $period - 1) {
                $forecasted[$dates[$i]] = array_sum(array_slice($values, 0, $i + 1)) / ($i + 1);
            } else {
                $forecasted[$dates[$i]] = array_sum(array_slice($values, $i - $period + 1, $period)) / $period;
            }
        }

        // Simpan hasil forecast
        $forecast->forecasted_sales = $forecasted;
        $forecast->forecasted_total = array_sum($forecasted);
        
        // Hitung metrik evaluasi
        $forecast->calculateMetrics();
        
        $forecast->save();
    }
}