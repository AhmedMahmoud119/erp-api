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

Route::group(['middleware' => 'auth:sanctum', 'prefix' => 'warehouse'], function () {
    Route::get('/', [\App\Domains\Warehouse\Controllers\WarehouseController::class, 'list']);
    Route::get('/{id}', [\App\Domains\Warehouse\Controllers\WarehouseController::class, 'findById']);
    Route::delete('/{id}', [\App\Domains\Warehouse\Controllers\WarehouseController::class, 'delete']);
    Route::post('/create', [\App\Domains\Warehouse\Controllers\WarehouseController::class, 'create']);
    Route::post('/update/{id}', [\App\Domains\Warehouse\Controllers\WarehouseController::class, 'update']);
});

