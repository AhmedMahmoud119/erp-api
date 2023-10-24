<?php

use App\Domains\CashManagment\Controllers\CashManagementController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a CashManagment which
| is assigned the "api" middleware CashManagment. Enjoy building your API!
|
*/

Route::group(['middleware' => 'auth:sanctum', 'prefix' => 'cash-management'], function () {
    Route::get('/', [CashManagementController::class, 'list']);
    Route::get('/{id}', [CashManagementController::class, 'findById']);
    Route::delete('/{id}', [CashManagementController::class, 'delete']);
    Route::post('/create', [CashManagementController::class, 'create']);
    Route::post('/update/{id}', [CashManagementController::class, 'update']);
});
