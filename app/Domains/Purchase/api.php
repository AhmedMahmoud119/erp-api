<?php

use App\Domains\Purchase\Controllers\PurchaseController;
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
Route::group(['middleware' => 'auth:sanctum', 'prefix' => 'purchase'], function () {
    Route::get('/', [PurchaseController::class, 'list']);
    Route::get('/{id}', [PurchaseController::class, 'findById']);
    Route::delete('/{id}', [PurchaseController::class, 'delete']);
    Route::post('/create', [PurchaseController::class, 'create']);
    Route::post('/update/{id}', [PurchaseController::class, 'update']);
});
