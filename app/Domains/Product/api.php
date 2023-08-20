<?php

use App\Domains\Product\Controllers\ProductController;
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
Route::group(['middleware' => 'auth:sanctum','prefix' => 'product'],function (){
    Route::get('/', [ProductController::class, 'list']);
    Route::delete('/{id}',[ProductController::class, 'delete']);
    Route::post('/create', [ProductController::class, 'create']);
    Route::post('/update/{id}', [ProductController::class, 'update']);
});
