<?php

use App\Domains\CashManagment\Controllers\CashManagmentController;
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

Route::group(['middleware' => 'auth:sanctum', 'prefix' => 'cash-managment'], function () {
    Route::get('/', [CashManagmentController::class, 'list']);
    Route::get('/{id}', [CashManagmentController::class, 'findById']);
    Route::delete('/{id}', [CashManagmentController::class, 'delete']);
    Route::post('/create', [CashManagmentController::class, 'create']);
    Route::post('/update/{id}', [CashManagmentController::class, 'update']);
});
