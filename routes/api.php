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

Route::group(array('prefix' => 'v1', 'middleware' => []), function () {

    // Guidebooks
    Route::get('guidebooks/{idOrEan}', 'API\ApiTopoController@getTopoResponse')->name('apiGetTopo');

    // Gym Grade
    Route::get('gym-grade-line/{id}', 'API\ApiGymGradeController@getGradeLineResponse')->name('apiGetGymGradeLine');

    // Crag
    Route::get('crags/{id}', 'API\ApiCragController@getCragResponse')->name('apiGetCrag');
    Route::get('crags/around-place/{lat}/{lng}/{radius}', 'API\ApiCragController@getCragsAroundPlaceResponse')->name('apiGetCragsAroundPlace');
});
