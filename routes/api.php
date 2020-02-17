<?php

use Illuminate\Http\Request;

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

Route::post('auth/register', 'AuthController@register');

//List popular puns
Route::get('popular', 'PunController@popular');

//List recent puns
Route::get('recent', 'PunController@recent');

//List single pun
Route::get('pun/{id}', 'PunController@show');

//Create pun
Route::post('pun/create', 'PunController@store');

//Update pun
Route::put('pun/{id}', 'PunController@store');

//Delete pun
Route::delete('pun/{id}', 'PunController@destroy');
