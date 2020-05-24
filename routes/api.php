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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/register', 'Api\AuthController@register');
Route::post('/login', 'Api\AuthController@login');

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('auth/me', 'Api\AuthController@local');
    Route::get('oauth/me', 'Api\AuthController@oauth');
    Route::get('/profile', 'Api\ProfileController@show');
    Route::patch('/profile', 'Api\ProfileController@update');
});

Route::apiResource('/users', 'Api\UserController')->middleware('auth:api');
