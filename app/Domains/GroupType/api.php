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

Route::group(['middleware' => 'auth:sanctum','prefix' => 'groupType'],function (){
    Route::get('/', [\App\Domains\GroupType\Controllers\GroupTypeController::class, 'list']);
    Route::get('/treeview', [\App\Domains\GroupType\Controllers\GroupTypeController::class, 'getTreeView']);
    Route::get('/{id}', [\App\Domains\GroupType\Controllers\GroupTypeController::class, 'findById']);
    Route::delete('/{id}', [\App\Domains\GroupType\Controllers\GroupTypeController::class, 'delete']);
    Route::post('/create', [\App\Domains\GroupType\Controllers\GroupTypeController::class, 'create']);
    Route::post('/update/{id}', [\App\Domains\GroupType\Controllers\GroupTypeController::class, 'update']);

    Route::get('/export/tree-view-pdf', [\App\Domains\GroupType\Controllers\GroupTypeController::class, 'treeViewPDF']);

});
Route::get('/docs/swagger', function () {
    return view('swagger.index');
});

