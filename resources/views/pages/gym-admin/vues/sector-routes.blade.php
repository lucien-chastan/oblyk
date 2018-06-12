@inject('Helpers','App\Lib\HelpersTemplates')

<div class="row">
    <div class="col s12">
        <div class="card-panel blue-card-panel">
            <div class="row">
                <div class="col s6 m3">
                    <button class="btn-flat" data-route="{{ route('gym_admin_scheme_gym', ['gym_id' => $gym->id, 'room_id'=>$sector->room_id]) }}" onclick="loadProfileRoute(this)">
                        <i class="material-icons left">keyboard_backspace</i>
                        Topo
                    </button>
                </div>
                <div class="col s6 m9">
                    {{ $sector->label }}
                </div>
            </div>

            <div class="row text-right">
                <button {!! $Helpers::modal(route('deleteModal'), ["route" => "/gym_sectors/".$sector->id]) !!} class="btn-flat btnModal">
                    <i class="material-icons right">delete</i>
                    Supprimer
                </button>
                <button {!! $Helpers::modal(route('gymSectorModal', ["gym_id"=>$gym->id,]), ["id"=>$sector->id, "room_id"=>$sector->room_id, "gym_id"=>$gym->id, "title"=>'Modifier ce secteur', "method"=>"PUT"]) !!} class="btn-flat btnModal">
                    <i class="material-icons right">edit</i>
                    Modifier
                </button>
                <button class="btn-flat btnModal">
                    <i class="material-icons right">crop_free</i>
                    Positionner sur le plan
                </button>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col s12">
        <div class="card-panel blue-card-panel">
            <div class="row">
                @if($sector->routes_count != 0)
                    <table class="striped">
                        <thead>
                        <tr>
                            <th>Réf</th>
                            <th>Nom</th>
                            <th>Cotation</th>
                            <th>Couleur</th>
                            <th>Type</th>
                            <th>Hauteur</th>
                            <th>Ouvreur</th>
                            <th>Ouverture</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sector->routes as $route)
                            <tr>
                                <td>{{ $route->reference }}</td>
                                <td class="text-bold">{{ $route->label }}</td>
                                <td class="text-bold"><span class="color-grade-{{ $route->val_grade }}">{{ $route->grade }}</span></td>
                                <td>
                                    @foreach($route->colors() as $color)
                                        <div class="material-icons z-depth-2" style="background-color: {{ $color }}; height: 0.6em; width: 0.6em; border-radius: 50%"></div>
                                    @endforeach
                                </td>
                                <td>{{ $route->type }}</td>
                                <td>{{ $route->height }}</td>
                                <td>{{ $route->opener }}</td>
                                <td>{{ $route->opener_date }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-center grey-text">Il y a aucune voie dans ce secteur</p>
                @endif
            </div>
        </div>
    </div>
</div>
