@inject('Helpers','App\Lib\HelpersTemplates')

<div class="row">
    @foreach($gym->rooms as $room)
        <div class="col s12 m6 l4" data-route="{{ route('gym_admin_scheme_gym', ['gym_id' => $gym->id, 'room_id'=>$room->id]) }}" onclick="loadProfileRoute(this)">
            <div class="card">
                <div class="card-image card-scheme-image waves-effect waves-block waves-light" style="background-image: url('/storage/gyms/schemes/scheme-{{ $room->id }}.png')"></div>
                <div class="card-content text-center">
                    <span class="card-title activator grey-text text-darken-4">{{ $room->label }}</span><br>
                    <p>
                        <strong>Secteurs :</strong> x <strong>voies :</strong> x
                    </p>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="fixed-action-btn">
    <a {!! $Helpers::tooltip('Ajouter un topo') !!} {!! $Helpers::modal(route('roomModal', ['gym_id'=>$gym->id]), ["gym_id"=>$gym->id, "title"=>'Créer un topo', "method"=>"POST"]) !!} id="scheme-btn-modal" class="btn-floating btn-large red tooltipped btnModal">
        <i class="large material-icons">add</i>
    </a>
</div>