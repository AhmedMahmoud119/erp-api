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


Route::group(['middleware' => 'auth:sanctum','prefix' => 'tenant'],function (){
    Route::get('/', [\App\Domains\Tenant\Controllers\TenantController::class, 'list']);
    Route::get('/{id}', [\App\Domains\Tenant\Controllers\TenantController::class, 'findById']);
    Route::delete('/{id}', [\App\Domains\Tenant\Controllers\TenantController::class, 'delete']);
    Route::post('/create', [\App\Domains\Tenant\Controllers\TenantController::class, 'create']);
    Route::post('/update/{id}', [\App\Domains\Tenant\Controllers\TenantController::class, 'update']);
});


