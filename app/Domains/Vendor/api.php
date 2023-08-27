<?php

use App\Domains\Vendor\Controllers\LocationController;
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

Route::group(['middleware' => 'auth:sanctum', 'prefix' => 'vendor'], function () {
    Route::get('/', [\App\Domains\Vendor\Controllers\VendorController::class, 'list']);
    Route::get('/{id}', [\App\Domains\Vendor\Controllers\VendorController::class, 'findById']);
    Route::delete('/{id}', [\App\Domains\Vendor\Controllers\VendorController::class, 'delete']);
    Route::post('/create', [\App\Domains\Vendor\Controllers\VendorController::class, 'create']);
    Route::post('/update/{id}', [\App\Domains\Vendor\Controllers\VendorController::class, 'update']);
});


Route::group(['middleware' => 'auth:sanctum', 'prefix' => 'address'], function () {
    Route::get('/city', [LocationController::class, 'listCities']);
    Route::get('city/{id}', [LocationController::class, 'findCityById']);

    Route::get('/country', [LocationController::class, 'listCountries']);
    Route::get('country/{id}', [LocationController::class, 'findCountryById']);

    Route::get('/state', [LocationController::class, 'listStates']);
    Route::get('state/{id}', [LocationController::class, 'findStateById']);
});