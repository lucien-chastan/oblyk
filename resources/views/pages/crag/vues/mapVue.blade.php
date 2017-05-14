@inject('Helpers','App\Lib\HelpersTemplates')

<input hidden id="cragLat" value="{{$crag->lat}}">
<input hidden id="cragLng" value="{{$crag->lng}}">
<input hidden id="cragId" value="{{$crag->id}}">

<div class="row">
    <div class="col s12">
        <div class="card-panel">

            {{--carte--}}
            <div id="crag-map" class="crag-map"></div>

            {{--bouton d'ajout--}}
            @if(Auth::check())
                <div class="fixed-action-btn horizontal">
                    <a class="btn-floating btn-large red">
                        <i class="large material-icons">add</i>
                    </a>
                    <ul>
                        <li><a {!! $Helpers::tooltip('Ajouter une marche d\'approche') !!}} class="tooltipped btn-floating blue"><i class="material-icons">directions_walk</i></a></li>
                        <li><a {!! $Helpers::tooltip('Ajouter un parking') !!}} {!! $Helpers::modal(route('parkingModal'), ["crag_id"=>$crag->id, "parking_id"=>"", "title"=>"Ajouter un parking", "method" => "POST", "lat"=>$crag->lat, "lng"=>$crag->lng]) !!} class="tooltipped btn-floating blue btnModal"><i class="material-icons">local_parking</i></a></li>
                    </ul>
                </div>
            @endif
        </div>
    </div>
</div>