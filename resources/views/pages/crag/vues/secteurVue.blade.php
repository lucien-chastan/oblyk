@inject('Helpers','App\Lib\HelpersTemplates')

<input hidden id="cragId" value="{{$crag->id}}">

<div class="row">

    {{--LISTE DES SECTEURS--}}
    @foreach($crag->sectors as $sector)
        <div class="col s12">
            <div class="card-panel">

                <h2 class="loved-king-font">{{$sector->label}}</h2>

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
            <li><a {!! $Helpers::tooltip('Ajouter un secteur') !!}} class="tooltipped btn-floating blue"><i class="material-icons">terrain</i></a></li>
            <li><a {!! $Helpers::tooltip('Ajouter une ligne') !!}} class="tooltipped btn-floating blue btnModal"><i class="material-icons">timeline</i></a></li>
        </ul>
    </div>
@endif