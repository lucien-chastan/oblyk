@if($user->birth == 0 || $user->birth > date('Y') - 18)

    @if($user->birth == 0)
        <p class="grey-text text-center">
            Pour utiliser ce service nous devons connaître ta date de naissance
        </p>
        <p class="text-center">
            <a onclick="loadProfileRoute(document.getElementById('item-parametre-nav'))" class="btn-flat blue-text"><i class="material-icons left">date_range</i>Renseigner ma date de naissance</a>
        </p>
    @else
        <p>
            Désolé,<br>
            Pour des questions de résponsabilité, nous n'autorisons pas les mineurs à utiliser ce service.
        </p>
        <p>
            Grandi encore un peu et reviens dans quelques années !<br>
            Bonne chance à toi.
        </p>
    @endif

@else
    @if($user->partnerSettings->partner == 0)
        <p class="grey-text text-center">
            Tu n'as pas activé la recherche de partenaire
        </p>
        <p class="text-center">
            <a onclick="loadProfileRoute(document.getElementById('item-qui-je-suis-nav'))" class="btn-flat blue-text">Activer la recherche</a>
        </p>
    @else
        @if($user->places_count == 0)
            <p class="text-center grey-text">
                Tu n'as aucun lieux de grimpe activé ou renseigné
            </p>
            <p class="text-center">
                <a onclick="loadProfileRoute(document.getElementById('item-mes-lieux-nav'))" class="btn-flat blue-text"><i class="material-icons left">location_on</i> Mes lieux de grimpe</a>
            </p>
        @else

            @if(count($places) == 0)
                <p class="grey-text text-center">
                    Désolé, pour l'instant personne ne partage les mêmes zone de grimpe que toi ...
                </p>
                <p class="text-center">
                    <a onclick="loadProfileRoute(document.getElementById('item-mes-lieux-nav'))" class="btn-flat blue-text"><i class="material-icons left">location_on</i> Mes lieux de grimpe</a>
                </p>
            @else
                <div class="blue-border-zone">
                    @foreach($places as $place)
                        <div class="blue-border-div">
                            <p class="no-margin text-bold"><i class="material-icons left blue-text">location_on</i> <a href="{{ route('userPage',['user_id'=>$place->user->id,'user_label'=>str_slug($place->user->name)]) }}">{{ $place->user->name }}</a> à {{$place->label}}</p>
                            <div class="markdownZone grey-text">@markdown($place->description)</div>
                        </div>
                    @endforeach
                </div>

                <p class="text-right">
                    <a href="{{ route('partnerMapPage') }}" class="btn-flat blue-text"><i class="material-icons left">map</i> Carte des grimpeurs</a>
                </p>
            @endif

        @endif
    @endif
@endif
