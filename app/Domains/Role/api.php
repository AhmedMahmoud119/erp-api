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
Route::group(['middleware' => 'auth:sanctum','prefix' => 'role'],function (){
    Route::get('/', [\App\Domains\Role\Controllers\RoleController::class, 'list']);
    Route::get('/{id}', [\App\Domains\Role\Controllers\RoleController::class, 'findById']);
    Route::delete('/{id}', [\App\Domains\Role\Controllers\RoleController::class, 'delete']);
    Route::post('/create', [\App\Domains\Role\Controllers\RoleController::class, 'create']);
    Route::post('/update/{id}', [\App\Domains\Role\Controllers\RoleController::class, 'update']);
});
