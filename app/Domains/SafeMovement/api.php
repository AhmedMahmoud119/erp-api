<?php

use App\Domains\SafeMovement\Controllers\SafeMovementController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a SafeMovement which
| is assigned the "api" middleware SafeMovement. Enjoy building your API!
|
*/

Route::group(['middleware' => 'auth:sanctum', 'prefix' => 'safe-movement'], function () {
    Route::get('/', [SafeMovementController::class, 'list']);
    Route::get('/{id}', [SafeMovementController::class, 'findById']);
    Route::delete('/{id}', [SafeMovementController::class, 'delete']);
    Route::post('/create', [SafeMovementController::class, 'create']);
    Route::post('/update/{id}', [SafeMovementController::class, 'update']);
});
