<?php

use App\Domains\FixedAsset\Controllers\FixedAssetController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a FixedAsset which
| is assigned the "api" middleware FixedAsset. Enjoy building your API!
|
*/

Route::group(['middleware' => 'auth:sanctum', 'prefix' => 'fixed-asset'], function () {
    Route::get('/', [FixedAssetController::class, 'list']);
    Route::get('/{id}', [FixedAssetController::class, 'findById']);
    Route::delete('/{id}', [FixedAssetController::class, 'delete']);
    Route::post('/create', [FixedAssetController::class, 'create']);
    Route::post('/update/{id}', [FixedAssetController::class, 'update']);
});
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('parent/fixed-asset', [FixedAssetController::class, 'parents']);
});
