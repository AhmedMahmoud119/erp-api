<?php

use App\Domains\Stock\Controllers\StockController;
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
Route::group(['middleware' => 'auth:sanctum', 'prefix' => 'stock'], function () {
    Route::get('/', [StockController::class, 'list']);
    Route::get('/{id}', [StockController::class, 'findById']);
    Route::delete('/{id}', [StockController::class, 'delete']);
    Route::post('/create', [StockController::class, 'create']);
    Route::post('/update/{id}', [StockController::class, 'update']);
});