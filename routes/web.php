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

//******************************************************************
// Prefixed route with localization (fr/ or en/
//******************************************************************

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function() {

    // Auth route (connexion, login, etc)
    Auth::routes();

    // Home
    Route::get('/', 'HomeController@indexPage')->name('index');

    // Project page
    Route::get('/le-projet', 'ProjectPagesController@projectPage')->name('project');
    Route::get('/contact', 'ProjectPagesController@contactPage')->name('contact');
    Route::get('/a-propos', 'ProjectPagesController@aboutPage')->name('about');
    Route::get('/aides', 'ProjectPagesController@helpPage')->name('help');
    Route::get('/nous-soutenire', 'ProjectPagesController@supportUsPage')->name('supportUs');
    Route::get('/merci', 'ProjectPagesController@thanksPage')->name('thanks');
    Route::get('/developpeur', 'ProjectPagesController@developerPage')->name('developer');
    Route::get('/conditions-utilisation', 'ProjectPagesController@termsOfUsePage')->name('termsOfUse');
    Route::get('/indoor', 'ProjectPagesController@indoorPage')->name('indoorPresentation');

    // Newsletter
    Route::get('/news-letter/subscribe', 'SubscribeController@subscribePage')->name('subscribe');
    Route::get('/news-letter/unsubscribe', 'SubscribeController@unsubscribePage')->name('unsubscribe');
    Route::get('/news-letter/{ref}', 'NewsletterController@newsletterPage')->name('newsletter');

    // Articles
    Route::get('/les-articles', 'ArticleController@articlesPage')->name('articlesPage');
    Route::get('/article/{article_id}/{article_label}', 'ArticleController@articlePage')->name('articlePage');
    Route::get('/article/{article_id}', 'ArticleController@articleRedirectionPage')->name('articleRedirectionPage');

    // Glossary
    Route::get('/lexique-escalade', 'LexiqueController@lexiquePage')->name('lexique');

    // Profile
    Route::get('/grimpeur/{user_id}/{user_label}', 'UserController@userPage')->name('userPage');
    Route::get('/grimpeur/{user_id}', 'UserController@userRedirectionPage')->name('userRedirectionPage');
    Route::get('/supprimer-mon-compte', 'Auth\DeleteController@deleteUserPage')->name('deleteUserPage');
    Route::post('/delete-connected-user', 'Auth\DeleteController@deleteConnectedUser')->name('deleteConnectedUser');
    Route::get('/compte-supprime', 'Auth\DeleteController@userDeletedPage')->name('userDeletedPage');

    // Outdoor
    Route::get('/site-escalade/{crag_id}/{crag_label}', 'CragController@cragPage')->name('cragPage');
    Route::get('/topo-escalade/{topo_id}/{topo_label}', 'TopoController@topoPage')->name('topoPage');
    Route::get('/sites-escalade/{massive_id}/{massive_label}', 'MassiveController@massivePage')->name('massivePage');
    Route::get('/voie-escalade/{route_id}/{route_label}', 'RouteController@routePage')->name('routePage');

    // Outdoor redirection
    Route::get('/site-escalade/{crag_id}', 'CragController@cragRedirectionPage')->name('cragRedirectionPage');
    Route::get('/topo-escalade/{topo_id}', 'TopoController@topoRedirectionPage')->name('topoRedirectionPage');
    Route::get('/voie-escalade/{route_id}', 'RouteController@routeRedirectionPage')->name('routeRedirectionPage');
    Route::get('/sites-escalade/{massive_id}', 'MassiveController@massiveRedirectionPage')->name('massiveRedirectionPage');

    // Climbing gym
    Route::get('/salle-escalade/{gym_id}/{gym_label}', 'GymController@gymPage')->name('gymPage');
    Route::get('/salle-escalade/{gym_id}', 'GymController@gymRedirectionPage')->name('gymRedirectionPage');
    Route::get('/salle-escalade/{gym_id}/topo/{room_id}/{gym_label}', 'GymSchemeController@schemePage')->name('gymSchemePage');

    // Indoor route
    Route::get('/salle-escalade/{gym_id}/ligne/{route_id}', 'GymRouteController@gymRoutePage')->name('gymRoutePage');

    // Indoor scheme
    Route::get('/salle-escalade/topo/sectors/{room_id}', 'GymSchemeController@getGymSectorsView')->name('getGymSectorsView');
    Route::get('/salle-escalade/topo/sector/{sector_id}', 'GymSchemeController@getGymSectorView')->name('getGymSectorView');
    Route::get('/salle-escalade/topo/route/{route_id}', 'GymSchemeController@getGymRouteView')->name('getGymRouteView');
    Route::get('/salle-escalade/topo/crosses/{gym_id}', 'GymSchemeController@getGymCrossesView')->name('getGymCrossesView');

    // Map (crag and gym)
    Route::get('/carte-des-falaises', 'MapController@mapPage')->name('map');
    Route::get('/carte-des-salles', 'MapController@gymPage')->name('mapGym');

    // Tools pages
    Route::get('/cotations', 'ToolPagesController@gradePage')->name('grade');
    Route::get('/index', 'ToolPagesController@indexPage')->name('indexes');
    Route::get('/sites', 'ToolPagesController@cragsPage')->name('cragsIndex');
    Route::get('/salles', 'ToolPagesController@gymsPage')->name('gymsIndex');
    Route::get('/grimpeurs', 'ToolPagesController@usersPage')->name('usersIndex');
    Route::get('/topos', 'ToolPagesController@guidebooksPage')->name('guidebooksIndex');
    Route::get('/groupes', 'ToolPagesController@groupsPage')->name('groupsIndex');
    Route::get('/voies', 'ToolPagesController@routesPage')->name('routesIndex');

    // Forum
    Route::get('/forum-escalade/creer-un-sujet/{category_id}', 'ForumController@createdPage')->name('createTopics');
    Route::get('/forum-escalade/accueil', 'ForumController@forumPage')->name('forum');
    Route::get('/forum-escalade/les-categories', 'ForumController@categoryPage')->name('forumCategories');
    Route::get('/forum-escalade/les-sujets', 'ForumController@topicsPage')->name('forumTopics');
    Route::get('/forum-escalade/les-regles', 'ForumController@rulesPage')->name('forumRules');
    Route::get('/forum-escalade/{topic_id}/{topic_label}', 'ForumController@topicPage')->name('topicPage');

    // Partner
    Route::get('/partenaire-escalade/carte-des-grimpeurs', 'PartnerController@mapPage')->name('partnerMapPage');
    Route::get('/partenaire-escalade/comment-ca-marche', 'PartnerController@howPage')->name('partnerHowPage');

    // Search
    Route::get('/API/search/{limit}/{offset}/{type}/{search}', 'searchController@search')->name('globalSearch');

    // Profile views
    Route::get('/vue/profile/{profile_id}/follow', 'Vue\UserVueController@vueFollow')->name('vueFollowUser');
    Route::get('/vue/profile/{profile_id}/friend', 'Vue\UserVueController@vueFriend')->name('vueFriendUser');
    Route::get('/vue/profile/{profile_id}/topotheque', 'Vue\UserVueController@vueTopotheque')->name('vueTopothequeUser');
    Route::get('/vue/profile/{profile_id}/dashboard', 'Vue\UserVueController@vueDashboard')->name('vueDashboardUser');
    Route::get('/vue/profile/{profile_id}/a-propos', 'Vue\UserVueController@vueAPropos')->name('vueAProposUser');
    Route::get('/vue/profile/{profile_id}/fil-actu', 'Vue\UserVueController@vueFilActu')->name('vueFilActuUser');
    Route::get('/vue/profile/{profile_id}/albums', 'Vue\UserVueController@vueAlbums')->name('vueAlbumsUser');
    Route::get('/vue/profile/{profile_id}/{album_id}/photos', 'Vue\UserVueController@vuePhotos')->name('vuePhotosUser');
    Route::get('/vue/profile/{profile_id}/videos', 'Vue\UserVueController@vueVideos')->name('vueVideosUser');
    Route::get('/vue/profile/{profile_id}/croix', 'Vue\UserVueController@vueCrosses')->name('vueCroixUser');
    Route::get('/vue/profile/{profile_id}/tick-list', 'Vue\UserVueController@vueTickList')->name('vueTickListUser');
    Route::get('/vue/profile/{profile_id}/projet', 'Vue\UserVueController@vueProjet')->name('vueProjetUser');
    Route::get('/vue/profile/{profile_id}/analytiks', 'Vue\UserVueController@vueAnalytiks')->name('vueAnalytiksUser');
    Route::get('/vue/profile/{profile_id}/messages', 'Vue\UserVueController@vueMessagerie')->name('vueMessagesUser');
    Route::get('/vue/profile/{profile_id}/mes-lieux', 'Vue\UserVueController@vueLieux')->name('vueLieuxUser');
    Route::get('/vue/profile/{profile_id}/partenaire-parametres', 'Vue\UserVueController@vuePartenaireParametres')->name('vuePartenaireParametresUser');
    Route::get('/vue/profile/{profile_id}/notifications', 'Vue\UserVueController@vueNotifications')->name('vueNotificationsUser');
    Route::get('/vue/profile/{profile_id}/parametres', 'Vue\UserVueController@vueSettings')->name('vueEditSettingsUser');

    // Dashboard box views
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

    // Crag views
    Route::get('/vue/crag/{crag_id}/map', 'Vue\CragVueController@vueMap')->name('vueMapCrag');
    Route::get('/vue/crag/{crag_id}/fil-actu', 'Vue\CragVueController@vueFilActu')->name('vueFilActuCrag');
    Route::get('/vue/crag/{crag_id}/medias', 'Vue\CragVueController@vueMedias')->name('vueMediasCrag');
    Route::get('/vue/crag/{crag_id}/liens', 'Vue\CragVueController@vueLiens')->name('vueLiensCrag');
    Route::get('/vue/crag/{crag_id}/topos', 'Vue\CragVueController@vueTopos')->name('vueToposCrag');
    Route::get('/vue/crag/{crag_id}/secteur', 'Vue\CragVueController@vueSecteur')->name('vueSecteurCrag');

    // Sector views
    Route::get('/vue/sector/{sector_id}/lines', 'Vue\SectorVueController@vueRoutes')->name('vueRoutesSector');
    Route::get('/vue/sector/{sector_id}/descriptions', 'Vue\SectorVueController@vueDescriptions')->name('vueDescriptionsSector');
    Route::get('/vue/sector/{sector_id}/photos', 'Vue\SectorVueController@vuePhotos')->name('vuePhotosSector');

    // Route views
    Route::get('/vue/route/{route_id}/route','Vue\RouteVueController@vueRoute')->name('vueRouteRoute');
    Route::get('/vue/route/{route_id}/information','Vue\RouteVueController@vueInformation')->name('vueInformationRoute');
    Route::get('/vue/route/{route_id}/comments','Vue\RouteVueController@vueComments')->name('vueCommentsRoute');
    Route::get('/vue/route/{route_id}/photos','Vue\RouteVueController@vuePhotos')->name('vuePhotosRoute');
    Route::get('/vue/route/{route_id}/videos','Vue\RouteVueController@vueVideos')->name('vueVideosRoute');
    Route::get('/vue/route/{route_id}/carnet','Vue\RouteVueController@vueCarnet')->name('vueCarnetRoute');

    // Gym views
    Route::get('/vue/gym/{gym_id}/map', 'Vue\GymVueController@vueMap')->name('vueMapGym');
    Route::get('/vue/gym/{gym_id}/fil-actu', 'Vue\GymVueController@vueFilActu')->name('vueFilActuGym');
    Route::get('/vue/gym/{gym_id}/cross-list', 'Vue\GymVueController@vueGymCrossList')->name('vueGymCrossList');

    // Guide book views
    Route::get('/vue/topo/{topo_id}/fil-actu','Vue\TopoVueController@vueFilActu')->name('vueFilActuTopo');
    Route::get('/vue/topo/{topo_id}/liens','Vue\TopoVueController@vueLiens')->name('vueLiensTopo');
    Route::get('/vue/topo/{topo_id}/sites','Vue\TopoVueController@vueSites')->name('vueSitesTopo');
    Route::get('/vue/topo/{topo_id}/acheter','Vue\TopoVueController@vueAcheter')->name('vueAcheterTopo');
    Route::get('/vue/topo/{topo_id}/map','Vue\TopoVueController@vueMap')->name('vueMapTopo');
    Route::get('/vue/topo/{topo_id}/photo','Vue\TopoVueController@vuePhoto')->name('vuePhotosTopo');

    // Massive views
    Route::get('/vue/massive/{massive_id}/fil-actu','Vue\MassiveVueController@vueFilActu')->name('vueFilActuMassive');
    Route::get('/vue/massive/{massive_id}/liens','Vue\MassiveVueController@vueLiens')->name('vueLiensMassive');
    Route::get('/vue/massive/{massive_id}/sites','Vue\MassiveVueController@vueSites')->name('vueSitesMassive');

    // Gallery
    Route::get('/gallery/photo/{photo_id}', 'GalleryController@galleryPage')->name('gallery');
});

// Admin interface
Route::group(['middleware' => [ 'auth', 'adminLevel' ]], function() {

    // Home
    Route::get('/admin/home', 'AdminController@homePage')->name('admin_home');

    // Climbing gym
    Route::get('/admin/upload-sae', 'AdminController@uploadSaePage')->name('admin_sae_upload');
    Route::get('/admin/add-admin', 'AdminController@addGymAdminPage')->name('add_gym_admin');
    Route::post('/admin/upload', 'CRUD\GymController@uploadLogoBandeau')->name('uploadLogoBandeauSae');
    Route::post('/admin/admin/add', 'CRUD\GymAdministratorController@addAdministrator')->name('addGymAdmin');

    // Route
    Route::get('/admin/route-information', 'AdminController@routeInformationPage')->name('admin_route_information');
    Route::get('/get/route/{route_id}/information', 'AdminController@getRouteInformation');
    Route::get('/delete/route/{route_id}', 'AdminCRUD\RouteCRUDController@deleteRoute')->name('delete_route');

    // Article
    Route::get('/admin/article/upload-page', 'AdminController@uploadArticleBandeauPage')->name('uploadBandeauArticlePage');
    Route::get('/admin/article/create', 'AdminController@createArticlePage')->name('createArticlePage');
    Route::get('/admin/article/update', 'AdminController@updateArticlePage')->name('updateArticlePage');
    Route::get('/get/article/{article_id}/information', 'AdminController@getArticleInformation');
    Route::post('/admin/article/upload', 'CRUD\ArticleController@uploadBandeauArticle')->name('uploadBandeauArticle');
    Route::resource('articles', 'CRUD\ArticleController');

    // Newsletter
    Route::get('/admin/newsletter/create', 'AdminController@createNewsletterPage')->name('createNewsletterPage');
    Route::get('/admin/newsletter/update', 'AdminController@updateNewsletterPage')->name('updateNewsletterPage');
    Route::get('/get/newsletter/{newsletter_ref}/information', 'AdminController@getNewsletterInformation');
    Route::resource('newsletters', 'CRUD\NewsletterController');
    Route::get('/admin/send/news-letter/{ref}', 'NewsletterController@sendNewsletter')->name('sendNewsletter');

    // Helps
    Route::resource('helps', 'CRUD\HelpController');
    Route::get('/admin/aide/create', 'AdminController@createHelpPage')->name('createHelpPage');
    Route::get('/admin/aide/update', 'AdminController@updateHelpPage')->name('updateHelpPage');
    Route::get('/admin/aide/delete', 'AdminController@deleteHelpPage')->name('deleteHelpPage');
    Route::get('/get/aide/{help_id}/information', 'AdminController@getHelpInformation');

    // Exception
    Route::resource('exceptions', 'CRUD\ExceptionController');
    Route::get('/admin/exception/create', 'AdminController@createExceptionPage')->name('createExceptionPage');
    Route::get('/admin/exception/update', 'AdminController@updateExceptionPage')->name('updateExceptionPage');
    Route::get('/admin/exception/delete', 'AdminController@deleteExceptionPage')->name('deleteExceptionPage');
    Route::get('/get/exception/{exception_id}/information', 'AdminController@getExceptionInformation');

    // Sector
    Route::get('/admin/sector-information', 'AdminController@sectorInformationPage')->name('admin_sector_information');
    Route::get('/get/sector/{sector_id}/information', 'AdminController@getSectorInformation');
    Route::get('/delete/sector/{sector_id}', 'AdminCRUD\SectorCRUDController@deleteSector')->name('delete_sector');
});

// Admin gyms
Route::group(['middleware' => [ 'auth', 'gymAdministrator' ]], function() {

    Route::get('/admin-indoor/{gym_id}/{gym_label}', 'GymAdminController@layoutPage')->name('gym_admin_home');

    // Admin interface : Dashboard
    Route::get('/admin/{gym_id}/view/dashboard', 'GymAdminController@dashboardView')->name('gym_admin_dashboard_view');

    // Admin interface : Actuality
    Route::get('/admin/{gym_id}/view/flux', 'GymAdminController@gymFluxView')->name('gym_admin_flux_view');

    // Admin interface : Logo and bandeau
    Route::get('/admin/{gym_id}/view/upload-logo-bandeau', 'GymAdminController@uploadLogoBandeauView')->name('gym_admin_logo_bandeau_upload_view');
    Route::post('/gym-admin/{gym_id}/upload-logo', 'CRUD\GymAdministratorController@uploadLogo')->name('gym_admin_upload_logo');
    Route::post('/gym-admin/{gym_id}/upload-bandeau', 'CRUD\GymAdministratorController@uploadBandeau')->name('gym_admin_upload_bandeau');

    // Admin interface : Community
    Route::get('/admin/{gym_id}/view/community', 'GymAdminController@gymCommunityView')->name('gym_admin_community_view');

    // Admin interface : Statistic
    Route::get('/admin/{gym_id}/view/statistique', 'GymAdminController@gymStatisticView')->name('gym_admin_statistic_view');

    // Admin interface : Gestion
    Route::get('/admin/{gym_id}/view/team', 'GymAdminController@gymTeamView')->name('gym_admin_team_view');
    Route::get('/admin/{gym_id}/view/settings', 'GymAdminController@gymSettingsView')->name('gym_admin_settings_view');

    // Admin interface : Schemes
    Route::get('/admin/{gym_id}/view/topo/comment-ca-marche', 'GymAdminController@howSchemeView')->name('gym_admin_scheme_how');
    Route::get('/admin/{gym_id}/view/topo/salles', 'GymAdminController@gymSchemesView')->name('gym_admin_schemes_gym');
    Route::get('/admin/{gym_id}/view/topo/lignes', 'GymAdminController@gymRoutesView')->name('gym_admin_routes_view');

    // View : Grades & Grade lines
    Route::get('/admin/{gym_id}/view/grades', 'GymAdminController@gymGradesView')->name('gym_admin_grades_gym');
    Route::get('/admin/{gym_id}/view/grade-lines/{gym_grade_id}', 'GymAdminController@gymGradeLinesView')->name('gym_admin_grade_lines_gym');

    // Modal : Grades & Grade lines
    Route::post('/modal/gym-grade/{gym_id}/gym-grade-modal', 'CRUD\GymGradeController@gymGradeModal')->name('gymGradeModal');
    Route::post('/modal/gym-grade-line/{gym_id}/gym-grade-line-modal', 'CRUD\GymGradeLineController@gymGradeLineModal')->name('gymGradeLineModal');

    // Modal : room
    Route::post('/modal/room/{gym_id}', 'CRUD\RoomController@roomModal')->name('roomModal');
    Route::post('/modal/room/{gym_id}/upload-scheme-modal', 'CRUD\RoomController@uploadSchemeModal')->name('roomUploadSchemeModal');
    Route::post('/modal/room/{gym_id}/upload-scheme', 'CRUD\RoomController@uploadScheme')->name('roomUploadScheme');
    Route::post('/modal/room/{gym_id}/room/{room_id}/custom-scheme', 'CRUD\RoomController@customScheme')->name('roomCustomScheme');
    Route::post('/modal/room/{gym_id}/room/{room_id}/publish', 'CRUD\RoomController@publishModal')->name('roomPublishModal');

    // Modal : room : crop thumbnail
    Route::post('/modal/room/{gym_id}/route/{route_id}/crop', 'CRUD\GymRouteController@cropGymRouteModal')->name('cropGymRouteModal');
    Route::post('/gym/{gym_id}/route/{route_id}/upload-crop-thumbnail', 'CRUD\GymRouteController@uploadCropThumbnail')->name('uploadCropThumbnail');

    Route::post('/modal/room/{gym_id}/sector/{sector_id}/upload-sector-picture-modal', 'CRUD\GymSectorController@uploadSectorPictureModal')->name('sectorUploadSchemeModal');
    Route::post('/modal/room/{gym_id}/sector/{sector_id}/upload-sector-picture', 'CRUD\GymSectorController@uploadSectorPicture')->name('sectorUploadScheme');

    Route::post('/modal/room/{gym_id}/route/{route_id}/upload-route-thumbnail-modal', 'CRUD\GymRouteController@uploadRouteThumbnailModal')->name('routeUploadThumbnailModal');
    Route::post('/modal/room/{gym_id}/route/{route_id}/upload-route-thumbnail', 'CRUD\GymRouteController@uploadRouteThumbnail')->name('routeUploadThumbnail');

    Route::post('/modal/room/{gym_id}/route/{route_id}/upload-route-picture-modal', 'CRUD\GymRouteController@uploadRoutePictureModal')->name('routeUploadSchemeModal');
    Route::post('/modal/room/{gym_id}/route/{route_id}/upload-route-picture', 'CRUD\GymRouteController@uploadRoutePicture')->name('routeUploadScheme');

    Route::post('/modal/gym-sectors/{gym_id}', 'CRUD\GymSectorController@gymSectorModal')->name('gymSectorModal');
    Route::post('/modal/gym-routes/{gym_id}', 'CRUD\GymRouteController@gymRouteModal')->name('gymRouteModal');

    // Save and Delete area or line on scheme map
    Route::put('/admin/{gym_id}/sector/{sector_id}/save-area', 'CRUD\GymSectorController@saveSchemeArea');
    Route::put('/admin/{gym_id}/route/{route_id}/save-line', 'CRUD\GymRouteController@saveSchemeLine');
    Route::put('/admin/{gym_id}/sector/{sector_id}/delete-area', 'CRUD\GymSectorController@deleteSchemeArea');
    Route::put('/admin/{gym_id}/route/{route_id}/delete-line', 'CRUD\GymRouteController@deleteSchemeLine');

    Route::put('/admin/{gym_id}/room/{room_id}/save-custom-scheme', 'CRUD\RoomController@saveCustomScheme')->name('saveCustomScheme');
    Route::put('/admin/{gym_id}/room/{room_id}/publish', 'CRUD\RoomController@publishRoom')->name('publishRoom');

    Route::get('/admin/{gym_id}/room/last-created', 'GymSchemeController@getLastCreatedRoomRoute')->name('getLastCreatedRoomRoute');
    Route::get('/admin/{gym_id}/room/first-order', 'GymSchemeController@getFirstOrderRoomRoute')->name('getFirstOrderRoomRoute');

    Route::post('/modal/gym-administrator/{gym_id}', 'CRUD\GymAdministratorController@gymAddAdministratorModal')->name('gymAddAdministratorModal');
    Route::post('/admin/administrator/add/{gym_id}/{user_id}', 'CRUD\GymAdministratorController@addAdministrator');
});

// Admin climbing gym, resource views
Route::resource('rooms', 'CRUD\RoomController');
Route::resource('gym_sectors', 'CRUD\GymSectorController');
Route::resource('gym_administrators', 'CRUD\GymAdministratorController');
Route::resource('gym_routes', 'CRUD\GymRouteController');
Route::resource('gym_grades', 'CRUD\GymGradeController');
Route::resource('gym_grade_lines', 'CRUD\GymGradeLineController');
Route::get('/API/users/by-name/{gym_id}/{name}', 'CRUD\GymAdministratorController@gymSearchAdministrator');
Route::put('/gym/dismount-route/{route_id}', 'CRUD\GymRouteController@dismountRoute')->name('gymDismountRoute');
Route::put('/gym/favorite-route/{route_id}', 'CRUD\GymRouteController@favoriteRoute')->name('gymFavoriteRoute');
Route::delete('/gym/route/{route_id}/photo-delete', 'CRUD\GymRouteController@deletePhoto');
Route::delete('/gym/sector/{sector_id}/photo-delete', 'CRUD\GymSectorController@deletePhoto');

// Iframe
Route::get('/iframe/crag/{crag_id}','IframeController@cragIframe')->name('cragIframe');

// Site map : general
Route::get('/sitemap.xml','SitemapController@sitemapIndex')->name('sitemap');
Route::get('/sitemap/common.xml','SitemapController@sitemapCommon')->name('sitemapCommon');
Route::get('/sitemap/climbers.xml','SitemapController@sitemapClimbers')->name('sitemapClimbers');
Route::get('/sitemap/topos.xml','SitemapController@sitemapTopos')->name('sitemapTopos');
Route::get('/sitemap/gyms.xml','SitemapController@sitemapGyms')->name('sitemapGyms');
Route::get('/sitemap/topics.xml','SitemapController@sitemapTopics')->name('sitemapTopics');

// Site map : crag and route
Route::get('/sitemap-crags.xml','SitemapController@sitemapCrags')->name('sitemapCrags');
Route::get('/sitemap/{crag_id}/crag-routes.xml','SitemapController@sitemapCragRoutes')->name('sitemapCragRoutes');

// News feed
Route::post('/post/getVue', 'PostController@postsVue')->name('postsVue');
Route::post('/post/getOne', 'PostController@getOnePost')->name('getOnePost');
Route::post('/user/actuality', 'PostController@userActuality')->name('userActuality');
Route::post('/post/upload', 'CRUD\PostController@uploadPostImage')->name('uploadPostImage');
Route::post('/post/vueOnePost', 'PostController@vueOnePost')->name('vueOnePost');
Route::post('/like/add', 'LikeController@addLike')->name('addLike');

// Messenger views
Route::post('/messagerie/conversations', 'Vue\UserVueController@vueConversations')->name('vueConversations');
Route::post('/messagerie/messages', 'Vue\UserVueController@vueMessages')->name('vueMessages');
Route::get('/messagerie/userSearch/{conversation_id}/{search}', 'CRUD\UserConversationController@userSearch')->name('userSearchConversation');
Route::post('/messagerie/addUser', 'CRUD\UserConversationController@addUser')->name('addUserConversation');
Route::post('/messagerie/newInConversation', 'CRUD\UserConversationController@newInConversation')->name('newInConversation');
Route::post('/message/new', 'CRUD\UserConversationController@newMessage')->name('newMessage');

// Notifications
Route::post('/new/notifications-and-messages', 'UserController@getNewNotificationAndMessage')->name('getNewNotificationAndMessage');
Route::post('/notification/read', 'CRUD\NotificationController@notificationAsRead')->name('notificationAsRead');

// Outdoor API (TODO : transfer to API)
Route::get('/API/crags/{lat}/{lng}/{rayon}', 'MapController@getPopupMarkerAroundPoint')->name('APIMarkerMap');
Route::get('/API/topo/crags/{topo_id}/', 'MapController@getPopupMarkerCragsTopo')->name('APICragsTopoMap');
Route::get('/API/massive/crags/{massive_id}/', 'MapController@getPopupMarkerCragsMassive')->name('APICragsMassiveMap');
Route::get('/API/topo/sales/{topo_id}/', 'MapController@getPopupMarkerSalesTopo')->name('APISalesTopoMap');
Route::get('/API/crags/search', 'MapController@filterMap')->name('filterMap');
Route::get('/API/route_grades', 'RouteController@routeGrades')->name('routeGrades');

// Indoor API
Route::get('/API/gyms/get-sectors/{room_id}', 'GymSchemeController@getGymSectors')->name('APIGetGymSectors');
Route::get('/API/gyms/get-routes/{room_id}', 'GymSchemeController@getGymRoutes')->name('APIGetGymRoutes');

// Partner
Route::post('/user/save-birth', 'CRUD\UserController@saveBirth')->name('saveUserBirth');

// Guidebook
Route::get('/API/topos/by-name/{crag_id}/{name}', 'TopoController@getToposByName')->name('APIToposByName');
Route::get('/API/topos/{lat}/{lng}/{rayon}/{crag_id}', 'TopoController@getToposArroundPoint')->name('APIToposArroundPoint');
Route::post('/topo/create-liaison', 'CRUD\TopoCragController@createLiaison')->name('ScriptCreateLiaison');
Route::post('/topo/delete-liaison', 'CRUD\TopoCragController@deleteLiaison')->name('ScriptDeleteLiaison');

// Massive
Route::get('/API/massives/{lat}/{lng}/{rayon}/{crag_id}', 'MassiveController@getMassivesArroundPoint')->name('APIMassivesArroundPoint');
Route::post('/massive/create-liaison', 'CRUD\MassiveCragController@createLiaison')->name('ScriptCreateLiaison');
Route::post('/massive/delete-liaison', 'CRUD\MassiveCragController@deleteLiaison')->name('ScriptDeleteLiaison');

// Article API
Route::get('/api/article/crags/{article_id}','ArticleController@getArticleCrags')->name('ApiArticleCrags');

// Upload
Route::post('/upload/topoCouverture', 'CRUD\TopoController@uploadCouvertureTopo')->name('uploadCouvertureTopo');

// Modal
Route::post('/modal/crag', 'CRUD\CragController@cragModal')->name('cragModal');
Route::post('/modal/gym', 'CRUD\GymController@gymModal')->name('gymModal');
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
Route::post('/modal/indoor-cross', 'CRUD\IndoorCrossController@indoorCrossModal')->name('indoorCrossModal');
Route::post('/modal/crossUser', 'CRUD\CrossController@crossUserModal')->name('crossUserModal');
Route::post('/modal/userPlace', 'CRUD\PartnerController@partnerModal')->name('partnerModal');
Route::post('/modal/approach', 'CRUD\ApproachController@approachModal')->name('approachModal');
Route::post('/modal/tag', 'CRUD\TagController@tagModal')->name('tagModal');
Route::post('/modal/share-crag', 'CRUD\ShareCragController@shareModal')->name('shareCragModal');
Route::post('/modal/version', 'VersionController@versionModal')->name('versionModal');
Route::post('/modal/gym-manager', 'CRUD\GymController@managerModal')->name('managerModal');

// Ajax CRUD
Route::resource('descriptions', 'CRUD\DescriptionController');
Route::resource('comments', 'CRUD\CommentController');
Route::resource('links', 'CRUD\LinkController');
Route::resource('crags', 'CRUD\CragController');
Route::resource('gyms', 'CRUD\GymController');
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
Route::resource('indoor_crosses', 'CRUD\IndoorCrossController');
Route::post('/cross/users', 'CRUD\CrossController@crossUsers')->name('crossUsersScript');
Route::resource('partners', 'CRUD\PartnerController');
Route::resource('approaches', 'CRUD\ApproachController');
Route::resource('tags', 'CRUD\TagController');

// User CRUD
Route::post('/user/settings/save', 'CRUD\UserController@saveSettings')->name('saveUserSettings');
Route::post('/user/settings/messagerie', 'CRUD\UserController@saveUserMessagerieSettings')->name('saveUserMessagerieSettings');
Route::post('/user/settings/confidentialite', 'CRUD\UserController@saveUserConfidentialiteSettings')->name('saveUserConfidentialiteSettings');
Route::post('/user/settings/mail-password', 'CRUD\UserController@saveMailPassword')->name('saveMailPassword');
Route::post('/user/settings/filter', 'CRUD\UserController@saveFilterSettings')->name('saveFilterSettings');
Route::post('/upload/userBandeau', 'CRUD\UserController@uploadBandeau')->name('uploadBandeau');
Route::post('/upload/userPhotoProfile', 'CRUD\UserController@uploadPhotoProfile')->name('uploadPhotoProfile');

// Follow
Route::post('/follow/delete', 'CRUD\FollowController@deleteFollow')->name('deleteFollow');
Route::post('/user/relation', 'CRUD\FollowController@userRelation')->name('userRelation');

// Tick list
Route::post('/tick-list/delete', 'CRUD\TickListController@deleteTickList')->name('deleteTickList');
Route::post('/tick-list/add', 'CRUD\TickListController@addTickList')->name('addTickList');

// Partner CRUD
Route::post('/partner/active', 'CRUD\PartnerController@activePartner')->name('activePartnerScript');
Route::post('/partner/place/active', 'CRUD\PartnerController@activePlace')->name('activePlaceScript');
Route::post('/partner/setting-map', 'CRUD\PartnerController@mapPlaces')->name('mapPlacesScript');
Route::post('/partner/save-settings', 'CRUD\PartnerController@saveSettings')->name('saveUserPartnerSettings');
Route::post('/partner/getPartnerPoints', 'PartnerController@getPartnerPoints')->name('getPartnerPoints');
Route::post('/partner/getUserInformation', 'PartnerController@getUserInformation')->name('getUserInformation');
Route::post('/partner/getMyPlaces', 'PartnerController@getMyPlaces')->name('getMyPlaces');

// Problem
Route::post('/send/problem', 'CRUD\ProblemController@sendProblem')->name('sendProblem');

// Header
Route::post('/bandeau/define', 'CRUD\CragController@defineBandeau')->name('defineBandeau');

// Manager request
Route::post('/send/manager-request', 'CRUD\GymController@sendManagerRequest')->name('sendManagerRequest');

// Chart
Route::get('/chart/crag/{crag_id}/grade', 'Chart\CragChartController@gradeChart')->name('gradeCragChart');
Route::get('/chart/crag/{crag_id}/climb', 'Chart\CragChartController@climbChart')->name('climbCragChart');
Route::get('/chart/sector/{sector_id}/grade', 'Chart\SectorChartController@gradeChart')->name('gradeSectorChart');
Route::post('/chart/cross/climb-type', 'Chart\Crosses\UserCrossesTypeClimbController@climbChart')->name('climbUserCrossesChart');

// Chart - Analytiks
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

// -> tab : period
Route::post('/chart/analytiks/years', 'Chart\Crosses\timeChartsController@years')->name('yearsAnalytiksChart');
Route::post('/chart/analytiks/months', 'Chart\Crosses\timeChartsController@months')->name('monthsAnalytiksChart');
Route::post('/chart/analytiks/time-lines', 'Chart\Crosses\timeChartsController@timeLines')->name('timeLinesAnalytiksChart');

// Indoor Chart
Route::post('/chart/indoor/grades', 'Chart\IndoorChartController@grades')->name('indoorGradesChart');
Route::post('/chart/indoor/time', 'Chart\IndoorChartController@time')->name('indoorTimeChart');

// Similar
Route::post('/similar/route', 'RouteController@similarRoute')->name('similarRoute');

// Follow
Route::post('/follow/user','FollowController@getUserFollows')->name('followUser');
