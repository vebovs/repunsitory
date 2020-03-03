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

//List popular puns
Route::get('popular', 'PublicPunController@popular');

//List recent puns
Route::get('recent', 'PublicPunController@recent');

// Auth
Route::post('login', 'ApiController@login');
Route::post('register', 'ApiController@register');

Route::group(['middleware' => 'auth.jwt'], function () {
    Route::get('logout', 'ApiController@logout');

    //List all puns
    Route::get('puns', 'PunController@index');

    //List single pun
    Route::get('pun/{id}', 'PunController@show');

    //Create pun
    Route::post('pun', 'PunController@store');

    //Update pun
    Route::put('pun/{id}', 'PunController@update');

    //Delete pun
    Route::delete('pun/{id}', 'PunController@destroy');

    //Like pun
    Route::get('pun/like/{id}', 'PunController@like');
});

