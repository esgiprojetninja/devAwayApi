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
Route::post('validate/email', 'Api\v1\PassportController@validateEmail');


Route::group(['middleware' => ['api', 'auth:api'], 'prefix' => '/v1'], function () {

    //ACCOMMODATIONS
    Route::post('accommodations', 'Api\v1\AccommodationController@store');
    Route::get('accommodations/{idAccommodation}/pictures', 'Api\v1\AccommodationController@getPictures');
    Route::get('accommodations/{idAccommodation}/host', 'Api\v1\AccommodationController@getHost');
    Route::delete('accommodations/{id}', 'Api\v1\AccommodationController@destroy');
    Route::put('accommodations/{id}', 'Api\v1\AccommodationController@update');

    //CANDIDATES
    Route::resource('candidates', 'Api\v1\CandidateController');

    //MESSAGES
    Route::resource('messages', 'Api\v1\MessageController');
    Route::get('messages/me/latest', 'Api\v1\MessageController@getMyMessages');
    Route::get('messages/me/with/{idUser}', 'Api\v1\MessageController@getMyDiscutionWith');

    //MISSIONS
    Route::post('missions', 'Api\v1\MissionController@store');
    Route::delete('missions', 'Api\v1\MissionController@destroy');
    Route::put('missions/{id}', 'Api\v1\MissionController@update');
    Route::post('missions/{idMission}/apply', 'Api\v1\MissionController@apply');
    Route::post('missions/{idMission}/leave', 'Api\v1\MissionController@leave');
    Route::post('missions/{idMission}/candidates/{idUser}/accept', 'Api\v1\MissionController@accept');
    Route::post('missions/{idMission}/candidates/{idUser}/refuse', 'Api\v1\MissionController@refuse');

    //PICTURES ACCOMMODATION
    Route::resource('pictures/accommodations', 'Api\v1\PictureAccommodationController');

    //PICTURES MISSION
    Route::resource('pictures/missions', 'Api\v1\PictureMissionController');

    //USERS
    Route::get('users/me', function(Request $request) { return Auth::user(); });
    Route::resource('users', 'Api\v1\UserController');
    Route::get('users/{idUser}/accommodations', 'Api\v1\UserController@getAccommodations');

    //PICTURES & ACCOMMODATIONS
    Route::put('accommodations/{id}/pictures', 'Api\v1\PictureAccommodationController@addPicture');

    //PICTURES & MISSIONS
    Route::put('missions/{id}/pictures', 'Api\v1\PictureMissionController@addPicture');
});

Route::group(['middleware' => 'api', 'prefix' => '/v1'], function () {
    Route::get('accommodations', 'Api\v1\AccommodationController@index');
    Route::get('accommodations/paginate', 'Api\v1\AccommodationController@paginateAll');
    Route::get('accommodations/search', 'Api\v1\AccommodationController@searchAccommodationByLocation');
    Route::get('missions', 'Api\v1\MissionController@index');

    Route::get('accommodations/{id}', 'Api\v1\AccommodationController@show');
    Route::get('missions/{id}', 'Api\v1\MissionController@show');
});