@inject('Helpers','App\Lib\HelpersTemplates')

<input hidden id="cragId" value="{{$crag->id}}">

<div class="row">

    {{--LISTE DES SECTEURS--}}
    @foreach($crag->sectors as $sector)
        <div class="col s12">
            <div class="card-panel div-secteur">

                <h2 class="loved-king-font">{{$sector->label}}</h2>

                <div class="row no-bottom-margin">
                    <div class="col s12">
                        <ul class="tabs">
                            <li class="tab col s3"><a class="active" href="#informations-secteur-{{$sector->id}}">Informations</a></li>
                            <li class="tab col s3"><a href="#voies-secteur-{{$sector->id}}">Voies</a></li>
                            <li class="tab col s3"><a href="#description-secteur-{{$sector->id}}">Descriptions</a></li>
                            <li class="tab col s3"><a href="#photos-secteur-{{$sector->id}}">Photos</a></li>
                        </ul>
                    </div>
                    <div id="informations-secteur-{{$sector->id}}" class="col s12">@include('pages.crag.partials.informations-sector')</div>
                    <div id="voies-secteur-{{$sector->id}}" class="col s12">voies</div>
                    <div id="description-secteur-{{$sector->id}}" class="col s12">descriptions</div>
                    <div id="photos-secteur-{{$sector->id}}" class="col s12">photos</div>
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