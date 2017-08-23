<div class="row">

    @if($somme != 0)

        {{--NOMBRE DE SITE DE GRIMPE--}}
        <div class="col s12 l6">
            <p class="truncate"><i class="material-icons left">terrain</i> <span class="blue-text">+ {{ $user->crags_count }}</span> sites de grimpe</p>
        </div>

        {{--NOMBRE DE LIGNES--}}
        <div class="col s12 l6">
            <p class="truncate"><i class="material-icons left">timeline</i> <span class="blue-text">+ {{ $user->routes_count }}</span> lignes</p>
        </div>

        {{--NOMBRE DE COMMENTAIRE--}}
        <div class="col s12 l6">
            <p class="truncate"><i class="material-icons left">comment</i> <span class="blue-text">+ {{ $user->descriptions_count }}</span> commentaires</p>
        </div>

        {{--NOMBRE DE PHOTOS--}}
        <div class="col s12 l6">
            <p class="truncate"><i class="material-icons left">photo_camera</i> <span class="blue-text">+ {{ $user->photos_count }}</span> photos</p>
        </div>

        {{--NOMBRE DE VIDÉOS--}}
        <div class="col s12 l6">
            <p class="truncate"><i class="material-icons left">videocam</i> <span class="blue-text">+ {{ $user->videos_count }}</span> vidéos</p>
        </div>

        {{--NOMBRE DE TOPO (PAPIER, WEB, PDF--}}
        <div class="col s12 l6">
            <p class="truncate"><i class="material-icons left">photo_album</i> <span class="blue-text">+ {{ $user->topos_count + $user->topoWebs_count + $user->topoPdfs_count }}</span> topos</p>
        </div>


        {{--NOMBRE DE SALLE DE GRIMPE--}}
        <div class="col s12 l6">
            <p class="truncate"><i class="material-icons left">home</i> <span class="blue-text">+ {{ $user->gyms_count }}</span> salle de grimpe</p>
        </div>

        {{--NOMBRE D'ACTU--}}
        <div class="col s12 l6">
            <p class="truncate"><i class="material-icons left">forum</i> <span class="blue-text">+ {{ $user->posts_count }}</span> actus postées</p>
        </div>

    @else

        <p class="grey-text text-center">Vous n'avez pas encore contribué à oblyk</p>

    @endif


</div>