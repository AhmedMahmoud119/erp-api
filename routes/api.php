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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);
    return true;
});

Route::get('languages/list', function () {
    $lang = 'ar';
    $full_data = include(base_path('resources/lang/' . $lang . '/messages.php'));
    $lang_data = [];
    ksort($full_data);
    foreach ($full_data as $key => $data) {
        array_push($lang_data, ['key' => $key, 'value' => $data]);
    }

    return response()->json($full_data);
});
