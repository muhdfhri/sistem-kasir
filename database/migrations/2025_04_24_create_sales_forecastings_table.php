<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sales_forecastings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->date('date');
            $table->date('end_date');
            $table->integer('actual_sales');
            $table->decimal('forecasted_sales', 10, 2)->nullable();
            $table->integer('moving_average_period');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sales_forecastings');
    }
};