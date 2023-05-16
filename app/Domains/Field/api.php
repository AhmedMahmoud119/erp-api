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

Route::group(['middleware' => 'auth:sanctum','prefix' => 'field'],function (){
    Route::get('/', [\App\Domains\Field\Controllers\FieldController::class, 'list']);
    Route::get('/{id}', [\App\Domains\Field\Controllers\FieldController::class, 'findById']);
    Route::delete('/{id}', [\App\Domains\Field\Controllers\FieldController::class, 'delete']);
    Route::post('/create', [\App\Domains\Field\Controllers\FieldController::class, 'create']);
    Route::post('/update/{id}', [\App\Domains\Field\Controllers\FieldController::class, 'update']);

    Route::get('/list/field-types', [\App\Domains\Field\Controllers\FieldController::class, 'listFieldTypes']);

});
