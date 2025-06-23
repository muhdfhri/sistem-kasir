<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class SalesForecasting extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'date',
        'end_date',
        'actual_sales',
        'forecasted_total',
        'forecasted_sales',
        'moving_average_period',
        'sales_details',
        'accuracy_rate',
        'error_rate',
        'mape',
        'mae',
        'mse'
    ];

    protected $casts = [
        'date' => 'date',
        'end_date' => 'date',
        'sales_details' => 'array',
        'forecasted_sales' => 'array',
    ];

    /**
     * Relasi ke model Product
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Relasi ke Order berdasarkan product_id dan rentang tanggal
     */
    public function orders()
    {
        return $this->hasMany(Order::class, 'product_id', 'product_id')
            ->whereBetween('order_date', [$this->date, $this->end_date]);
    }

    /**
     * Hitung total penjualan aktual dan simpan per tanggal ke sales_details
     */
    public function calculateActualSales()
    {
        $orders = Order::join('order_products', 'orders.id', '=', 'order_products.order_id')
            ->where('order_products.product_id', $this->product_id)
            ->whereBetween('orders.order_date', [$this->date, $this->end_date])
            ->select('orders.order_date', 'order_products.quantity')
            ->get();

        $salesDetails = [];
        $totalSales = 0;

        foreach ($orders as $order) {
            $date = Carbon::parse($order->order_date)->format('Y-m-d');
            if (!isset($salesDetails[$date])) {
                $salesDetails[$date] = 0;
            }
            $salesDetails[$date] += $order->quantity;
            $totalSales += $order->quantity;
        }

        $this->sales_details = $salesDetails;
        $this->actual_sales = $totalSales;
        $this->save();
    }

    /**
     * Hitung metrik evaluasi forecasting: error, akurasi, mape, mae, mse
     */
    public function calculateMetrics()
    {
        if (empty($this->sales_details)) {
            return;
        }

        $salesDetails = $this->sales_details;

        // Jika forecast hanya angka total
        if (!is_array($this->forecasted_sales)) {
            $forecastTotal = $this->forecasted_total;
            $error = abs($this->actual_sales - $forecastTotal);
            $this->error_rate = $error;
            $this->accuracy_rate = $this->actual_sales != 0 ? (1 - ($error / $this->actual_sales)) * 100 : 0;
            $this->mape = $this->actual_sales != 0 ? ($error / $this->actual_sales) * 100 : 0;
            $this->mae = $error;
            $this->mse = $error ** 2;
            $this->save();
            return;
        }

        // Forecast per hari (array)
        $forecastedSales = $this->forecasted_sales;

        if (empty($forecastedSales)) {
            return;
        }

        $errors = [];
        $squaredErrors = [];
        $actuals = [];

        foreach ($salesDetails as $date => $actual) {
            $forecast = $forecastedSales[$date] ?? 0;
            $error = abs($actual - $forecast);
            $errors[] = $error;
            $squaredErrors[] = $error ** 2;
            $actuals[] = $actual;
        }

        $totalError = array_sum($errors);
        $totalActual = array_sum($actuals);

        $this->error_rate = $totalError;
        $this->accuracy_rate = $totalActual != 0 ? (1 - ($totalError / $totalActual)) * 100 : 0;
        $this->mape = $totalActual != 0 ? ($totalError / $totalActual) * 100 : 0;
        $this->mae = count($errors) > 0 ? $totalError / count($errors) : 0;
        $this->mse = count($squaredErrors) > 0 ? array_sum($squaredErrors) / count($squaredErrors) : 0;

        $this->save();
    }

    /**
     * Format hasil penjualan aktual agar mudah dibaca
     */
    public function getSalesDetailsFormattedAttribute()
    {
        if (!$this->sales_details) {
            return '';
        }

        $output = [];
        foreach ($this->sales_details as $date => $quantity) {
            $output[] = "Date: {$date}, Quantity: {$quantity}";
        }

        return implode("\n", $output);
    }
}
