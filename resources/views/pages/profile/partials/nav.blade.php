<div class="user-bandeau grey darken-1" style="background-image: url('{{$user->bandeau}}')">
    <div class="left-col">
        <img src="{{$user->image}}" alt="phoot de profil de {{$user->name}} " class="circle img-nav-user z-depth-3">
    </div>
    <div class="right-col">
        <p class="truncate">{{$user->name}}</p>
        <p class="truncate">{{$user->genre}}, {{$user->age}} ans</p>
    </div>
</div>


{{--MENU DE LA PERSONNE CONNECTÉ À SON PROFIL--}}
@if($user->id == Auth::id())
    <ul class="collapsible" data-collapsible="accordion">

        {{--DASHBOARD--}}
        <li>
            <div id="item-dashboard-menu" data-route="{{route('vueDashboardUser',['user_id'=>$user->id])}}" class="collapsible-header truncate router-profile-link">
                <i class="material-icons">dashboard</i>
                <span class="hidden-1000">Dashboard</span>
            </div>
        </li>

        {{--FIL D'ACTUALITÉ--}}
        <li>
            <div id="item-fil-actu-menu" data-route="{{route('vueFilActuUser',['user_id'=>$user->id])}}" class="collapsible-header truncate router-profile-link">
                <span id="badge-post-user-profile" class="badge red-text text-lighten-1 hidden-1000"></span>
                <i class="material-icons">shuffle</i>
                <span class="hidden-1000">
                    Fil d'actualité <img title="actualiser la vue" onclick="reloadCurrentVue()" class="refresh-btn" src="/img/refresh.svg" alt="">
                </span>
            </div>
        </li>

        {{--LES AMIS--}}
        <li>
            <div id="item-friend-menu" data-route="{{route('vueFriendUser',['user_id'=>$user->id])}}" class="collapsible-header truncate router-profile-link">
                <i class="material-icons">people</i>
                <span class="hidden-1000">
                    Amis
                </span>
            </div>
        </li>

        {{--TOPOTHEQUE--}}
        <li>
            <div id="item-topotheque-menu" data-route="{{route('vueTopothequeUser',['user_id'=>$user->id])}}" class="collapsible-header truncate router-profile-link">
                <i class="material-icons">photo_album</i>
                <span class="hidden-1000">
                    Topothèque
                </span>
            </div>
        </li>

        {{--SUIVI--}}
        <li>
            <div id="item-follow-menu" data-route="{{route('vueFollowUser',['user_id'=>$user->id])}}" class="collapsible-header truncate router-profile-link">
                <i class="material-icons">star</i>
                <span class="hidden-1000">
                    Mes suivis
                </span>
            </div>
        </li>

        {{--MEDIAS (PHOTO + VIDEO)--}}
        <li>
            <div class="collapsible-header truncate">
                <i class="material-icons">photo_camera</i>
                <span class="hidden-1000">
                    Médias
                </span>
            </div>
            <div class="collapsible-body">
                <div data-route="{{route('vueAlbumsUser',['user_id'=>$user->id])}}" class="row truncate router-profile-link">
                    <i class="left material-icons">collections</i>
                    <span class="hidden-1000">
                        Photos
                    </span>
                </div>
                <div data-route="{{route('vueVideosUser',['user_id'=>$user->id])}}" class="row truncate router-profile-link">
                    <i class="left material-icons">videocam</i>
                    <span class="hidden-1000">
                        Vidéos
                    </span>
                </div>
            </div>
        </li>

        {{--CROIX (TICKLIST + PROJET + ANALYTIKS + LISTE CROIX)--}}
        <li>
            <div class="collapsible-header truncate">
                <i class="material-icons">playlist_add_check</i>
                <span class="hidden-1000">
                    Croix &amp; Ticklist
                </span>
            </div>
            <div class="collapsible-body">
                <div id="item-mes-croix-nav" data-route="{{route('vueCroixUser',['user_id'=>$user->id])}}" class="row truncate router-profile-link">
                    <i class="left material-icons">done_all</i>
                    <span class="hidden-1000">
                        Mes croix
                    </span>
                </div>
                <div id="item-ticklist-nav" data-route="{{route('vueTickListUser',['user_id'=>$user->id])}}" class="row truncate router-profile-link">
                    <i class="left material-icons">crop_free</i>
                    <span class="hidden-1000">
                        Ticklist
                    </span>
                </div>
                <div data-route="{{route('vueProjetUser',['user_id'=>$user->id])}}" class="row truncate router-profile-link">
                    <i class="left material-icons">crop_square</i>
                    <span class="hidden-1000">
                        Projets
                    </span>
                </div>
                <div id="item-analytiks-nav" data-route="{{route('vueAnalytiksUser',['user_id'=>$user->id])}}" class="row truncate router-profile-link">
                    <i class="left material-icons">equalizer</i>
                    <span class="hidden-1000">
                        Analytiks
                    </span>
                </div>
            </div>
        </li>

        {{--MESSAGERIE--}}
        <li>
            <div data-route="{{route('vueMessagesUser',['user_id'=>$user->id])}}" class="collapsible-header truncate router-profile-link">
                <span id="badge-message-user-profile" class="badge red-text text-lighten-1 hidden-1000"></span>
                <i class="material-icons">email</i>
                <span class="hidden-1000">
                    Messagerie <img title="actualiser la vue" onclick="reloadCurrentVue()" class="refresh-btn" src="/img/refresh.svg" alt="">
                </span>
            </div>
        </li>

        {{--RECHERCHE D'UN PARTENAIRE--}}
        <li>
            <div class="collapsible-header truncate">
                <i class="material-icons">person_pin</i>
                <span class="hidden-1000">
                    Recherche de partenaire
                </span>
            </div>
            <div class="collapsible-body">
                <div id="item-qui-je-suis-nav" data-route="{{route('vuePartenaireParametresUser',['user_id'=>$user->id])}}" class="row truncate router-profile-link">
                    <i class="left material-icons">accessibility</i>
                    <span class="hidden-1000">
                        Qui je suis
                    </span>
                </div>
                <div id="item-mes-lieux-nav" data-route="{{route('vueLieuxUser',['user_id'=>$user->id])}}" class="row truncate router-profile-link">
                    <i class="left material-icons">place</i>
                    <span class="hidden-1000">
                        Mes Lieux
                    </span>
                </div>
            </div>
        </li>

        {{--NOTIFICATIONS--}}
        <li>
            <div data-route="{{route('vueNotificationsUser',['user_id'=>$user->id])}}" class="collapsible-header truncate router-profile-link">
                <span id="badge-notification-user-profile" class="badge red-text text-lighten-1 hidden-1000"></span>
                <i class="material-icons">notifications</i>
                <span class="hidden-1000">
                    Notifications <img title="actualiser la vue" onclick="reloadCurrentVue()" class="refresh-btn" src="/img/refresh.svg" alt="">
                </span>
            </div>
        </li>

        {{--PARAMÈTRES--}}
        <li>
            <div id="item-parametre-nav" data-route="{{route('vueEditSettingsUser',['user_id'=>$user->id])}}" class="collapsible-header truncate router-profile-link">
                <i class="material-icons">settings</i>
                <span class="hidden-1000">
                    Paramètres
                </span>
            </div>
        </li>

    </ul>
@else



    {{--MENU PUBLIC--}}
    <ul class="collapsible" data-collapsible="accordion">

        {{--À PROPOS--}}
        <li>
            <div data-route="{{route('vueAProposUser',['user_id'=>$user->id])}}" class="collapsible-header truncate router-profile-link">
                <i class="material-icons">account_circle</i>
                <span class="hidden-1000">
                    À propos
                </span>
            </div>
        </li>

        {{--FIL D'ACTUALITÉ--}}
        <li>
            <div data-route="{{route('vueFilActuUser',['user_id'=>$user->id])}}" class="collapsible-header truncate router-profile-link">
                <i class="material-icons">shuffle</i>
                <span class="hidden-1000">
                    Fil d'actualité
                </span>
            </div>
        </li>

        {{--LES AMIS--}}
        <li>
            <div id="item-friend-menu" data-route="{{route('vueFriendUser',['user_id'=>$user->id])}}" class="collapsible-header truncate router-profile-link">
                <i class="material-icons">people</i>
                <span class="hidden-1000">
                    Amis
                </span>
            </div>
        </li>

        {{--TOPOTHEQUE--}}
        <li>
            <div data-route="{{route('vueTopothequeUser',['user_id'=>$user->id])}}" class="collapsible-header truncate router-profile-link">
                <i class="material-icons">photo_album</i>
                <span class="hidden-1000">
                    Topothèque
                </span>
            </div>
        </li>

        {{--MEDIAS (PHOTO + VIDEO)--}}
        <li>
            <div class="collapsible-header truncate">
                <i class="material-icons">photo_camera</i>
                <span class="hidden-1000">
                    Médias
                </span>
            </div>
            <div class="collapsible-body">
                <div data-route="{{route('vueAlbumsUser',['user_id'=>$user->id])}}" class="row truncate router-profile-link">
                    <i class="left material-icons">collections</i>
                    <span class="hidden-1000">
                        Photos
                    </span>
                </div>
                <div data-route="{{route('vueVideosUser',['user_id'=>$user->id])}}" class="row truncate router-profile-link">
                    <i class="left material-icons">videocam</i>
                    <span class="hidden-1000">
                        Vidéos
                    </span>
                </div>
            </div>
        </li>

        {{--CROIX (TICKLIST + PROJET + ANALYTIKS + LISTE CROIX)--}}
        <li>
            <div data-route="{{route('vueCroixUser',['user_id'=>$user->id])}}" class="collapsible-header truncate router-profile-link">
                <i class="material-icons">done_all</i>
                <span class="hidden-1000">
                    Croix
                </span>
            </div>
        </li>

    </ul>
@endif


