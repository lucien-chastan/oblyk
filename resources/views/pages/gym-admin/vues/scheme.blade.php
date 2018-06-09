@inject('Helpers','App\Lib\HelpersTemplates')

<div class="row">
    <div class="col s12">
        <div class="card-panel blue-card-panel">
            <div class="row">
                <div class="col s12 m6">
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