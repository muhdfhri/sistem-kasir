<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\PaymentMethodController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\StudentProfileController;

Route::post('login', [AuthController::class, 'login']);

Route::apiResource('products', ProductController::class)->middleware(['auth:sanctum']);
Route::get('products/barcode/{barcode}', [ProductController::class, 'showByBarcode'])->middleware(['auth:sanctum']);
Route::get('payment-methods', [PaymentMethodController::class, 'index'])->middleware(['auth:sanctum']);
Route::apiResource('orders', OrderController::class)->middleware(['auth:sanctum']);
Route::get('setting', [SettingController::class, 'index'])->middleware(['auth:sanctum']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Student Profile API Routes
Route::middleware(['auth:sanctum'])->prefix('student')->group(function () {
    // Education routes
    Route::post('/education', [StudentProfileController::class, 'storeEducation']);
    Route::put('/education/{id}', [StudentProfileController::class, 'updateEducation']);
    Route::delete('/education/{id}', [StudentProfileController::class, 'deleteEducation']);

    // Experience routes
    Route::post('/experience', [StudentProfileController::class, 'storeExperience']);
    Route::put('/experience/{id}', [StudentProfileController::class, 'updateExperience']);
    Route::delete('/experience/{id}', [StudentProfileController::class, 'deleteExperience']);

    // Skill routes
    Route::post('/skill', [StudentProfileController::class, 'storeSkill']);
    Route::put('/skill/{id}', [StudentProfileController::class, 'updateSkill']);
    Route::delete('/skill/{id}', [StudentProfileController::class, 'deleteSkill']);
});


