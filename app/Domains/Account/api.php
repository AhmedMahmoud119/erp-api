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

Route::group(['middleware' => 'auth:sanctum','prefix' => 'account'],function (){
    Route::get('/', [\App\Domains\Account\Controllers\AccountController::class, 'list']);
    Route::get('/{id}', [\App\Domains\Account\Controllers\AccountController::class, 'findById']);
    Route::delete('/{id}', [\App\Domains\Account\Controllers\AccountController::class, 'delete']);
    Route::post('bulk-delete', [\App\Domains\Account\Controllers\AccountController::class, 'bulkDelete']);
    Route::post('/create', [\App\Domains\Account\Controllers\AccountController::class, 'create']);
    Route::post('/update/{id}', [\App\Domains\Account\Controllers\AccountController::class, 'update']);
    Route::post('/import', [\App\Domains\Account\Controllers\AccountController::class, 'import']);
});

