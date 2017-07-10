<div class="user-bandeau">
    <div class="left-col">
        <img src="/storage/users/user-1.jpg" class="circle img-nav-user z-depth-3">
    </div>
    <div class="right-col">
        <p>{{$user->name}}</p>
        <p>Homme, 27 ans</p>
    </div>
</div>


<ul class="collapsible" data-collapsible="accordion">
    <li>
        <div class="collapsible-header"><i class="material-icons">dashboard</i>Dashboard</div>
    </li>
    <li>
        <div class="collapsible-header"><i class="material-icons">shuffle</i>Fil d'actualité</div>
    </li>
    <li>
        <div class="collapsible-header"><i class="material-icons">place</i>Médias</div>
        <div class="collapsible-body">
            <div class="row"><i class="left material-icons">photo_camera</i> Photos</div>
            <div class="row"><i class="left material-icons">videocam</i> Vidéos</div>
        </div>
    </li>
    <li>
        <div class="collapsible-header"><i class="material-icons">playlist_add_check</i>Croix &amp; Ticklist</div>
        <div class="collapsible-body">
            <div class="row"><i class="left material-icons">done_all</i> Mes croix</div>
            <div class="row"><i class="left material-icons">reorder</i> Ticklist</div>
            <div class="row"><i class="left material-icons">crop_free</i> Projet</div>
            <div class="row"><i class="left material-icons">equalizer</i> Analytiks</div>
        </div>
    </li>
    <li>
        <div class="collapsible-header"><i class="material-icons">email</i>Messagerie</div>
    </li>
    <li>
        <div class="collapsible-header"><i class="material-icons">notifications</i>Notification</div>
    </li>
    <li>
        <div class="collapsible-header"><i class="material-icons">settings</i>Paramètre</div>
        <div class="collapsible-body">
            <div class="row"><i class="left material-icons">edit</i> Modifier mon profil</div>
            <div class="row"><i class="left material-icons">delete</i> Supprimer mon profil</div>
            <div class="row"><i class="left material-icons">flag</i> Signaler un problème</div>
        </div>
    </li>
</ul>
