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
                            ajouté par <a href="{{ route('userPage', ['user_id'=>$parking->user->id, 'user_label'=>str_slug($parking->user->name)]) }}">{{$parking->user->name}}</a> le {{$parking->created_at->format('d M Y')}}

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
                        <i class="material-icons blue-text left">directions_walk</i>
                        <div class="markdownZone">{{ $approach->description }}</div>
                        <p class="no-margin"><strong>Longueur :</strong> {{ $approach->length }} mètres <span class="grey-text">(environs {{ round($approach->length / 1000 * 60 / 3, 0) }} minutes de marche à 3 Km/h)</span></p>
                        <p class="info-user grey-text">
                            ajouté par <a href="{{ route('userPage', ['user_id'=>$approach->user->id, 'user_label'=>str_slug($approach->user->name)]) }}">{{$approach->user->name}}</a> le {{$approach->created_at->format('d M Y')}}

                            @if(Auth::check())
                                <i {!! $Helpers::tooltip('Signaler un problème') !!} {!! $Helpers::modal(route('problemModal'), ["id"=>$approach->id, "model"=>"Approach"]) !!} class="material-icons tiny-btn right tooltipped btnModal">flag</i>
                                @if($parking->user_id == Auth::id())
                                    <i {!! $Helpers::tooltip('Modifier cette marche d\'approche') !!} {!! $Helpers::modal(route('approachModal'), ["crag_id"=>$crag->id, "approach_id"=>$approach->id, "title"=>"Modifier cette marche d\'approche", "method" => "PUT"]) !!} class="material-icons tiny-btn right tooltipped btnModal">edit</i>
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
                        @if(count($crag->parkings) != 0)
                            <li><a {!! $Helpers::tooltip('Ajouter une marche d\'approche') !!}} {!! $Helpers::modal(route('approachModal'), ["crag_id"=>$crag->id, "approach_id"=>"", "title"=>"Ajouter une marche d\'approche", "method" => "POST", "lat1"=>$crag->lat, "lng1"=>$crag->lng, "lat2"=>$crag->parkings[0]->lat, "lng2"=>$crag->parkings[0]->lng]) !!} class="tooltipped btn-floating blue btnModal"><i class="material-icons">directions_walk</i></a></li>
                        @else
                            <li><a {!! $Helpers::tooltip('Ajouter au moins un parking pour ajouter une marche d\'approche') !!}} onclick="alert('Il faut que vous ayez ajouté au moins un parking pour pouvoir ajouter une marche d\'approche')" class="tooltipped btn-floating blue"><i class="material-icons">directions_walk</i></a></li>
                        @endif
                        <li><a {!! $Helpers::tooltip('Ajouter un parking') !!}} {!! $Helpers::modal(route('parkingModal'), ["crag_id"=>$crag->id, "parking_id"=>"", "title"=>"Ajouter un parking", "method" => "POST", "lat"=>$crag->lat, "lng"=>$crag->lng]) !!} class="tooltipped btn-floating blue btnModal"><i class="material-icons">local_parking</i></a></li>
                    </ul>
                </div>
            @endif
        </div>
    </div>
</div>