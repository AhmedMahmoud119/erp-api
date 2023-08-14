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

Route::group(['middleware' => 'auth:sanctum','prefix' => 'financial-periods'],function (){
    Route::get('/', [\App\Domains\FinancialPeriod\Controllers\FinancialPeriodController::class, 'list']);
    Route::get('/{id}', [\App\Domains\FinancialPeriod\Controllers\FinancialPeriodController::class, 'findById']);
    Route::delete('/{id}', [\App\Domains\FinancialPeriod\Controllers\FinancialPeriodController::class, 'delete']);
    Route::post('/create', [\App\Domains\FinancialPeriod\Controllers\FinancialPeriodController::class, 'store']);
    Route::post('/update/{id}', [\App\Domains\FinancialPeriod\Controllers\FinancialPeriodController::class, 'update']);
});
