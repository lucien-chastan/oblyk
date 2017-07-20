@inject('Helpers','App\Lib\HelpersTemplates')

<div class="zone-a-propos-public">

    {{--BANDEAU ET PHOTO DU PROFIL--}}
    <div class="row">
        <div class="col s12">
            <div class="div-bandeau-a-propos grey darken-1 z-depth-1" style="background-image: url('{{ $user->bandeau }}')">
                <div class="flex-center">
                    <div class="col-image">
                        <img src="{{ $user->image }}" class="circle z-depth-2">
                    </div>
                    <div class="col-information">
                        <h2 class="loved-king-font">{{ $user->name }}</h2>
                        <p>{{ $user->genre }}, {{ $user->age }} ans</p>
                        <p>
                            <span onclick="changeRelation({{ $user->id }}, {{  $relationStatus }})">
                                @if($relationStatus == 0)
                                    <i class="material-icons left">star_border</i> demander {{ $user->name }} en amis
                                @endif
                                @if($relationStatus == 1)
                                    <i class="material-icons left red-text">star_border</i> Annuler la demande d'amis
                                @endif
                                @if($relationStatus == 2)
                                    <i class="material-icons left teal-text">star_border</i> Accepter la demande d'amis de {{ $user->name }}
                                @endif
                                @if($relationStatus == 3)
                                    <i class="material-icons left amber-text">star</i> Vous êtes amis avec {{ $user->name }}
                                @endif
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--INFORMATIONS ET LIENS WEB--}}
    <div class="row stretchCol">

        {{--INFORMATION--}}
        <div class="col s12 m6 l8">
            <div class="card-panel blue-card-panel information-div">
                <h3 class="loved-king-font title-3-a-propos">Ma mini-bio</h3>

                @if($user->description != '')
                    <p>{{ $user->description }}</p>
                @else
                    <p class="grey-text text-center">{{ $user->name }} n'as pas encore renseigné(e) sa mini-bio</p>
                @endif

                <p class="text-right">
                    <a class="btn-flat blue-text waves-effect" onclick="newMessage({{ $user->id }}, this)"><i class="material-icons left">email</i> Contacter</a>
                </p>
            </div>
        </div>

        {{--LIEN WEB--}}
        <div class="col s12 m6 l4">
            <div class="card-panel blue-card-panel">
                <h3 class="loved-king-font title-3-a-propos">Je suis ailleur sur le web</h3>

                <div class="list-user-site">
                    @foreach($user->socialNetworks as $site)
                        <p>
                            <a target="_blank" href="{{ $site->url }}">
                                <img src="/img/social-{{ $site->social_network_id }}.svg">
                                @if($site->label != '')
                                    {{ $site->label }}
                                @else
                                    {{ ucfirst($site->socialNetwork->label) }}
                                @endif
                            </a>
                        </p>
                    @endforeach

                    @if(count($user->socialNetworks) == 0)
                        <p class="text-center grey-text">{{ $user->name }} n'as pas renseigné(e) ses autres sites web</p>
                    @endif
                </div>
            </div>
        </div>
    </div>


    {{--PARTENAIRE DE GRIMPE--}}
    @if($user->settings->partenaire == 1)
        <div class="row">
            <div class="col s12">
                <div class="card-panel blue-card-panel">
                    <h3 class="loved-king-font title-3-a-propos">Je recherche des partenaires de grimpe</h3>

                    <div class="row">
                        <div class="col s12 m6 l6">
                            mon bla bla de présentation
                        </div>

                        <div class="col s12 m6 l3">
                            niveau<br>
                            type de grimpe
                        </div>

                        <div class="col s12 m12 l3">
                            mes lieux de grimpe
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endif

    {{--USER DANS LA COMMUNAUTÉ--}}
    <div>
        <div class="col s12">
            <div class="card-panel blue-card-panel">
                <h3 class="loved-king-font title-3-a-propos">Mon implication dans la communauté</h3>

                <div class="row">

                    @if($user->somme_add != 0)

                        {{--NOMBRE DE SITE DE GRIMPE--}}
                        @if($user->crags_count > 0)
                            <div class="col s12 m4 l3">
                                <p><i class="material-icons left">terrain</i> <span class="blue-text">+ {{ $user->crags_count }}</span> sites de grimpe</p>
                            </div>
                        @endif

                        {{--NOMBRE DE LIGNES--}}
                        @if($user->routes_count > 0)
                            <div class="col s12 m4 l3">
                                <p><i class="material-icons left">timeline</i> <span class="blue-text">+ {{ $user->routes_count }}</span> lignes</p>
                            </div>
                        @endif

                        {{--NOMBRE DE COMMENTAIRE--}}
                        @if($user->descriptions_count > 0)
                            <div class="col s12 m4 l3">
                                <p><i class="material-icons left">comment</i> <span class="blue-text">+ {{ $user->descriptions_count }}</span> commentaires</p>
                            </div>
                        @endif

                        {{--NOMBRE DE PHOTOS--}}
                        @if($user->photos_count > 0)
                            <div class="col s12 m4 l3">
                                <p><i class="material-icons left">photo_camera</i> <span class="blue-text">+ {{ $user->photos_count }}</span> photos</p>
                            </div>
                        @endif

                        {{--NOMBRE DE VIDÉOS--}}
                        @if($user->videos_count)
                            <div class="col s12 m4 l3">
                                <p><i class="material-icons left">videocam</i> <span class="blue-text">+ {{ $user->videos_count }}</span> vidéos</p>
                            </div>
                        @endif

                        {{--NOMBRE DE TOPO (PAPIER, WEB, PDF--}}
                        @if($user->topos_count + $user->topoWebs_count + $user->topoPdfs_count)
                            <div class="col s12 m4 l3">
                                <p><i class="material-icons left">photo_album</i> <span class="blue-text">+ {{ $user->topos_count + $user->topoWebs_count + $user->topoPdfs_count }}</span> topos</p>
                            </div>
                        @endif


                        {{--NOMBRE DE SALLE DE GRIMPE--}}
                        <div class="col s12 m4 l3">
                            <p><i class="material-icons left">home</i> <span class="blue-text">+ x</span> salle de grimpe</p>
                        </div>

                        {{--NOMBRE D'ACTU--}}
                        @if($user->posts_count)
                            <div class="col s12 m4 l3">
                                <p><i class="material-icons left">forum</i> <span class="blue-text">+ {{ $user->posts_count }}</span> actus postées</p>
                            </div>
                        @endif

                    @else

                        <p class="grey-text text-center">{{ $user->name }} n'as pas encore contribué sur oblyk</p>

                    @endif


                </div>

            </div>
        </div>
    </div>
</div>
