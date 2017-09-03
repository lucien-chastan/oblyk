@inject('Helpers','App\Lib\HelpersTemplates')

<div class="flexDashBoxs" id="flexDashBoxs">

    {{--BOX : BIENVENUE--}}
    @if($user->settings->dash_welcome)
        @include('pages.profile.vues.dashboardBox.box',['routeTitle'=>trans('pages/profile/dashbox/titleBox.welcome'),'routeBox'=>route('subVueWelcomeUser', ['user_id'=>$user->id])])
    @endif

    {{--BOX : LES CROIX DES POTES--}}
    @if($user->settings->dash_friend_cross)
        @include('pages.profile.vues.dashboardBox.box',['routeTitle'=>trans('pages/profile/dashbox/titleBox.friendsCrosses'),'routeBox'=>route('subVueCroixPoteUser', ['user_id'=>$user->id])])
    @endif

    {{--BOX : LES DERNIÈRES PHOTOS--}}
    @if($user->settings->dash_photos)
        @include('pages.profile.vues.dashboardBox.box',['routeTitle'=>trans('pages/profile/dashbox/titleBox.lastPhoto'),'routeBox'=>route('subVuephotosLastUser', ['user_id'=>$user->id])])
    @endif

    {{--BOX : MES CROIX--}}
    @if($user->settings->dash_my_cross)
        @include('pages.profile.vues.dashboardBox.box',['routeTitle'=>trans('pages/profile/dashbox/titleBox.myCrosses'),'routeBox'=>route('subVueMesCroixUser', ['user_id'=>$user->id])])
    @endif

    {{--BOX : LES DERNIRERS POSTES SUR LE FORUM--}}
    @if($user->settings->dash_forum)
        @include('pages.profile.vues.dashboardBox.box',['routeTitle'=>trans('pages/profile/dashbox/titleBox.lastTopic'),'routeBox'=>route('subVueForumLastUser', ['user_id'=>$user->id])])
    @endif

    {{--BOX : LES NEWS D'OBLYK--}}
    @if($user->settings->dash_oblyk_news)
        @include('pages.profile.vues.dashboardBox.box',['routeTitle'=>trans('pages/profile/dashbox/titleBox.news'),'routeBox'=>route('subVueNewsOblykUser', ['user_id'=>$user->id])])
    @endif

    {{--BOX : LES DERNIÈRES VIDEOS--}}
    @if($user->settings->dash_videos)
        @include('pages.profile.vues.dashboardBox.box',['routeTitle'=>trans('pages/profile/dashbox/titleBox.lastVideo'),'routeBox'=>route('subVueVideosLastUser', ['user_id'=>$user->id])])
    @endif

    {{--BOX : LES DERNIÈRES FALAISES--}}
    @if($user->settings->dash_crags)
        @include('pages.profile.vues.dashboardBox.box',['routeTitle'=>trans('pages/profile/dashbox/titleBox.lastCrag'),'routeBox'=>route('subVueCragsLastUser', ['user_id'=>$user->id])])
    @endif

    {{--BOX : LES DERNIERS COMMENTAIRES--}}
    @if($user->settings->dash_comments)
        @include('pages.profile.vues.dashboardBox.box',['routeTitle'=>trans('pages/profile/dashbox/titleBox.lastComment'),'routeBox'=>route('subVueCommentsLastUser', ['user_id'=>$user->id])])
    @endif

    {{--BOX : LES DERNIÈRES LIGNES--}}
    @if($user->settings->dash_routes)
        @include('pages.profile.vues.dashboardBox.box',['routeTitle'=>trans('pages/profile/dashbox/titleBox.lastRoute'),'routeBox'=>route('subVueRoutesLastUser', ['user_id'=>$user->id])])
    @endif

    {{--BOX : LES DERNIERS TOPOS--}}
    @if($user->settings->dash_topos)
        @include('pages.profile.vues.dashboardBox.box',['routeTitle'=>trans('pages/profile/dashbox/titleBox.lastGuidebook'),'routeBox'=>route('subVueToposLastUser', ['user_id'=>$user->id])])
    @endif

    {{--BOX : LES DERNIERS GRIMPEURS--}}
    @if($user->settings->dash_users)
        @include('pages.profile.vues.dashboardBox.box',['routeTitle'=>trans('pages/profile/dashbox/titleBox.lastUser'),'routeBox'=>route('subVueUsersLastUser', ['user_id'=>$user->id])])
    @endif

    {{--BOX : LES SAE--}}
    @if($user->settings->dash_sae)
        @include('pages.profile.vues.dashboardBox.box',['routeTitle'=>trans('pages/profile/dashbox/titleBox.lastGym'),'routeBox'=>route('subVueSaeLastUser', ['user_id'=>$user->id])])
    @endif

    {{--BOX : LISTE DES FALAISES ET SAE--}}
    @if($user->settings->dash_list_crag_sae)
        @include('pages.profile.vues.dashboardBox.box',['routeTitle'=>trans('pages/profile/dashbox/titleBox.treeCragAndGym'),'routeBox'=>route('subVueListCragSaeUser', ['user_id'=>$user->id])])
    @endif

    {{--BOX : RECHERCHE DE PARTENAIRE--}}
    @if($user->settings->dash_partenaire)
        @include('pages.profile.vues.dashboardBox.box',['routeTitle'=>trans('pages/profile/dashbox/titleBox.partner'),'routeBox'=>route('subVuePartenaireUser', ['user_id'=>$user->id])])
    @endif

    {{--BOX : UN MOT AU HASARD--}}
    @if($user->settings->dash_random_word)
        @include('pages.profile.vues.dashboardBox.box',['routeTitle'=>trans('pages/profile/dashbox/titleBox.randomWord'),'routeBox'=>route('subVueRandomWordUser', ['user_id'=>$user->id])])
    @endif

    {{--BOX : MES CONTRIBUTIONS --}}
    @if($user->settings->dash_contribution)
        @include('pages.profile.vues.dashboardBox.box',['routeTitle'=>trans('pages/profile/dashbox/titleBox.contribution'),'routeBox'=>route('subVueContributionUser', ['user_id'=>$user->id])])
    @endif

</div>