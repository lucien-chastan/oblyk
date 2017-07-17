<div class="user-bandeau grey darken-1" style="background-image: url('{{$user->bandeau}}')">
    <div class="left-col">
        <img src="{{$user->image}}" alt="phoot de profil de {{$user->name}} " class="circle img-nav-user z-depth-3">
    </div>
    <div class="right-col">
        <p class="truncate">{{$user->name}}</p>
        <p class="truncate">{{$user->genre}}, {{$user->age}} ans</p>
    </div>
</div>


<ul class="collapsible" data-collapsible="accordion">

    {{--DASHBOARD--}}
    <li>
        <div id="item-dashboard-menu" data-route="{{route('vueDashboardUser',['user_id'=>$user->id])}}" class="collapsible-header truncate router-profile-link"><i class="material-icons">dashboard</i>Dashboard</div>
    </li>

    {{--FIL D'ACTUALITÉ--}}
    <li>
        <div id="item-fil-actu-menu" data-route="{{route('vueFilActuUser',['user_id'=>$user->id])}}" class="collapsible-header truncate router-profile-link">
            <span id="badge-post-user-profile" class="badge red-text text-lighten-1"></span>
            <i class="material-icons">shuffle</i>
            Fil d'actualité <img title="actualiser la vue" onclick="reloadCurrentVue()" class="refresh-btn" src="/img/refresh.svg" alt="">
        </div>
    </li>

    {{--TOPOTHEQUE--}}
    <li>
        <div id="item-topotheque-menu" data-route="{{route('vueTopothequeUser',['user_id'=>$user->id])}}" class="collapsible-header truncate router-profile-link"><i class="material-icons">photo_album</i>Topothèque</div>
    </li>

    {{--SUIVI--}}
    <li>
        <div id="item-follow-menu" data-route="{{route('vueFollowUser',['user_id'=>$user->id])}}" class="collapsible-header truncate router-profile-link"><i class="material-icons">star</i>Mes suivis</div>
    </li>

    {{--MEDIAS (PHOTO + VIDEO)--}}
    <li>
        <div class="collapsible-header truncate"><i class="material-icons">photo_camera</i>Médias</div>
        <div class="collapsible-body">
            <div data-route="{{route('vueAlbumsUser',['user_id'=>$user->id])}}" class="row truncate router-profile-link"><i class="left material-icons">photo_camera</i> Photos</div>
            <div data-route="{{route('vueVideosUser',['user_id'=>$user->id])}}" class="row truncate router-profile-link"><i class="left material-icons">videocam</i> Vidéos</div>
        </div>
    </li>

    {{--CROIX (TICKLIST + PROJET + ANALYTIKS + LISTE CROIX)--}}
    <li>
        <div class="collapsible-header truncate"><i class="material-icons">playlist_add_check</i>Croix &amp; Ticklist</div>
        <div class="collapsible-body">
            <div data-route="{{route('vueCroixUser',['user_id'=>$user->id])}}" class="row truncate router-profile-link"><i class="left material-icons">done_all</i> Mes croix</div>
            <div data-route="{{route('vueTickListUser',['user_id'=>$user->id])}}" class="row truncate router-profile-link"><i class="left material-icons">reorder</i> Ticklist</div>
            <div data-route="{{route('vueProjetUser',['user_id'=>$user->id])}}" class="row truncate router-profile-link"><i class="left material-icons">crop_free</i> Projets</div>
            <div data-route="{{route('vueAnalytiksUser',['user_id'=>$user->id])}}" class="row truncate router-profile-link"><i class="left material-icons">equalizer</i> Analytiks</div>
        </div>
    </li>

    {{--MESSAGERIE--}}
    <li>
        <div data-route="{{route('vueMessagesUser',['user_id'=>$user->id])}}" class="collapsible-header truncate router-profile-link">
            <span id="badge-message-user-profile" class="badge red-text text-lighten-1"></span>
            <i class="material-icons">email</i>
            Messagerie <img title="actualiser la vue" onclick="reloadCurrentVue()" class="refresh-btn" src="/img/refresh.svg" alt="">
        </div>
    </li>

    {{--RECHERCHE D'UN PARTENAIRE--}}
    <li>
        <div class="collapsible-header truncate"><i class="material-icons">people</i>Recherche de partenaire</div>
        <div class="collapsible-body">
            <div data-route="{{route('vueLieuxUser',['user_id'=>$user->id])}}" class="row truncate router-profile-link"><i class="left material-icons">place</i>Mes Lieux</div>
            <div data-route="{{route('vuePartenaireParametresUser',['user_id'=>$user->id])}}" class="row truncate router-profile-link"><i class="left material-icons">accessibility</i>Qui je suis</div>
        </div>
    </li>

    {{--NOTIFICATIONS--}}
    <li>
        <div data-route="{{route('vueNotificationsUser',['user_id'=>$user->id])}}" class="collapsible-header truncate router-profile-link">
            <span id="badge-notification-user-profile" class="badge red-text text-lighten-1"></span>
            <i class="material-icons">notifications</i>
            Notifications <img title="actualiser la vue" onclick="reloadCurrentVue()" class="refresh-btn" src="/img/refresh.svg" alt="">
        </div>
    </li>

    {{--PARAMÈTRES--}}
    <li>
        <div data-route="{{route('vueEditSettingsUser',['user_id'=>$user->id])}}" class="collapsible-header truncate router-profile-link"><i class="material-icons">settings</i>Paramètres</div>
    </li>

</ul>
