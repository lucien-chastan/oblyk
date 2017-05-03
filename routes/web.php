<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//page d'accueille
Route::get('/', function () {return view('pages.home.index');});

Auth::routes();


//Route::get('/home', 'HomeController@index');

//page liée au projet
Route::get('/le-projet', 'ProjectPagesController@projectPage')->name('project');
Route::get('/qui-sommes-nous', 'ProjectPagesController@whoPage')->name('who');
Route::get('/contact', 'ProjectPagesController@contactPage')->name('contact');
Route::get('/a-propos', 'ProjectPagesController@aboutPage')->name('about');
Route::get('/aides', 'ProjectPagesController@helpPage')->name('help');
Route::get('/nous-soutenire', 'ProjectPagesController@supportUsPage')->name('supportUs');
Route::get('/developpeur', 'ProjectPagesController@developerPage')->name('developer');
Route::get('/conditions-utilisation', 'ProjectPagesController@termsOfUsePage')->name('termsOfUse');


//carte
Route::get('/carte-des-falaises', 'MapController@mapPage')->name('map');


//outdoor
Route::get('/site-escalade/{crag_id}/{crag_label}', 'CragController@cragPage');


//MODAL
Route::post('/modal/description', 'ModalController@descriptionModal')->name('descriptionModal');

//DATA
Route::post('/ajax-data/description', 'DescriptionController@descriptionAjaxData')->name('descriptionAjaxData');