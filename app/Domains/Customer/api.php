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

Route::group(['middleware' => 'auth:sanctum','prefix' => 'customer'],function (){
    Route::get('/', [\App\Domains\Customer\Controllers\CustomerController::class, 'list']);
    Route::get('/{id}', [\App\Domains\Customer\Controllers\CustomerController::class, 'findById']);
    Route::delete('/{id}', [\App\Domains\Customer\Controllers\CustomerController::class, 'delete']);
    Route::post('/create', [\App\Domains\Customer\Controllers\CustomerController::class, 'create']);
    Route::post('/update/{id}', [\App\Domains\Customer\Controllers\CustomerController::class, 'update']);


});

Route::group(['middleware' => 'auth:sanctum','prefix' => 'report'],function (){

    Route::get('/sales', [\App\Domains\Customer\Controllers\CustomerController::class, 'salesReport']);
    Route::get('/sales/export/csv', [\App\Domains\Customer\Controllers\CustomerController::class, 'salesReportExportCSV']);
    Route::get('/sales/export/pdf', [\App\Domains\Customer\Controllers\CustomerController::class, 'salesReportExportPDF']);

});
