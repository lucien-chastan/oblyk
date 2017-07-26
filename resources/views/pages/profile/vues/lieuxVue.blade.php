@inject('Helpers','App\Lib\HelpersTemplates')
@inject('Inputs','App\Lib\InputTemplates')

<div class="row">
    <div class="col s12">
        <div class="card-panel blue-card-panel">

            <button class="btn-flat right waves-effect blue-text" onclick="loadProfileRoute(document.getElementById('item-qui-je-suis-nav'))"><i class="material-icons left">arrow_back</i>Qui je suis ?</button>

            <h2 class="loved-king-font titre-profile-boite-vue">Les lieux où je grimpe</h2>

            @if($user->partnerSettings->partner == 0)
                <div class="red lighten-4 alert-partenaire-div">
                    <p class="text-center">
                        <strong>Attention !</strong> : Tu n'as pas activé la recherche de partenaire. Pour l'instant personne ne peut te trouver ...<br>
                    </p>
                    <p class="text-center">
                        <a onclick="activePartner()" class="btn-flat waves-effect text-bold"><i class="material-icons left">person_pin</i> Activer la recheche de partenaire</a>
                    </p>
                </div>
            @endif

            <p>
                <strong class="text-underline">À quoi sert les lieux dans ma recherche de partenaire ?</strong><br>
                La recherche de partenaire d'oblyk fonctionne par géolocalisation. Tu indique où tu grimpe (et dans quel rayon tu peux te déplacer autour de ce lieux) et oblyk te trouvera les grimpeurs qui sont dans les mêmes zones que toi !<br>
                Tu peux avoir autant de lieux que tu le souhaite, donc n'hésite pas à mettre des points un peut partout la où tu grimpe, comme : ta salle, les falaises près de chez toi, l'endroit où tu va en vacance, etc. Sachant que tu peux désactiver un lieux en un clic.
            </p>

            @if(count($user->places) > 0)
                <table>
                    <thead>
                    <tr>
                        <th class="text-center">Actif</th>
                        <th class="text-center">Nom du lieu</th>
                        <th class="text-center">Description</th>
                        <th class="text-center">Latitude</th>
                        <th class="text-center">Longitude</th>
                        <th class="text-center">Rayon</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($user->places as $place)
                        <tr>
                            <td>
                                <div class="switch">
                                    <label>
                                        Non
                                        @if($place->active == 1)
                                            <input value="{{ $place->id }}" onchange="activeLieu(this)" type="checkbox" checked>
                                        @else
                                            <input value="{{ $place->id }}" onchange="activeLieu(this)" type="checkbox">
                                        @endif
                                        <span class="lever"></span>
                                        Oui
                                    </label>
                                </div>
                            </td>
                            <td>{{ $place->label }}</td>
                            <td>{{ $place->description }}</td>
                            <td class="text-center grey-text">{{ $place->lat }}</td>
                            <td class="text-center grey-text">{{ $place->lng }}</td>
                            <td class="text-center grey-text">{{ $place->rayon }} Km</td>
                            <td class="text-center grey-text i-cursor">
                                <i {!! $Helpers::modal(route('partnerModal'), ["place_id"=>$place->id, "title"=>"Ajouter un lieu", "method"=>"PUT", "callback"=>"reloadCurrentVue" ]) !!} {!! $Helpers::tooltip('Modifier ce lieu') !!} class="material-icons blue-hover tooltipped btnModal">edit_location</i>
                                <i {!! $Helpers::modal(route('deleteModal'), ["route"=>"/partners/" . $place->id, "callback"=>"reloadCurrentVue" ]) !!} {!! $Helpers::tooltip('Supprimer ce lieu') !!} class="material-icons blue-hover tooltipped btnModal">delete</i>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>


                <p class="text-right">
                    <a {!! $Helpers::modal(route('partnerModal'), ["place_id"=>"", "title"=>"Ajouter un lieu", "method"=>"POST", "callback"=>"reloadCurrentVue" ]) !!} class="btn waves-effect btnModal"><i class="material-icons left">add_location</i> Ajouter un nouveau lieu</a>
                </p>

            @else
                <p class="text-center">
                    <a {!! $Helpers::modal(route('partnerModal'), ["place_id"=>"", "title"=>"Ajouter un lieu", "method"=>"POST", "callback"=>"reloadCurrentVue" ]) !!} class="btn waves-effect btnModal"><i class="material-icons left">add_location</i> Ajouter mon premier lieu</a>
                </p>
            @endif

        </div>
    </div>
</div>


<div class="row">
    <div class="col s12">
        <div class="card-panel blue-card-panel">

            <h2 class="loved-king-font titre-profile-boite-vue">Mes lieux sur la carte</h2>
            @if(count($user->places) > 0)
                <div id="placeSettingMap" class="placeSettingMap"></div>
            @else
                <p class="text-center grey-text">
                    Ajoute ton premier lieu, tu le verra apparaître sur une carte ici
                </p>
            @endif
        </div>
    </div>
</div>