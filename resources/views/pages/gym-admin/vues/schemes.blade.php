@inject('Helpers','App\Lib\HelpersTemplates')

@if(count($gym->grades) == 0)
    <div class="row">
        <div class="text-center card-panel col s8 offset-l2 yellow lighten-4">
            <p>
                Vous n'avez pas définie vos systèmes de cotation,<br>
                Rendez-vous dans <strong>"Systèmes de cotation"</strong> pour les créer.
            </p>
        </div>
    </div>
@else
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

    @if(count($gym->rooms) == 0 )
        <div class="row">
            <div class="col s12 text-center">
                <p>Vous n'avez pas encore créé d'espace.</p>
                <p>
                    Les espaces sont : soit des parties de votre salle (par exemple : l'espace bloc, l'espace voie, etc.)<br>
                    Soit des salles différentes, par exemple si vous avez un mur de voie dans un gymnase et un pan dans un autre.
                </p>
                <p>
                    <button {!! $Helpers::modal(route('roomModal', ['gym_id'=>$gym->id]), ["gym_id"=>$gym->id, "title"=>'Créer un espace', "method"=>"POST"]) !!} class="btn-flat btnModal">
                        <i class="material-icons left">add</i>
                        Créer mon premier espace
                    </button>
                </p>
            </div>
        </div>
    @endif

    <div class="fixed-action-btn">
        <a {!! $Helpers::tooltip('Ajouter un espace') !!} {!! $Helpers::modal(route('roomModal', ['gym_id'=>$gym->id]), ["gym_id"=>$gym->id, "title"=>'Créer un espace', "method"=>"POST"]) !!} id="scheme-btn-modal" class="btn-floating btn-large red tooltipped btnModal">
            <i class="large material-icons">add</i>
        </a>
    </div>
@endif
