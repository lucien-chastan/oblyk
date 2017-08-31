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
                <h2 class="loved-king-font">@lang('pages/crags/tabs/map.titleParking')</h2>
                @foreach($crag->parkings as $parking)
                    <div class="blue-border-div">
                        <i class="material-icons blue-text left">local_parking</i> <a class="tooltipped lien-parking" {!! $Helpers::tooltip('Cliquer pour afficher sur la carte', 'right') !!} onclick="cragMap.setView([{{$parking->lat}}, {{$parking->lng}}], 18)">{{$parking->lat}}, {{$parking->lng}}</a>
                        <div class="markdownZone">{{ $parking->description }}</div>
                        <p class="info-user grey-text">
                            ajouté par <a href="{{ route('userPage', ['user_id'=>$parking->user->id, 'user_label'=>str_slug($parking->user->name)]) }}">{{$parking->user->name}}</a> le {{$parking->created_at->format('d M Y')}}

                            @if(Auth::check())
                                <i {!! $Helpers::tooltip(trans('modals/problem.tooltip')) !!} {!! $Helpers::modal(route('problemModal'), ["id"=>$parking->id, "model"=>"Parking"]) !!} class="material-icons tiny-btn right tooltipped btnModal">flag</i>
                                @if($parking->user_id == Auth::id())
                                    <i {!! $Helpers::tooltip(trans('modals/parking.editTooltip')) !!} {!! $Helpers::modal(route('parkingModal'), ["crag_id"=>$crag->id, "parking_id"=>$parking->id, "title"=>trans('modals/parking.modalEditeTitle'), "method" => "PUT", "lat"=>$parking->lat, "lng"=>$parking->lng]) !!} class="material-icons tiny-btn right tooltipped btnModal">edit</i>
                                    <i {!! $Helpers::tooltip(trans('modals/parking.deleteTooltip')) !!} {!! $Helpers::modal(route('deleteModal'), ["route"=>"/parkings/" . $parking->id ]) !!} class="material-icons tiny-btn right tooltipped btnModal">delete</i>
                                @endif
                            @endif
                        </p>
                    </div>
                @endforeach

                @if(count($crag->parkings) == 0)
                    <p class="grey-text text-center">@lang('pages/crags/tabs/map.noParking')</p>
                @endif

            </div>

            {{--Liste des marches d'approches--}}
            <div class="blue-border-zone">
                <h2 class="loved-king-font">@lang('pages/crags/tabs/map.titleApproach')</h2>
                @foreach($crag->approaches as $approach)
                    <div class="blue-border-div">
                        <i class="material-icons blue-text left">directions_walk</i>
                        <div class="markdownZone">{{ $approach->description }}</div>
                        <p class="no-margin"><strong>Longueur :</strong> {{ $approach->length }} mètres <span class="grey-text">(environs {{ round($approach->length / 1000 * 60 / 3, 0) }} minutes de marche à 3 Km/h)</span></p>
                        <p class="info-user grey-text">
                            ajouté par <a href="{{ route('userPage', ['user_id'=>$approach->user->id, 'user_label'=>str_slug($approach->user->name)]) }}">{{$approach->user->name}}</a> le {{$approach->created_at->format('d M Y')}}

                            @if(Auth::check())
                                <i {!! $Helpers::tooltip(trans('modals/problem.tooltip')) !!} {!! $Helpers::modal(route('problemModal'), ["id"=>$approach->id, "model"=>"Approach"]) !!} class="material-icons tiny-btn right tooltipped btnModal">flag</i>
                                @if($parking->user_id == Auth::id())
                                    <i {!! $Helpers::tooltip(trans('modals/approach.editTooltip')) !!} {!! $Helpers::modal(route('approachModal'), ["crag_id"=>$crag->id, "approach_id"=>$approach->id, "title"=>trans('modals/approach.modalEditeTitle'), "method" => "PUT"]) !!} class="material-icons tiny-btn right tooltipped btnModal">edit</i>
                                    <i {!! $Helpers::tooltip(trans('modals/approach.deleteTooltip')) !!} {!! $Helpers::modal(route('deleteModal'), ["route"=>"/approaches/" . $approach->id ]) !!} class="material-icons tiny-btn right tooltipped btnModal">delete</i>
                                @endif
                            @endif
                        </p>
                    </div>
                @endforeach

                @if(count($crag->approaches) == 0)
                    <p class="grey-text text-center">@lang('pages/crags/tabs/map.noApproach')</p>
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
                            <li><a {!! $Helpers::tooltip(trans('modals/approach.addTooltip')) !!}} {!! $Helpers::modal(route('approachModal'), ["crag_id"=>$crag->id, "approach_id"=>"", "title"=>trans('modals/approach.modalAddTitle'), "method" => "POST", "lat1"=>$crag->parkings[0]->lat, "lng1"=>$crag->parkings[0]->lng, "lat2"=>$crag->lat, "lng2"=>$crag->lng]) !!} class="tooltipped btn-floating blue btnModal"><i class="material-icons">directions_walk</i></a></li>
                        @else
                            <li><a {!! $Helpers::tooltip(trans('page/crags/tabs/map.informationMinium')) !!}} onclick="alert(trans('page/crags/tabs/map.alertMinium'))" class="tooltipped btn-floating blue"><i class="material-icons">directions_walk</i></a></li>
                        @endif
                        <li><a {!! $Helpers::tooltip(trans('modals/parking.modalAddTitle')) !!}} {!! $Helpers::modal(route('parkingModal'), ["crag_id"=>$crag->id, "parking_id"=>"", "title"=>"Ajouter un parking", "method" => "POST", "lat"=>$crag->lat, "lng"=>$crag->lng]) !!} class="tooltipped btn-floating blue btnModal"><i class="material-icons">local_parking</i></a></li>
                    </ul>
                </div>
            @endif
        </div>
    </div>
</div>