@extends('layouts.iframe', [
    'meta_title'=> $crag->label,
    'meta_description'=> $crag->label,
    ])

@section('css')
    <link href="/css/iframe/crag-iframe.css" rel="stylesheet">
    <link href="/css/cotation.css" rel="stylesheet">
@endsection

@section('content')
<div class="content-iframe">
    <div class="img-area">
        <a class="inherit-link" target="_blank" href="{{ route('cragPage', ['crag_id' => $crag->id, 'crag_label' => str_slug($crag->label)]) }}">
            <img alt="photo de couverture de {{ $crag->label }}" src="{{ ($crag->bandeau != '/img/default-crag-bandeau.jpg') ? str_replace('1300','200',$crag->bandeau) : '/img/bandeau_oblyk.png' }}">
        </a>
    </div>
    <div class="content-area">
        <a class="lien-oblyk" href="https://oblyk.org">oblyk.org</a>
        <a class="inherit-link" target="_blank" href="{{ route('cragPage', ['crag_id' => $crag->id, 'crag_label' => str_slug($crag->label)]) }}">
            <h1>{{ $crag->label }}</h1>
        </a>
        <table>
            <tr>
                <td><i class="material-icons">map</i> <span>Localisation :</span></td>
                <td>
                    <a class="inherit-link" target="_blank" href="{{ route('map') }}#{{ $crag->lat }}/{{ $crag->lng }}/15">
                        <i class="material-icons map-link">map</i>
                        {{ $crag->city }}, {{ $crag->region }} ({{ $crag->code_country }})
                    </a>
                </td>
            </tr>
            <tr>
                <td><i class="material-icons">merge_type</i> <span>Type de grimpe :</span></td>
                <td class="climb-type">
                    @if($crag->type_voie == 1) <span class="voie">voie</span> @endif
                    @if($crag->type_grande_voie == 1) <span class="grande-voie">grande-voie</span> @endif
                    @if($crag->type_bloc == 1) <span class="bloc">bloc</span> @endif
                    @if($crag->type_deep_water == 1) <span class="deep-water">deep-water</span> @endif
                    @if($crag->type_via_ferrata == 1) <span class="via-ferrata">via-ferrata</span> @endif
                </td>
            </tr>
            <tr>
                <td><i class="material-icons">timeline</i> <span>Lignes &amp; Cotations :</span></td>
                <td>
                    {{ $crag['routes_count'] }} lignes
                    @if($crag['routes_count'] > 0 ), <strong class="text-bold color-grade-{{$crag->gapGrade->min_grade_val}}">{{$crag->gapGrade->min_grade_text}}</strong> <i class="material-icons tiny">arrow_forward</i> <strong class="text-bold color-grade-{{$crag->gapGrade->max_grade_val}}">{{$crag->gapGrade->max_grade_text}}</strong> @endif
                </td>
            </tr>
            <tr>
                <td></td>
                <td>

                </td>
            </tr>
        </table>
    </div>
</div>
@endsection