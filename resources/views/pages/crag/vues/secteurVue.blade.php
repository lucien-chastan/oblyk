@inject('Helpers','App\Lib\HelpersTemplates')

<input hidden id="cragId" value="{{$crag->id}}">

<div class="row">
    <div class="col s12">
        <div class="card-panel div-search-secteur">
            <div class="row">
                <div class="input-field col s12 l9">
                    <i class="material-icons prefix">search</i>
                    <input id="secteurSearche" type="search">
                    <label for="secteurSearche">Chercher dans les secteurs</label>
                </div>
                <div class="col s12 l3 text-right">
                    <p>
                        <label>Affichage :</label>
                        <i id="btnCondenseAffichage" onclick="changeAffichageSecteur('condense')" {!! $Helpers::tooltip('Affichage condensé') !!} class="material-icons grey-text right tooltipped">view_headline</i>
                        <i id="btnLargeAffichage" onclick="changeAffichageSecteur('large')" {!! $Helpers::tooltip('Afficahge large') !!} class="material-icons right blue-text tooltipped">view_stream</i>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">

    {{--LISTE DES SECTEURS--}}
    @foreach($crag->sectors as $sector)
        <div class="col s12">
            <div class="card-panel div-secteur" id="div-secteur-{{$sector->id}}" onclick="extendSectorDiv({{$sector->id}})">

                <h2 class="loved-king-font">{{$sector->label}}</h2>

                <div class="row no-bottom-margin">
                    <div class="col s12">
                        <ul class="tabs">
                            <li class="tab col s3"><a class="active routerLinkSector" href="#informations-secteur-{{$sector->id}}">Informations</a></li>
                            <li class="tab col s3"><a onclick="loadSectorVue(this)" data-route="{{route('vueLinesSector',[$sector->id])}}" href="#voies-secteur-{{$sector->id}}">Voies</a></li>
                            <li class="tab col s3"><a onclick="loadSectorVue(this)" data-route="{{route('vueDescriptionsSector',[$sector->id])}}" href="#description-secteur-{{$sector->id}}">Descriptions</a></li>
                            <li class="tab col s3"><a onclick="loadSectorVue(this)" data-route="{{route('vuePhotosSector',[$sector->id])}}" href="#photos-secteur-{{$sector->id}}">Photos</a></li>
                        </ul>
                    </div>
                    <div id="informations-secteur-{{$sector->id}}" class="col s12">@include('pages.crag.tabs.sector-tabs.sector-informations')</div>
                    <div id="voies-secteur-{{$sector->id}}" class="col s12">@include('pages.crag.tabs.sector-tabs.sector-lines')</div>
                    <div id="description-secteur-{{$sector->id}}" class="col s12">@include('pages.crag.tabs.sector-tabs.sector-descriptions')</div>
                    <div id="photos-secteur-{{$sector->id}}" class="col s12">@include('pages.crag.tabs.sector-tabs.sector-photos')</div>
                </div>

            </div>
        </div>
    @endforeach
</div>

{{--bouton d'ajout--}}
@if(Auth::check())
    <div class="fixed-action-btn horizontal">
        <a class="btn-floating btn-large red">
            <i class="large material-icons">add</i>
        </a>
        <ul>
            <li><a {!! $Helpers::tooltip('Ajouter un secteur') !!}} {!! $Helpers::modal(route('sectorModal'),['crag_id' => $crag->id ,'title'=>'Ajouter un secteur','method'=>'POST']) !!} class="tooltipped btn-floating blue btnModal"><i class="material-icons">terrain</i></a></li>
            <li><a {!! $Helpers::tooltip('Ajouter une ligne') !!}} class="tooltipped btn-floating blue btnModal"><i class="material-icons">timeline</i></a></li>
        </ul>
    </div>
@endif