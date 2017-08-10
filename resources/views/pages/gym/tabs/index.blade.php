<div class="row stretchCol">

    {{--INOFRMATION SUR LA SALLE--}}
    <div class="col s12 m7">
        <div class="card-panel">
            <h2 class="loved-king-font">Informations sur {{ $gym->label }}</h2>
            <p>
                {{ $gym->label }} est une salle d'escalade
                @if($gym->type_boulder == 1 && $gym->type_route == 1) de <span class="type-bloc text-bold">bloc</span> et de <span class="type-voie text-bold">voie</span> @endif
                @if($gym->type_boulder == 1 && $gym->type_route == 0) de <span class="type-bloc text-bold">bloc</span> @endif
                @if($gym->type_boulder == 0 && $gym->type_route == 1) de <span class="type-voie text-bold">voie</span> @endif
                situé à {{ $gym->city }} <a class="grey-text" href="{{ route('map') }}#{{ $gym->lat }}/{{ $gym->lng }}/15">({{ $gym->address }}, {{ $gym->postal_code }} {{ $gym->city }})</a>
            </p>

            @markdown($gym->description)

            @if(Auth::check() && $gym->free == 1)
                <div class="text-right ligne-btn">
                    <i {!! $Helpers::tooltip('Modifier les informations') !!} {!! $Helpers::modal(route('gymModal'), ["id"=>$gym->id, "title"=>"Modifier cette salle", "method" => "PUT"]) !!} class="material-icons tooltipped btnModal">edit</i>
                </div>
            @endif
        </div>
    </div>

    {{--PETITE INFORMATION SUR LA SALLE--}}
    <div class="col s12 m5">
        <div class="card-panel">
            <h2 class="loved-king-font">À propos</h2>
            <p><i class="material-icons left">phone</i>
                @if($gym->phone_number != '')
                    <a href="tel:{{ $gym->phone_number }}">
                        {{ $gym->phone_number }}
                    </a>
                @else
                    <span class="grey-text">numéro de téléphone non renseigné</span>
                @endif
            </p>
            <p><i class="material-icons left">email</i>
                @if($gym->email != '')
                    <a href="mailto:{{ $gym->email }}">
                        {{ $gym->email }}
                    </a>
                @else
                    <span class="grey-text">email non renseigné</span>
                @endif
            </p>
            <p><i class="material-icons left">language</i>
                @if($gym->web_site != '')
                    <a href="{{ $gym->web_site }}" class="truncate">
                        {{ $gym->web_site }}
                    </a>
                @else
                    <span class="grey-text">site internet non renseigné</span>
                @endif
            </p>
        </div>
    </div>
</div>

<div class="row">
    {{--DESCRIPTION--}}
    @include('pages.gym.partials.description')
</div>

<div class="row">
    {{--DESCRIPTION--}}
    @include('pages.gym.partials.partner')
</div>


