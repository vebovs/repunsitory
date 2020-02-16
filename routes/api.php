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

//List puns
Route::get('pun', 'PunController@index');

//List single pun
Route::get('pun/{id}', 'PunController@show');

//Create pun
Route::post('pun/create', 'PunController@store');

//Update pun
Route::put('pun/{id}', 'PunController@store');

//Delete pun
Route::delete('pun/{id}', 'PunController@destroy');
