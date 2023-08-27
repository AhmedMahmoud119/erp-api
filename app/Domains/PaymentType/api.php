<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'auth:sanctum', 'prefix' => 'payment-type'], function () {
    Route::get('/', [\App\Domains\PaymentType\Controllers\PaymentTypeController::class, 'list']);
    Route::get('/{id}', [\App\Domains\PaymentType\Controllers\PaymentTypeController::class, 'findById']);
    Route::delete('/{id}', [\App\Domains\PaymentType\Controllers\PaymentTypeController::class, 'delete']);
    Route::post('/create', [\App\Domains\PaymentType\Controllers\PaymentTypeController::class, 'create']);
    Route::post('/update/{id}', [\App\Domains\PaymentType\Controllers\PaymentTypeController::class, 'update']);
});

