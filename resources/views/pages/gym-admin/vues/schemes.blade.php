@inject('Helpers','App\Lib\HelpersTemplates')

<div class="row">
    @foreach($gym->rooms as $room)
        <div class="col s12 m6 l4">
            <div class="card">
                <div class="card-image card-scheme-image" style="background-image: url('/storage/gyms/schemes/scheme-{{ $room->id }}.png')"></div>
                <div class="card-content text-center">
                    <span class="card-title grey-text text-darken-4">{{ $room->label }}</span><br>
                </div>
                <div class="card-action">
                    <a href="{{ $room->url() }}">Voir</a>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="fixed-action-btn">
    <a {!! $Helpers::tooltip('Ajouter un espace') !!} {!! $Helpers::modal(route('roomModal', ['gym_id'=>$gym->id]), ["gym_id"=>$gym->id, "title"=>'Créer un espace', "method"=>"POST"]) !!} id="scheme-btn-modal" class="btn-floating btn-large red tooltipped btnModal">
        <i class="large material-icons">add</i>
    </a>
</div>
