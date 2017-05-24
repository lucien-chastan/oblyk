<div class="row">

    {{--INFORMATIONS GLOBAL SUR LE SECTEUR--}}
    <div class="col s12 m6">
        <p><i class="material-icons left">directions_walk</i> @if($sector->approach != 0) {{$sector->approach}} minutes d'approche @else <cite>temps d'approche non-renseigné</cite> @endif</p>
        <p><i class="material-icons left">filter_drama</i> {{$sector->sun->label}}</p>
        <p><i class="material-icons left">brightness_low</i> ensoliellement</p>
        <p><i class="material-icons left">explore</i> Orientations</p>
        <p><i class="material-icons left">show_chart</i> 7 lignes de 6a à 7a</p>
    </div>

    {{--GRAPHIQUE--}}
    <div class="col s12 m6"></div>
</div>

@if(Auth::check())
    <div class="row no-bottom-margin">
        <div class="col s12 text-right zone-action-secteur">
            <i {!! $Helpers::tooltip('Modifier ce secteur') !!} {!! $Helpers::modal(route('sectorModal'),['title'=>'Modifier ce secteur','method'=>'PUT']) !!} class="tooltipped material-icons right btnModal">edit</i>
            <i {!! $Helpers::tooltip('Signaler un problème') !!} class="tooltipped material-icons right">flag</i>
        </div>
    </div>
@endif