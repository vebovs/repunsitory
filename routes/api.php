<?php

use Illuminate\Http\Request;
use \Tymon\JWTAuth as JWTAuth;

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

//User login
Route::post('login', 'APIController@login');

//User registration
Route::post('register', 'APIController@register');

Route::group(['middleware' => 'jwt.auth'], function () {

    //Fetch user data upon page refresh
    Route::get('refresh', 'APIController@refresh');

    //User logout
    Route::get('logout', 'APIController@logout');

    //Get puns liked by user
    Route::get('user/liked', 'UserController@liked');

    //Delete user
    Route::delete('user', 'UserController@destroy');

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

    //Get all users
    Route::get('admin/users', 'AdminController@index')->middleware('admin.check');

    //Delete a user
    Route::delete('admin/user/{id}', 'AdminController@destroyUser')->middleware('admin.check');

    //Ban a user
    Route::delete('admin/ban/{id}', 'AdminController@banUser')->middleware('admin.check');

    //Delete a pun
    Route::delete('admin/pun/{id}', 'AdminController@destroyPun')->middleware('admin.check');

});

//Email Verification
Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');

