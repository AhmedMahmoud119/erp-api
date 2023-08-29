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

Route::group(['middleware' => 'auth:sanctum','prefix' => 'revision-history'],function (){
    Route::get('/', [\App\Domains\RevisionHistory\Controllers\RevisionHistoryController::class, 'list']);
    Route::post('/create', [\App\Domains\RevisionHistory\Controllers\RevisionHistoryController::class, 'create']);
    Route::get('/{model}/model/{id}', [\App\Domains\RevisionHistory\Controllers\RevisionHistoryController::class, 'findByModel']);
    Route::get('/{id}', [\App\Domains\RevisionHistory\Controllers\RevisionHistoryController::class, 'findById']);


//    Route::delete('/{id}', [\App\Domains\RevisionHistory\Controllers\RevisionHistoryController::class, 'delete']);
//    Route::post('/update/{id}', [\App\Domains\RevisionHistory\Controllers\RevisionHistoryController::class, 'update']);
});
