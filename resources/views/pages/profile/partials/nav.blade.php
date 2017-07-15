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
    <li>
        <div id="item-dashboard-menu" data-route="{{route('vueDashboardUser',['user_id'=>$user->id])}}" class="collapsible-header truncate router-profile-link"><i class="material-icons">dashboard</i>Dashboard</div>
    </li>
    <li>
        <div data-route="{{route('vueFilActuUser',['user_id'=>$user->id])}}" class="collapsible-header truncate router-profile-link"><i class="material-icons">shuffle</i>Fil d'actualité</div>
    </li>
    <li>
        <div data-route="{{route('vueFollowUser',['user_id'=>$user->id])}}" class="collapsible-header truncate router-profile-link"><i class="material-icons">star</i>Mes suivis</div>
    </li>
    <li>
        <div class="collapsible-header truncate"><i class="material-icons">photo_camera</i>Médias</div>
        <div class="collapsible-body">
            <div data-route="{{route('vueAlbumsUser',['user_id'=>$user->id])}}" class="row truncate router-profile-link"><i class="left material-icons">photo_camera</i> Photos</div>
            <div data-route="{{route('vueVideosUser',['user_id'=>$user->id])}}" class="row truncate router-profile-link"><i class="left material-icons">videocam</i> Vidéos</div>
        </div>
    </li>
    <li>
        <div class="collapsible-header truncate"><i class="material-icons">playlist_add_check</i>Croix &amp; Ticklist</div>
        <div class="collapsible-body">
            <div data-route="{{route('vueCroixUser',['user_id'=>$user->id])}}" class="row truncate router-profile-link"><i class="left material-icons">done_all</i> Mes croix</div>
            <div data-route="{{route('vueTickListUser',['user_id'=>$user->id])}}" class="row truncate router-profile-link"><i class="left material-icons">reorder</i> Ticklist</div>
            <div data-route="{{route('vueProjetUser',['user_id'=>$user->id])}}" class="row truncate router-profile-link"><i class="left material-icons">crop_free</i> Projets</div>
            <div data-route="{{route('vueAnalytiksUser',['user_id'=>$user->id])}}" class="row truncate router-profile-link"><i class="left material-icons">equalizer</i> Analytiks</div>
        </div>
    </li>
    <li>
        <div data-route="{{route('vueMessagesUser',['user_id'=>$user->id])}}" class="collapsible-header truncate router-profile-link">
            <span id="badge-message-user-profile" class="badge red-text text-lighten-1"></span>
            <i class="material-icons">email</i>
            Messagerie
        </div>
    </li>
    <li>
        <div class="collapsible-header truncate"><i class="material-icons">people</i>Recherche de partenaire</div>
        <div class="collapsible-body">
            <div data-route="{{route('vueLieuxUser',['user_id'=>$user->id])}}" class="row truncate router-profile-link"><i class="left material-icons">place</i>Mes Lieux</div>
            <div data-route="{{route('vuePartenaireParametresUser',['user_id'=>$user->id])}}" class="row truncate router-profile-link"><i class="left material-icons">accessibility</i>Qui je suis</div>
        </div>
    </li>
    <li>
        <div data-route="{{route('vueNotificationsUser',['user_id'=>$user->id])}}" class="collapsible-header truncate router-profile-link"><i class="material-icons">notifications</i>Notifications</div>
    </li>
    <li>
        <div data-route="{{route('vueEditSettingsUser',['user_id'=>$user->id])}}" class="collapsible-header truncate router-profile-link"><i class="material-icons">settings</i>Paramètres</div>
    </li>
</ul>
