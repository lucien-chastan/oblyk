<div class="card-panel">
    <h2 class="loved-king-font">Informations sur {{ $crag->label }}</h2>
    <p>
        {{$crag['label']}} est un site d'escalade de
        <span class="crag-type-grimpe">
            @if($crag['type_voie'] == 1)<span class="type-voie">voie</span>@endif
            @if($crag['type_grande_voie'] == 1)<span class="type-grande-voie">grande-voie</span>@endif
            @if($crag['type_bloc'] == 1)<span class="type-bloc">bloc</span>@endif
            @if($crag['type_deep_water'] == 1)<span class="type-deep-water">deep-water</span>@endif
            @if($crag['type_via_ferrata'] == 1)<span class="type-via-ferrata">via-ferrata</span>@endif
        </span> de {{ $crag->rock->label }}, situé à {{$crag->city}} dans le département {{$crag->region}} ({{$crag->code_country}})<br>
        On y trouve {{ $crag->routes_count }} lignes @if($crag->routes_count > 0) allant de <strong class="color-grade-{{ $crag->gapGrade->min_grade_val }}">{{ $crag->gapGrade->min_grade_text }}</strong> à <strong class="color-grade-{{ $crag->gapGrade->max_grade_val }}">{{ $crag->gapGrade->max_grade_text }}</strong> @endif
    </p>

    {{-- INTERFICTION, CONVENTION, ETC--}}
    @if(count($crag->exceptions) > 0)
        @foreach($crag->exceptions as $exception)

            @if($exception->exception_type == 1)
                <p class="red-text text-bold">
                    <i class="material-icons left">report_problem</i> Site interdit
                </p>
            @endif

            @if($exception->exception_type == 2)
                <p class="orange-text text-bold"><i class="material-icons left">error</i> Accès restreint à ce site</p>
            @endif

            @if($exception->exception_type == 3)
                <p class="text-bold ffme-color"><img src="/img/logo_ffme.svg" class="logo-exceptions-crag"> Site conventionné par la <a class="inherit-color" href="http://www.ffme.fr/">FFME</a></p>
            @endif

            @if($exception->exception_type == 4)
                <p class="text-bold greenspits-color"><img src="/img/logo_greenspits.svg" class="logo-exceptions-crag"> Site maintenu par <a class="inherit-color" href="https://greenspits.com/fr/greenspits-projet-naissant-lavenir/">Greenspits</a></p>
            @endif

            <div class="markdownZone">{{$exception->description}}</div>

        @endforeach
    @endif

    {{--REGROUPEMENT--}}
    @if(count($crag->massives) > 0)
        <p>
            {{$crag['label']}} fait partie des groupes suivant :<br>
            @foreach($crag->massives as $liaison)
                - <a href="{{route('massivePage',['massive_id'=>$liaison->massive->id, 'massive_label'=>str_slug($liaison->massive->label)])}}">{{$liaison->massive->label}}</a><br>
            @endforeach
            @if(Auth::check())
                + <a {!! $Helpers::modal(route('massiveCragModal'), ["crag_id"=>$crag->id, "lat"=>$crag->lat, "lng"=>$crag->lng, "rayon"=>50, "title"=>"Lié à un groupe"]) !!} class="btnModal text-cursor">lier à un autre groupe</a>
            @endif
        </p>
    @else
        <p class="grey-text text-center">
            {{$crag['label']}} ne fait pas partie d'un regroupement de site<br>
            @if(Auth::check())
                <a {!! $Helpers::modal(route('massiveCragModal'), ["crag_id"=>$crag->id, "lat"=>$crag->lat, "lng"=>$crag->lng, "rayon"=>50, "title"=>"Lié à un groupe"]) !!} class="btnModal text-cursor">lier à un groupe</a>
            @endif
        </p>
    @endif

    @if(Auth::check())
        <div class="text-right ligne-btn">
            <i {!! $Helpers::tooltip('Modifier les informations') !!} {!! $Helpers::modal(route('cragModal'), ["id"=>$crag->id, "title"=>"Modifier ce site", "method" => "PUT"]) !!} class="material-icons tooltipped btnModal">edit</i>
        </div>
    @endif

</div>