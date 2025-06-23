<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'gender',
        'phone',
        'birthday',
        'order_date',
        'total_price',
        'note',
        'payment_method_id',
        'paid_amount',
        'change_amount',
    ];

    protected $casts = [
        'order_date' => 'date',
        'birthday' => 'date',
    ];

    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function orderProducts(): HasMany
    {
        return $this->hasMany(OrderProduct::class, 'order_id');
    }

    public static function getMonthlySales($productId, $startDate, $endDate)
    {
        return self::join('order_products', 'orders.id', '=', 'order_products.order_id')
            ->where('order_products.product_id', $productId)
            ->whereBetween('orders.order_date', [$startDate, $endDate])
            ->groupByRaw('YEAR(orders.order_date), MONTH(orders.order_date)')
            ->selectRaw('SUM(order_products.quantity) as total_sales, DATE_FORMAT(orders.order_date, "%Y-%m-01") as month')
            ->get();
    }

    public static function getProductSalesHistory($productId, $period = 3)
    {
        $endDate = Carbon::now();
        $startDate = Carbon::now()->subMonths($period);

        return self::selectRaw('DATE(order_date) as sale_date, SUM(order_products.quantity) as total_quantity')
            ->join('order_products', 'orders.id', '=', 'order_products.order_id')
            ->where('order_products.product_id', $productId)
            ->whereBetween('order_date', [$startDate, $endDate])
            ->groupBy('sale_date')
            ->orderBy('sale_date')
            ->get();
    }

    public function scopeByDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('order_date', [$startDate, $endDate]);
    }

    public function scopeWithProductQuantity($query, $productId)
    {
        return $query->whereHas('orderProducts', function ($query) use ($productId) {
            $query->where('product_id', $productId);
        });
    }
}