<?php

use App\Domains\Product\Controllers\ProductController;
use App\Domains\Product\Models\Product;
use App\Domains\Product\Models\Spec;
use App\Domains\Product\Request\UpdateProductRequest;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Console\Helper\Helper;

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
Route::group(['middleware' => 'auth:sanctum', 'prefix' => 'product'], function () {
    Route::get('/', [ProductController::class, 'list']);
    Route::get('/{id}', [ProductController::class, 'findById']);
    Route::delete('/{id}', [ProductController::class, 'delete']);
    Route::post('/create', [ProductController::class, 'create']);
    Route::post('/update/{id}',[ProductController::class, 'update']);
});
