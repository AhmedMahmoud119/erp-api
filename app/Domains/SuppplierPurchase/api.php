<?php

use App\Domains\SupplierPurchase\Controllers\SupplierPurchaseController;
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
Route::group(['middleware' => 'auth:sanctum', 'prefix' => 'supplier-purchase'], function () {
    Route::get('/', [SupplierPurchaseController::class, 'list']);
    Route::get('/{id}', [SupplierPurchaseController::class, 'findById']);
    Route::delete('/{id}', [SupplierPurchaseController::class, 'delete']);
    Route::post('/create', [SupplierPurchaseController::class, 'create']);
    Route::post('/update/{id}', [SupplierPurchaseController::class, 'update']);
});