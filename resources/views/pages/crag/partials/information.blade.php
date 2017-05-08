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
        On y trouve x lignes allant de x à x
    </p>
    @if(Auth::check())
        <div class="text-right ligne-btn">
            <i data-modal="{'id':{{$crag->id}}, 'title':'Modifier ce site', 'method' : 'PUT'}" data-route="{{route('cragModal')}}" data-target="modal" data-position="top" data-delay="50" data-tooltip="Modifier les informations" class="material-icons tooltipped btnModal">edit</i>
        </div>
    @endif
</div>