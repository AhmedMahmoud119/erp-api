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

Route::group(['middleware' => 'auth:sanctum', 'prefix' => 'financial-periods', 'as' => 'financial-periods.'], function () {
    Route::get('/', [\App\Domains\FinancialPeriod\Controllers\FinancialPeriodController::class, 'list'])->name('list');
    Route::get('/{id}', [\App\Domains\FinancialPeriod\Controllers\FinancialPeriodController::class, 'findById'])->name('show');
    Route::delete('/{id}', [\App\Domains\FinancialPeriod\Controllers\FinancialPeriodController::class, 'delete'])->name('delete');
    Route::post('/create', [\App\Domains\FinancialPeriod\Controllers\FinancialPeriodController::class, 'store'])->name('create');
    Route::post('/update/{id}', [\App\Domains\FinancialPeriod\Controllers\FinancialPeriodController::class, 'update'])->name('update');
});
