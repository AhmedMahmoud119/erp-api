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

Route::group(['middleware' => 'auth:sanctum','prefix' => 'permission'],function (){
    Route::get('/', [\App\Domains\Permission\Controllers\PermissionController::class, 'list']);
    Route::get('/{id}', [\App\Domains\Permission\Controllers\PermissionController::class, 'findById']);
});
