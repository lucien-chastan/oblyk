@inject('Helpers','App\Lib\HelpersTemplates')

<input hidden id="cragLat" value="{{$crag->lat}}">
<input hidden id="cragLng" value="{{$crag->lng}}">
<input hidden id="cragId" value="{{$crag->id}}">

<div class="row">
    <div class="col s12">
        <div class="card-panel">

            {{--carte--}}
            <div id="crag-map" class="crag-map"></div>

            {{--Liste des parking--}}
            <div class="blue-border-zone">
                <h2 class="loved-king-font">Les parkings</h2>
                @foreach($crag->parkings as $parking)
                    <div class="blue-border-div">
                        <i class="material-icons blue-text left">local_parking</i> <a class="tooltipped lien-parking" {!! $Helpers::tooltip('Cliquer pour afficher sur la carte', 'right') !!} onclick="cragMap.setView([{{$parking->lat}}, {{$parking->lng}}], 18)">{{$parking->lat}}, {{$parking->lng}}</a>
                        <div class="markdownZone">{{ $parking->description }}</div>
                        <p class="info-user grey-text">
                            ajouté par {{$parking->user->name}} le {{$parking->created_at->format('d M Y')}}

                            @if(Auth::check())
                                <i {!! $Helpers::tooltip('Signaler un problème') !!} {!! $Helpers::modal(route('problemModal'), ["id"=>$parking->id, "model"=>"Parking"]) !!} class="material-icons tiny-btn right tooltipped btnModal">flag</i>
                                @if($parking->user_id == Auth::id())
                                    <i {!! $Helpers::tooltip('Modifier ce parking') !!} {!! $Helpers::modal(route('parkingModal'), ["crag_id"=>$crag->id, "parking_id"=>$parking->id, "title"=>"Modifier ce parking", "method" => "PUT", "lat"=>$parking->lat, "lng"=>$parking->lng]) !!} class="material-icons tiny-btn right tooltipped btnModal">edit</i>
                                    <i {!! $Helpers::tooltip('Supprimer ce parking') !!} {!! $Helpers::modal(route('deleteModal'), ["route"=>"/parkings/" . $parking->id ]) !!} class="material-icons tiny-btn right tooltipped btnModal">delete</i>
                                @endif
                            @endif
                        </p>
                    </div>
                @endforeach

                @if(count($crag->parkings) == 0)
                    <p class="grey-text text-center">Il n'y a pas encore de parking référencé sur ce site</p>
                @endif

            </div>

            {{--Liste des marches d'approches--}}
            <div class="blue-border-zone">
                <h2 class="loved-king-font">Les marches d'approches</h2>
                @foreach($crag->approaches as $approach)
                    <div class="blue-border-div">
                        <i class="material-icons blue-text left">directions_walk</i> <a class="tooltipped lien-parking" {!! $Helpers::tooltip('Cliquer pour afficher sur la carte', 'right') !!}>test</a>
                        <div class="markdownZone">{{ $approach->description }}</div>
                        <p class="info-user grey-text">
                            ajouté par {{$approach->user->name}} le {{$approach->created_at->format('d M Y')}}

                            @if(Auth::check())
                                <i {!! $Helpers::tooltip('Signaler un problème') !!} {!! $Helpers::modal(route('problemModal'), ["id"=>$approach->id, "model"=>"Approach"]) !!} class="material-icons tiny-btn right tooltipped btnModal">flag</i>
                                @if($parking->user_id == Auth::id())
                                    <i {!! $Helpers::tooltip('Modifier cette marche d\'approche') !!} {!! $Helpers::modal(route('parkingModal'), ["crag_id"=>$crag->id, "approach_id"=>$approach->id, "title"=>"Modifier cette marche d'approche", "method" => "PUT"]) !!} class="material-icons tiny-btn right tooltipped btnModal">edit</i>
                                    <i {!! $Helpers::tooltip('Supprimer cette marche d\'approche') !!} {!! $Helpers::modal(route('deleteModal'), ["route"=>"/approaches/" . $approach->id ]) !!} class="material-icons tiny-btn right tooltipped btnModal">delete</i>
                                @endif
                            @endif
                        </p>
                    </div>
                @endforeach

                @if(count($crag->approaches) == 0)
                    <p class="grey-text text-center">Il n'y a pas encore de marche d'approche référencée sur ce site</p>
                @endif

            </div>

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