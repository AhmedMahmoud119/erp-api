<?php

use App\Domains\UnitType\Controllers\UnitTypeController;
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
Route::group(['middleware' => 'auth:sanctum','prefix' => 'unit-type'],function (){
    Route::get('/', [UnitTypeController::class, 'list']);
    Route::get('/{id}',[UnitTypeController::class, 'findById']);
    Route::delete('/{id}',[UnitTypeController::class, 'delete']);
    Route::post('/create', [UnitTypeController::class, 'create']);
    Route::post('/update/{id}', [UnitTypeController::class, 'update']);
});
