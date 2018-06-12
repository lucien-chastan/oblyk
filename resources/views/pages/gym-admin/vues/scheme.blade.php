@inject('Helpers','App\Lib\HelpersTemplates')

<div class="row">
    <div class="col s12">
        <div class="card-panel blue-card-panel">
            <div class="row">
                <div class="col s12 m6" style="position: relative; background-color: {{ $room->scheme_bg_color }}">
                    <div style="position: absolute; top: 0; width: 100%; color: {{ $room->banner_color }}; background-color: {{ $room->banner_bg_color }}">oblyk</div>
                    <img src="/storage/gyms/schemes/scheme-{{ $room->id }}.png" class="responsive-img"><br>
                </div>
                <div class="col s12 m6">
                    <table class="bordered">
                        <tr>
                            <th class="text-right" style="width: 10px">Nom</th>
                            <td>{{ $room->label }}</td>
                        </tr>
                        <tr>
                            <th class="text-right" style="width: 10px">Description</th>
                            <td>@markdown($room->description)</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row text-right">
                <button {!! $Helpers::tooltip(trans('modals/description.deleteTooltip')) !!} {!! $Helpers::modal(route('deleteModal'), ["route" => "/rooms/".$room->id]) !!} class="btn-flat btnModal">
                    <i class="material-icons right">delete</i>
                    Supprimer
                </button>
                <button {!! $Helpers::modal(route('roomModal', ['gym_id'=>$gym->id]), ["id"=>$room->id, "title"=>'Modifier le topo', "method"=>"PUT"]) !!} class="btn-flat btnModal">
                    <i class="material-icons right">edit</i>
                    Modifier
                </button>
                <button {!! $Helpers::modal(route('roomUploadSchemeModal', ['gym_id'=>$gym->id]), ["room_id"=>$room->id, "title"=>'Telecharger un plan', "method"=>"POST"]) !!} class="btn-flat btnModal">
                    <i class="material-icons right">crop_free</i>
                    Changer le plan
                </button>
                <a class="btn-flat" target="_blank" href="{{ route('gymSchemePage', ['gym_label'=>str_slug($gym->label), 'gym_id'=>$gym->id, 'room_id'=>$room->id]) }}">
                    <i class="material-icons right">view_quilt</i>
                    Voir la page
                </a>
            </div>
        </div>
    </div>
</div>

<div>
    <div class="col s12">
        <div class="card-panel blue-card-panel">

            @if($room->sectors_count > 0)
                <table class="highlight">
                    <thead>
                    <tr>
                        <th>Réf</th>
                        <th>Nom</th>
                        <th>Hauteur</th>
                        <th>Voies</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($room->sectors as $sector)
                        @php($routeAndClick = 'data-route="' . route('gym_admin_sector_routes', ['gym_id' => $gym->id, 'sector_id'=>$sector->id]) . '" onclick="loadProfileRoute(this)"')
                        <tr>
                            <td {!! $routeAndClick !!}>{{ $sector->ref }}</td>
                            <td {!! $routeAndClick !!}>{{ $sector->label }}</td>
                            <td {!! $routeAndClick !!}>{{ $sector->height }} m</td>
                            <td {!! $routeAndClick !!}>x</td>
                            <td>
                                <i {!! $Helpers::tooltip('Modifier ce secteur') !!} {!! $Helpers::modal(route('gymSectorModal', ["gym_id"=>$gym->id,]), ["id"=>$sector->id, "room_id"=>$room->id, "gym_id"=>$gym->id, "title"=>'Modifier ce secteur', "method"=>"PUT"]) !!} class="material-icons right tooltipped btnModal">edit</i>
                                <i {!! $Helpers::tooltip(trans('modals/description.deleteTooltip')) !!} {!! $Helpers::modal(route('deleteModal'), ["route" => "/gym_sectors/".$sector->id]) !!} class="material-icons right tooltipped btnModal">delete</i>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
            <p class="text-right">
                <button {!! $Helpers::tooltip('Ajouter un Secteur') !!} {!! $Helpers::modal(route('gymSectorModal', ["gym_id"=>$gym->id,]), ["room_id"=>$room->id, "gym_id"=>$gym->id, "title"=>'Créer un secteur', "method"=>"POST"]) !!} class="btn-flat tooltipped btnModal">
                    <i class="material-icons left">add</i>
                    Ajouter un secteur
                </button>
            </p>
        </div>
    </div>
</div>