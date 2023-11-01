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

Route::prefix('user')->group(function() {
    Route::get('/', [\App\Domains\User\Controllers\UserController::class, 'list']);
    Route::get('/me', [\App\Domains\User\Controllers\UserController::class, 'me']);
    Route::get('/{id}', [\App\Domains\User\Controllers\UserController::class, 'findById']);
    Route::delete('/{id}', [\App\Domains\User\Controllers\UserController::class, 'delete']);
    Route::post('/create', [\App\Domains\User\Controllers\UserController::class, 'store']);
    Route::post('/update/{id}', [\App\Domains\User\Controllers\UserController::class, 'update']);
    Route::post('/login', [\App\Domains\User\Controllers\UserController::class, 'loginUser'])->name('login');
    Route::post('/logout', [\App\Domains\User\Controllers\UserController::class, 'logout']);
    Route::post('/change-password', [\App\Domains\User\Controllers\UserController::class, 'updatePassword']);
    Route::get('/data/export', [\App\Domains\User\Controllers\UserController::class, 'export']);
});

