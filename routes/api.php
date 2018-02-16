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
    return 'Hello World test';
});

Route::group(['middleware' => ['api'], 'prefix' => '/v1'], function () {
    Route::resource('users', 'Api\v1\UserController');
});