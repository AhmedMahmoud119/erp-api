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

Route::group(['middleware' => 'auth:sanctum','prefix' => 'currency'],function (){
    Route::get('/', [\App\Domains\Currency\Controllers\CurrencyController::class, 'list']);
    Route::get('/{id}', [\App\Domains\Currency\Controllers\CurrencyController::class, 'findById']);
    Route::delete('/{id}', [\App\Domains\Currency\Controllers\CurrencyController::class, 'delete']);
    Route::post('/create', [\App\Domains\Currency\Controllers\CurrencyController::class, 'create']);
    Route::post('/update/{id}', [\App\Domains\Currency\Controllers\CurrencyController::class, 'update']);
    Route::get('/codes/all', [\App\Domains\Currency\Controllers\CurrencyController::class, 'getCodes']);

});

