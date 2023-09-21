<?php

use App\Domains\Pack\Controllers\PackController;
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
Route::group(['middleware' => 'auth:sanctum', 'prefix' => 'pack'], function () {
    Route::get('/', [PackController::class, 'list']);
    Route::get('/{id}', [PackController::class, 'findById']);
    Route::delete('/{id}', [PackController::class, 'delete']);
    Route::post('/create', [PackController::class, 'create']);
    Route::post('/update/{id}', [PackController::class, 'update']);
});