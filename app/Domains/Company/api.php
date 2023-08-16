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

Route::group(['middleware' => 'auth:sanctum','prefix' => 'company'],function (){
    Route::get('/', [\App\Domains\Company\Controllers\CompanyController::class, 'list']);
    Route::get('/{id}', [\App\Domains\Company\Controllers\CompanyController::class, 'findById']);
    Route::delete('/{id}', [\App\Domains\Company\Controllers\CompanyController::class, 'delete']);
    Route::post('/create', [\App\Domains\Company\Controllers\CompanyController::class, 'create']);
    Route::post('/update/{id}', [\App\Domains\Company\Controllers\CompanyController::class, 'update']);
    Route::post('/{id}/detach/{moduleId}', [\App\Domains\Company\Controllers\CompanyController::class, 'detachModule']);
});
