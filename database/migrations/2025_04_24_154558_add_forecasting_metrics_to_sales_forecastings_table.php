<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sales_forecastings', function (Blueprint $table) {
            $table->json('sales_details')->nullable()->after('actual_sales');
            $table->decimal('accuracy_rate', 8, 2)->nullable()->after('sales_details');
            $table->decimal('error_rate', 8, 2)->nullable()->after('accuracy_rate');
            $table->decimal('mse', 10, 2)->nullable()->after('error_rate');
            $table->decimal('mae', 10, 2)->nullable()->after('mse');
            $table->decimal('mape', 8, 2)->nullable()->after('mae');
        });
    }

    public function down(): void
    {
        Schema::table('sales_forecastings', function (Blueprint $table) {
            $table->dropColumn([
                'sales_details',
                'accuracy_rate',
                'error_rate',
                'mse',
                'mae',
                'mape'
            ]);
        });
    }
};