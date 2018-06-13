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

Route::post('login', [ 'as' => 'login', 'uses' => 'Api\v1\PassportController@login']);
Route::post('register', 'Api\v1\PassportController@register');


Route::group(['middleware' => 'api', 'prefix' => '/v1'], function () {
    Route::get('accommodations', 'Api\v1\AccommodationController@index');
    Route::get('accommodations/{id}', 'Api\v1\AccommodationController@show');
});

Route::group(['middleware' => ['api', 'auth:api'], 'prefix' => '/v1'], function () {

    //ACCOMMODATIONS
    Route::get('accommodations/{idAccommodation}/pictures', 'Api\v1\AccommodationController@getPictures');
    Route::get('accommodations/{idAccommodation}/host', 'Api\v1\AccommodationController@getHost');
    Route::delete('accommodations/{id}', 'Api\v1\AccommodationController@destroy');
    Route::put('accommodations/{id}', 'Api\v1\AccommodationController@update');
    Route::post('accommodations', 'Api\v1\AccommodationController@store');

    //CANDIDATES
    Route::resource('candidates', 'Api\v1\CandidateController');

    //MESSAGES
    Route::resource('messages', 'Api\v1\MessageController');
    Route::get('messages/me/latest', 'Api\v1\MessageController@getMyMessages');
    Route::get('messages/me/with/{idUser}', 'Api\v1\MessageController@getMyDiscutionWith');

    //MISSIONS
    Route::resource('missions', 'Api\v1\MissionController');
    Route::post('missions/{idMission}/apply', 'Api\v1\MissionController@apply');

    //PICTURES
    Route::resource('pictures', 'Api\v1\PictureController');

    //USERS
    Route::resource('users', 'Api\v1\UserController');
    Route::get('users/{idUser}/accommodations', 'Api\v1\UserController@getAccommodations');
    Route::get('users/me', function(Request $request) { return Auth::user(); });

});
