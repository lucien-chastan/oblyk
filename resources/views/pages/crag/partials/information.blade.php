<div class="card-panel">
    <h2 class="loved-king-font">Informations sur {{ $crag->label }}</h2>
    <p>
        {{$crag['label']}} est un site d'escalade de
        <span class="crag-type-grimpe">
            @if($crag['type_voie'] == 1)<span class="type-voie">voie</span>@endif
            @if($crag['type_grande_voie'] == 1)<span class="type-grande-voie">grande-voie</span>@endif
            @if($crag['type_bloc'] == 1)<span class="type-bloc">bloc</span>@endif
            @if($crag['type_deep_water'] == 1)<span class="type-deep-water">deep-water</span>@endif
        </span> de {{ $crag->rock->label }}, situé à {{$crag->city}} dans le département {{$crag->region}} ({{$crag->code_country}})<br>
        On y trouve {{ $crag->routes_count }} lignes @if($crag->routes_count > 0) allant de <strong class="color-grade-{{ $crag->gapGrade->min_grade_val }}">{{ $crag->gapGrade->min_grade_text }}</strong> à <strong class="color-grade-{{ $crag->gapGrade->max_grade_val }}">{{ $crag->gapGrade->max_grade_text }}</strong> @endif
    </p>
    @if(Auth::check())
        <div class="text-right ligne-btn">
            <i {!! $Helpers::tooltip('Modifier les informations') !!} {!! $Helpers::modal(route('cragModal'), ["id"=>$crag->id, "title"=>"Modifier ce site", "method" => "PUT"]) !!} class="material-icons tooltipped btnModal">edit</i>
        </div>
    @endif
</div>