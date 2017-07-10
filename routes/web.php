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

//PAGE D'ACCUIELLE
Route::get('/', function () {return view('pages.home.index');});

Auth::routes();


//PAGE LIÉES AU POJET
Route::get('/le-projet', 'ProjectPagesController@projectPage')->name('project');
Route::get('/qui-sommes-nous', 'ProjectPagesController@whoPage')->name('who');
Route::get('/contact', 'ProjectPagesController@contactPage')->name('contact');
Route::get('/a-propos', 'ProjectPagesController@aboutPage')->name('about');
Route::get('/aides', 'ProjectPagesController@helpPage')->name('help');
Route::get('/nous-soutenire', 'ProjectPagesController@supportUsPage')->name('supportUs');
Route::get('/developpeur', 'ProjectPagesController@developerPage')->name('developer');
Route::get('/conditions-utilisation', 'ProjectPagesController@termsOfUsePage')->name('termsOfUse');

//LE LEXIQUE
Route::get('/lexique-escalade', 'LexiqueController@lexiquePage')->name('lexique');

//LA RECHERCHE
Route::get('/API/search/{search}', 'searchController@search')->name('globalSearch');

//LE POFIL
Route::get('/grimpeur/{user_id}/{user_label}', 'UserController@userPage')->name('userPage');


//LA CARTE
Route::get('/carte-des-falaises', 'MapController@mapPage')->name('map');


//OUTDOOD
Route::get('/site-escalade/{crag_id}/{crag_label}', 'CragController@cragPage')->name('cragPage');
Route::get('/topo-escalade/{topo_id}/{topo_label}', 'TopoController@topoPage')->name('topoPage');
Route::get('/sites-escalade/{massive_id}/{massive_label}', 'MassiveController@massivePage')->name('massivePage');
Route::get('/API/crags/{lat}/{lng}/{rayon}', 'MapController@getPopupMarkerAroundPoint')->name('APIMarkerMap');
Route::get('/API/topo/crags/{topo_id}/', 'MapController@getPopupMarkerCragsTopo')->name('APICragsTopoMap');
Route::get('/API/massive/crags/{massive_id}/', 'MapController@getPopupMarkerCragsMassive')->name('APICragsMassiveMap');
Route::get('/API/topo/sales/{topo_id}/', 'MapController@getPopupMarkerSalesTopo')->name('APISalesTopoMap');

//TOPO (VERS LES SCRIPTS DE LIAISON)
Route::get('/API/topos/{lat}/{lng}/{rayon}/{crag_id}', 'TopoController@getToposArroundPoint')->name('APIToposArroundPoint');
Route::post('/topo/create-liaison', 'CRUD\TopoCragController@createLiaison')->name('ScriptCreateLiaison');
Route::post('/topo/delete-liaison', 'CRUD\TopoCragController@deleteLiaison')->name('ScriptDeleteLiaison');

//MASSIVE (VERS LES SCRIPTS DE LIAISON)
Route::get('/API/massives/{lat}/{lng}/{rayon}/{crag_id}', 'MassiveController@getMassivesArroundPoint')->name('APIMassivesArroundPoint');
Route::post('/massive/create-liaison', 'CRUD\MassiveCragController@createLiaison')->name('ScriptCreateLiaison');
Route::post('/massive/delete-liaison', 'CRUD\MassiveCragController@deleteLiaison')->name('ScriptDeleteLiaison');


//UPLOAD
Route::post('/upload/topoCouverture', 'CRUD\TopoController@uploadCouvertureTopo')->name('uploadCouvertureTopo');

//MODAL
Route::post('/modal/crag', 'CRUD\CragController@cragModal')->name('cragModal');
Route::post('/modal/description', 'CRUD\DescriptionController@descriptionModal')->name('descriptionModal');
Route::post('/modal/link', 'CRUD\LinkController@linkModal')->name('linkModal');
Route::post('/modal/parking', 'CRUD\ParkingController@parkingModal')->name('parkingModal');
Route::post('/modal/delete', 'CRUD\DeleteController@deleteModal')->name('deleteModal');
Route::post('/modal/problem', 'CRUD\ProblemController@problemModal')->name('problemModal');
Route::post('/modal/sector', 'CRUD\SectorController@sectorModal')->name('sectorModal');
Route::post('/modal/route', 'CRUD\RouteController@routeModal')->name('routeModal');
Route::post('/modal/photo', 'CRUD\PhotoController@photoModal')->name('photoModal');
Route::post('/modal/video', 'CRUD\VideoController@videoModal')->name('videoModal');
Route::post('/modal/bandeau', 'CRUD\CragController@bandeauModal')->name('bandeauModal');
Route::post('/modal/topo', 'CRUD\TopoController@topoModal')->name('topoModal');
Route::post('/modal/topoSale', 'CRUD\TopoSaleController@topoSaleModal')->name('topoSaleModal');
Route::post('/modal/topoCrag', 'CRUD\TopoCragController@topoCragModal')->name('topoCragModal');
Route::post('/modal/topoWeb', 'CRUD\TopoWebController@topoWebModal')->name('topoWebModal');
Route::post('/modal/topoPdf', 'CRUD\TopoPdfController@topoPdfModal')->name('topoPdfModal');
Route::post('/modal/topoCouverture', 'CRUD\TopoController@topoCouvertureModal')->name('topoCouvertureModal');
Route::post('/modal/massive', 'CRUD\MassiveController@massiveModal')->name('massiveModal');
Route::post('/modal/massiveCrag', 'CRUD\MassiveCragController@massiveCragModal')->name('massiveCragModal');
Route::post('/modal/word', 'CRUD\WordController@wordModal')->name('wordModal');


//CRUD AJAX
Route::resource('descriptions', 'CRUD\DescriptionController');
Route::resource('links', 'CRUD\LinkController');
Route::resource('crags', 'CRUD\CragController');
Route::resource('parkings', 'CRUD\ParkingController');
Route::resource('sectors', 'CRUD\SectorController');
Route::resource('routes', 'CRUD\RouteController');
Route::resource('photos', 'CRUD\PhotoController');
Route::resource('videos', 'CRUD\VideoController');
Route::resource('topos', 'CRUD\TopoController');
Route::resource('topoCrags', 'CRUD\TopoCragController');
Route::resource('topoSales', 'CRUD\TopoSaleController');
Route::resource('topoWebs', 'CRUD\TopoWebController');
Route::resource('topoPdfs', 'CRUD\TopoPdfController');
Route::resource('massives', 'CRUD\MassiveController');
Route::resource('massiveCrags', 'CRUD\MassiveCragController');
Route::resource('words', 'CRUD\WordController');
Route::resource('follows', 'CRUD\FollowController');

//FOLLOW (DELETE)
Route::post('/follow/delete', 'CRUD\FollowController@deleteFollow')->name('deleteFollow');

//PROBLEM
Route::post('/send/problem', 'CRUD\ProblemController@sendProblem')->name('sendProblem');

//BANDEAU
Route::post('/bandeau/define', 'CRUD\CragController@defineBandeau')->name('defineBandeau');


//VUE CRAG
Route::get('/vue/crag/{crag_id}/map', 'Vue\CragVueController@vueMap')->name('vueMapCrag');
Route::get('/vue/crag/{crag_id}/fil-actu', 'Vue\CragVueController@vueFilActu')->name('vueFilActuCrag');
Route::get('/vue/crag/{crag_id}/medias', 'Vue\CragVueController@vueMedias')->name('vueMediasCrag');
Route::get('/vue/crag/{crag_id}/liens', 'Vue\CragVueController@vueLiens')->name('vueLiensCrag');
Route::get('/vue/crag/{crag_id}/topos', 'Vue\CragVueController@vueTopos')->name('vueToposCrag');
Route::get('/vue/crag/{crag_id}/secteur', 'Vue\CragVueController@vueSecteur')->name('vueSecteurCrag');

//VUE SECTEUR
Route::get('/vue/sector/{sector_id}/lines', 'Vue\SectorVueController@vueRoutes')->name('vueRoutesSector');
Route::get('/vue/sector/{sector_id}/descriptions', 'Vue\SectorVueController@vueDescriptions')->name('vueDescriptionsSector');
Route::get('/vue/sector/{sector_id}/photos', 'Vue\SectorVueController@vuePhotos')->name('vuePhotosSector');

//VUE ROUTE
Route::get('/vue/route/{route_id}/route','Vue\RouteVueController@vueRoute')->name('vueRouteRoute');
Route::get('/vue/route/{route_id}/information','Vue\RouteVueController@vueInformation')->name('vueInformationRoute');
Route::get('/vue/route/{route_id}/comments','Vue\RouteVueController@vueComments')->name('vueCommentsRoute');
Route::get('/vue/route/{route_id}/photos','Vue\RouteVueController@vuePhotos')->name('vuePhotosRoute');
Route::get('/vue/route/{route_id}/videos','Vue\RouteVueController@vueVideos')->name('vueVideosRoute');

//VUE TOPO
Route::get('/vue/topo/{topo_id}/fil-actu','Vue\TopoVueController@vueFilActu')->name('vueFilActuTopo');
Route::get('/vue/topo/{topo_id}/liens','Vue\TopoVueController@vueLiens')->name('vueLiensTopo');
Route::get('/vue/topo/{topo_id}/sites','Vue\TopoVueController@vueSites')->name('vueSitesTopo');
Route::get('/vue/topo/{topo_id}/acheter','Vue\TopoVueController@vueAcheter')->name('vueAcheterTopo');
Route::get('/vue/topo/{topo_id}/map','Vue\TopoVueController@vueMap')->name('vueMapTopo');

//VUE MASSIVE
Route::get('/vue/massive/{massive_id}/fil-actu','Vue\MassiveVueController@vueFilActu')->name('vueFilActuMassive');
Route::get('/vue/massive/{massive_id}/liens','Vue\MassiveVueController@vueLiens')->name('vueLiensMassive');
Route::get('/vue/massive/{massive_id}/sites','Vue\MassiveVueController@vueSites')->name('vueSitesMassive');


//CHART
Route::get('/chart/crag/{crag_id}/grade', 'Chart\CragChartController@gradeChart')->name('gradeCragChart');
Route::get('/chart/crag/{crag_id}/climb', 'Chart\CragChartController@climbChart')->name('climbCragChart');
Route::get('/chart/sector/{sector_id}/grade', 'Chart\SectorChartController@gradeChart')->name('gradeSectorChart');


//SIMILAR
Route::post('/similar/route', 'RouteController@similarRoute')->name('similarRoute');


//FOLLOW
Route::post('/follow/user','FollowController@getUserFollows')->name('followUser');