<?php

use App\Domains\Category\Controllers\CategoryController;
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
Route::group(['middleware' => 'auth:sanctum', 'prefix' => 'category'], function () {
    Route::get('/', [CategoryController::class, 'list']);
    Route::get('/{id}', [CategoryController::class, 'findById']);
    Route::delete('/{id}', [CategoryController::class, 'delete']);
    Route::post('/create', [CategoryController::class, 'create']);
    Route::post('/update/{id}', [CategoryController::class, 'update']);
});