<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sales_forecastings', function (Blueprint $table) {
            $table->integer('actual_sales')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('sales_forecastings', function (Blueprint $table) {
            $table->integer('actual_sales')->nullable(false)->change();
        });
    }
};
