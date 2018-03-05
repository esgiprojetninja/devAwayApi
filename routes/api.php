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

Route::get('foo', function () {
    return 'Hello World';
});

Route::post('login', 'Auth\LoginController@login');

Route::group(['middleware' => ['api', 'auth'], 'prefix' => '/v1'], function () {
    Route::resource('accommodations', 'Api\v1\AccommodationController');
    Route::resource('candidates', 'Api\v1\CandidateController');
    Route::resource('messages', 'Api\v1\MessageController');
    Route::resource('missions', 'Api\v1\MissionController');
    Route::resource('pictures', 'Api\v1\PictureController');
    Route::resource('users', 'Api\v1\UserController');
});