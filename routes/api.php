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

Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');
Route::get('logout', 'API\UserController@logout')->middleware('auth:api');

Route::post('/show','API\UserController@show')->middleware('auth:api');
Route::get('/edit/{id}','API\UserController@edit')->middleware('auth:api');
Route::PUT('/update/{id}','API\UserController@update')->middleware('auth:api');
Route::DELETE('/delete/{id}','API\UserController@delete')->middleware('auth:api');


