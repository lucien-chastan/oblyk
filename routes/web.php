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
Route::get('/', 'HomeController@indexPage')->name('index');

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

//UN ARTICLE
Route::get('/article/{article_id}/{article_label}', 'ArticleController@articlePage')->name('articlePage');

//LE LEXIQUE
Route::get('/lexique-escalade', 'LexiqueController@lexiquePage')->name('lexique');

//LA RECHERCHE
Route::get('/API/search/{search}', 'searchController@search')->name('globalSearch');

//LE POFIL
Route::get('/grimpeur/{user_id}/{user_label}', 'UserController@userPage')->name('userPage');

//VUE DU PROFIL
Route::get('/vue/profile/{profile_id}/follow', 'Vue\UserVueController@vueFollow')->name('vueFollowUser');
Route::get('/vue/profile/{profile_id}/friend', 'Vue\UserVueController@vueFriend')->name('vueFriendUser');
Route::get('/vue/profile/{profile_id}/topotheque', 'Vue\UserVueController@vueTopotheque')->name('vueTopothequeUser');
Route::get('/vue/profile/{profile_id}/dashboard', 'Vue\UserVueController@vueDashboard')->name('vueDashboardUser');
Route::get('/vue/profile/{profile_id}/a-propos', 'Vue\UserVueController@vueAPropos')->name('vueAProposUser');
Route::get('/vue/profile/{profile_id}/fil-actu', 'Vue\UserVueController@vueFilActu')->name('vueFilActuUser');
Route::get('/vue/profile/{profile_id}/albums', 'Vue\UserVueController@vueAlbums')->name('vueAlbumsUser');
Route::get('/vue/profile/{profile_id}/{album_id}/photos', 'Vue\UserVueController@vuePhotos')->name('vuePhotosUser');
Route::get('/vue/profile/{profile_id}/videos', 'Vue\UserVueController@vueVideos')->name('vueVideosUser');
Route::get('/vue/profile/{profile_id}/croix', 'Vue\UserVueController@vueCroix')->name('vueCroixUser');
Route::get('/vue/profile/{profile_id}/tick-list', 'Vue\UserVueController@vueTickList')->name('vueTickListUser');
Route::get('/vue/profile/{profile_id}/projet', 'Vue\UserVueController@vueProjet')->name('vueProjetUser');
Route::get('/vue/profile/{profile_id}/analytiks', 'Vue\UserVueController@vueAnalytiks')->name('vueAnalytiksUser');
Route::get('/vue/profile/{profile_id}/messages', 'Vue\UserVueController@vueMessagerie')->name('vueMessagesUser');
Route::get('/vue/profile/{profile_id}/mes-lieux', 'Vue\UserVueController@vueLieux')->name('vueLieuxUser');
Route::get('/vue/profile/{profile_id}/partenaire-parametres', 'Vue\UserVueController@vuePartenaireParametres')->name('vuePartenaireParametresUser');
Route::get('/vue/profile/{profile_id}/notifications', 'Vue\UserVueController@vueNotifications')->name('vueNotificationsUser');
Route::get('/vue/profile/{profile_id}/parametres', 'Vue\UserVueController@vueSettings')->name('vueEditSettingsUser');

//SOUS VUE DES BOÎTES DU DASHBORD
Route::get('/vue/dashboard/{profile_id}/welcome', 'Vue\UserVueController@subVueWelcome')->name('subVueWelcomeUser');
Route::get('/vue/dashboard/{profile_id}/croix-pote', 'Vue\UserVueController@subVueCroixPote')->name('subVueCroixPoteUser');
Route::get('/vue/dashboard/{profile_id}/mes-croix', 'Vue\UserVueController@subVueMesCroix')->name('subVueMesCroixUser');
Route::get('/vue/dashboard/{profile_id}/forum-last', 'Vue\UserVueController@subVueForumLast')->name('subVueForumLastUser');
Route::get('/vue/dashboard/{profile_id}/news-oblyk', 'Vue\UserVueController@subVueNewsOblyk')->name('subVueNewsOblykUser');
Route::get('/vue/dashboard/{profile_id}/photos-last', 'Vue\UserVueController@subVuephotosLast')->name('subVuephotosLastUser');
Route::get('/vue/dashboard/{profile_id}/videos-last', 'Vue\UserVueController@subVueVideosLast')->name('subVueVideosLastUser');
Route::get('/vue/dashboard/{profile_id}/comments-last', 'Vue\UserVueController@subVueCommentsLast')->name('subVueCommentsLastUser');
Route::get('/vue/dashboard/{profile_id}/routes-last', 'Vue\UserVueController@subVueRoutesLast')->name('subVueRoutesLastUser');
Route::get('/vue/dashboard/{profile_id}/crags-last', 'Vue\UserVueController@subVueCragsLast')->name('subVueCragsLastUser');
Route::get('/vue/dashboard/{profile_id}/topos-last', 'Vue\UserVueController@subVueToposLast')->name('subVueToposLastUser');
Route::get('/vue/dashboard/{profile_id}/users-last', 'Vue\UserVueController@subVueUsersLast')->name('subVueUsersLastUser');
Route::get('/vue/dashboard/{profile_id}/sae-last', 'Vue\UserVueController@subVueSaeLast')->name('subVueSaeLastUser');
Route::get('/vue/dashboard/{profile_id}/list-crag-sae', 'Vue\UserVueController@subVueListCragSae')->name('subVueListCragSaeUser');
Route::get('/vue/dashboard/{profile_id}/partenaire', 'Vue\UserVueController@subVuePartenaire')->name('subVuePartenaireUser');
Route::get('/vue/dashboard/{profile_id}/random-word', 'Vue\UserVueController@subVueRandomWord')->name('subVueRandomWordUser');
Route::get('/vue/dashboard/{profile_id}/contribution', 'Vue\UserVueController@subVueContribution')->name('subVueContributionUser');


//VUES DE LA MESSAGERIE
Route::post('/messagerie/conversations', 'Vue\UserVueController@vueConversations')->name('vueConversations');
Route::post('/messagerie/messages', 'Vue\UserVueController@vueMessages')->name('vueMessages');
Route::get('/messagerie/userSearch/{conversation_id}/{search}', 'CRUD\UserConversationController@userSearch')->name('userSearchConversation');
Route::post('/messagerie/addUser', 'CRUD\UserConversationController@addUser')->name('addUserConversation');
Route::post('/messagerie/newInConversation', 'CRUD\UserConversationController@newInConversation')->name('newInConversation');
Route::post('/message/new', 'CRUD\UserConversationController@newMessage')->name('newMessage');


//NOUVEAU MESSAGE ET NOTIFICATION
Route::post('/new/notifications-and-messages', 'UserController@getNewNotificationAndMessage')->name('getNewNotificationAndMessage');
Route::post('/notification/read', 'CRUD\NotificationController@notificationAsRead')->name('notificationAsRead');


//LE FIL D'ACTUALITÉ
Route::post('/post/getVue', 'PostController@postsVue')->name('postsVue');
Route::post('/post/getOne', 'PostController@getOnePost')->name('getOnePost');
Route::post('/user/actuality', 'PostController@userActuality')->name('userActuality');
Route::post('/post/upload', 'CRUD\PostController@uploadPostImage')->name('uploadPostImage');
Route::post('/post/vueOnePost', 'PostController@vueOnePost')->name('vueOnePost');
Route::post('/like/add', 'LikeController@addLike')->name('addLike');


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


//FORUM
Route::get('/forum-escalade/creer-un-sujet/{category_id}', 'ForumController@createdPage')->name('createTopics');
Route::get('/forum-escalade/accueil', 'ForumController@forumPage')->name('forum');
Route::get('/forum-escalade/les-categories', 'ForumController@categoryPage')->name('forumCategories');
Route::get('/forum-escalade/les-sujets', 'ForumController@topicsPage')->name('forumTopics');
Route::get('/forum-escalade/les-regles', 'ForumController@rulesPage')->name('forumRules');
Route::get('/forum-escalade/{topic_id}/{topic_label}', 'ForumController@topicPage')->name('topicPage');

// PARTENAIRE
Route::get('/partenaire-escalade/carte-des-grimpeurs', 'PartnerController@mapPage')->name('partnerMapPage');
Route::get('/partenaire-escalade/comment-ca-marche', 'PartnerController@howPage')->name('partnerHowPage');
Route::post('/user/save-birth', 'CRUD\UserController@saveBirth')->name('saveUserBirth');


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
Route::post('/modal/comment', 'CRUD\CommentController@commentModal')->name('commentModal');
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
Route::post('/modal/album', 'CRUD\AlbumController@albumModal')->name('albumModal');
Route::post('/modal/socialNetwork', 'CRUD\SocialNetworkController@socialNetworkModal')->name('socialNetworkModal');
Route::post('/modal/conversation', 'CRUD\ConversationController@conversationModal')->name('conversationModal');
Route::post('/modal/userConversation', 'CRUD\UserConversationController@userConversationModal')->name('userConversationModal');
Route::post('/modal/post', 'CRUD\PostController@postModal')->name('postModal');
Route::post('/modal/like', 'LikeController@likeModal')->name('likeModal');
Route::post('/modal/topic', 'CRUD\TopicController@topicModal')->name('topicModal');
Route::post('/modal/cross', 'CRUD\CrossController@crossModal')->name('crossModal');
Route::post('/modal/crossUser', 'CRUD\CrossController@crossUserModal')->name('crossUserModal');
Route::post('/modal/userPlace', 'CRUD\PartnerController@partnerModal')->name('partnerModal');


//CRUD AJAX
Route::resource('descriptions', 'CRUD\DescriptionController');
Route::resource('comments', 'CRUD\CommentController');
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
Route::resource('albums', 'CRUD\AlbumController');
Route::resource('tickLists', 'CRUD\TickListController');
Route::resource('users', 'CRUD\UserController');
Route::resource('socialNetworks', 'CRUD\SocialNetworkController');
Route::resource('conversations', 'CRUD\ConversationController');
Route::resource('userConversations', 'CRUD\UserConversationController');
Route::resource('messages', 'CRUD\MessageController');
Route::resource('posts', 'CRUD\PostController');
Route::resource('notifications', 'CRUD\NotificationController');
Route::resource('topics', 'CRUD\TopicController');
Route::resource('crosses', 'CRUD\CrossController');
Route::post('/cross/users', 'CRUD\CrossController@crossUsers')->name('crossUsersScript');
Route::resource('partners', 'CRUD\PartnerController');

//CRUD USER
Route::post('/user/settings/save', 'CRUD\UserController@saveSettings')->name('saveUserSettings');
Route::post('/user/settings/messagerie', 'CRUD\UserController@saveUserMessagerieSettings')->name('saveUserMessagerieSettings');
Route::post('/user/settings/confidentialite', 'CRUD\UserController@saveUserConfidentialiteSettings')->name('saveUserConfidentialiteSettings');
Route::post('/user/settings/mail-password', 'CRUD\UserController@saveMailPassword')->name('saveMailPassword');
Route::post('/user/settings/filter', 'CRUD\UserController@saveFilterSettings')->name('saveFilterSettings');
Route::post('/upload/userBandeau', 'CRUD\UserController@uploadBandeau')->name('uploadBandeau');
Route::post('/upload/userPhotoProfile', 'CRUD\UserController@uploadPhotoProfile')->name('uploadPhotoProfile');

//FOLLOW (DELETE)
Route::post('/follow/delete', 'CRUD\FollowController@deleteFollow')->name('deleteFollow');
Route::post('/user/relation', 'CRUD\FollowController@userRelation')->name('userRelation');

//TICK LISTS (DELETE)
Route::post('/tick-list/delete', 'CRUD\TickListController@deleteTickList')->name('deleteTickList');
Route::post('/tick-list/add', 'CRUD\TickListController@addTickList')->name('addTickList');


// CRUD PARTNER
Route::post('/partner/active', 'CRUD\PartnerController@activePartner')->name('activePartnerScript');
Route::post('/partner/place/active', 'CRUD\PartnerController@activePlace')->name('activePlaceScript');
Route::post('/partner/setting-map', 'CRUD\PartnerController@mapPlaces')->name('mapPlacesScript');
Route::post('/partner/save-settings', 'CRUD\PartnerController@saveSettings')->name('saveUserPartnerSettings');
Route::post('/partner/getPartnerPoints', 'PartnerController@getPartnerPoints')->name('getPartnerPoints');
Route::post('/partner/getUserInformation', 'PartnerController@getUserInformation')->name('getUserInformation');
Route::post('/partner/getMyPlaces', 'PartnerController@getMyPlaces')->name('getMyPlaces');


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
Route::get('/vue/route/{route_id}/carnet','Vue\RouteVueController@vueCarnet')->name('vueCarnetRoute');

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
Route::post('/chart/cross/climb-type', 'Chart\Crosses\UserCrossesTypeClimbController@climbChart')->name('climbUserCrossesChart');

//CHART - ANALYTIKS
// -> tab : route
Route::post('/chart/analytiks/grades', 'Chart\Crosses\routeChartsController@grades')->name('gradeAnalytiksChart');
Route::post('/chart/analytiks/climbs', 'Chart\Crosses\routeChartsController@climbs')->name('climbsAnalytiksChart');
Route::post('/chart/analytiks/statuses', 'Chart\Crosses\routeChartsController@statuses')->name('statusesAnalytiksChart');
Route::post('/chart/analytiks/modes', 'Chart\Crosses\routeChartsController@modes')->name('modesAnalytiksChart');

// -> tab : environment
Route::post('/chart/analytiks/rocks', 'Chart\Crosses\environmentChartsController@rocks')->name('rocksAnalytiksChart');
Route::post('/chart/analytiks/crags', 'Chart\Crosses\environmentChartsController@crags')->name('cragsAnalytiksChart');
Route::post('/chart/analytiks/regions', 'Chart\Crosses\environmentChartsController@regions')->name('regionsAnalytiksChart');
Route::post('/chart/analytiks/pays', 'Chart\Crosses\environmentChartsController@pays')->name('paysAnalytiksChart');
Route::post('/chart/analytiks/maps', 'Chart\Crosses\environmentChartsController@maps')->name('mapsAnalytiksChart');

// -> tab : période
Route::post('/chart/analytiks/years', 'Chart\Crosses\timeChartsController@years')->name('yearsAnalytiksChart');
Route::post('/chart/analytiks/months', 'Chart\Crosses\timeChartsController@months')->name('monthsAnalytiksChart');
Route::post('/chart/analytiks/time-lines', 'Chart\Crosses\timeChartsController@timeLines')->name('timeLinesAnalytiksChart');

//SIMILAR
Route::post('/similar/route', 'RouteController@similarRoute')->name('similarRoute');


//FOLLOW
Route::post('/follow/user','FollowController@getUserFollows')->name('followUser');