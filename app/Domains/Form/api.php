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


Route::group(['middleware' => 'auth:sanctum','prefix' => 'form'],function (){

    Route::get('/', [\App\Domains\Form\Controllers\FormController::class, 'list']);
    Route::get('/{id}', [\App\Domains\Form\Controllers\FormController::class, 'findById']);
    Route::get('/{id}/versions', [\App\Domains\Form\Controllers\FormController::class, 'listFormVersions']);
    Route::delete('/{id}', [\App\Domains\Form\Controllers\FormController::class, 'delete']);
    Route::post('/create', [\App\Domains\Form\Controllers\FormController::class, 'create']);
    Route::post('/update/{id}', [\App\Domains\Form\Controllers\FormController::class, 'update']);
    Route::post('/{id}/add-field', [\App\Domains\Form\Controllers\FormController::class, 'addField']);
    Route::get('/version/{version_id}/details', [\App\Domains\Form\Controllers\FormController::class, 'versionDetails']);

    Route::post('/{id}/fill-data', [\App\Domains\Form\Controllers\FormController::class, 'fillData']);
    Route::get('/{id}/view-responses', [\App\Domains\Form\Controllers\FormController::class, 'viewResponses']);

    Route::get('version/{id}/view-responses', [\App\Domains\Form\Controllers\FormController::class, 'viewVersionResponses']);

    Route::get('/{id}/view-fields', [\App\Domains\Form\Controllers\FormController::class, 'viewFields']);
    Route::get('version/{id}/view-fields', [\App\Domains\Form\Controllers\FormController::class, 'viewVersionFields']);

    Route::delete('/field/{form_field_id}/delete-field', [\App\Domains\Form\Controllers\FormController::class, 'deleteFormField']);
    Route::post('/field/{form_field_id}/hide-field', [\App\Domains\Form\Controllers\FormController::class, 'hideFormField']);

    Route::get('/{id}/export', [\App\Domains\Form\Controllers\FormController::class, 'export']);
    Route::post('/{id}/createFieldInForm', [\App\Domains\Form\Repositories\FormMySqlRepository::class, 'createFieldInForm']);




});


