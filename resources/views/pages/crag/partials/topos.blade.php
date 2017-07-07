<div class="col s12 m7">
    <div class="card-panel">
        <h2 class="loved-king-font">Topos papier de ce site :</h2>

        @foreach($crag->topos as $liaison)
            <div class="col s12 m6 l4 topo-panel text-center">
                @if(file_exists(storage_path('app/public/topos/200/topo-' . $liaison->topo->id.'.jpg')))
                    <img class="responsive-img z-depth-3" alt="couverture du topo {{$liaison->topo->label}}" src="/storage/topos/200/topo-{{$liaison->topo->id}}.jpg">
                @else
                    <img class="responsive-img z-depth-3" alt="" src="/img/default-topo-couverture.svg">
                @endif
                <a href="{{route('topoPage',['topo_id'=>$liaison->topo->id,'topo_label'=>str_slug($liaison->topo->label)])}}"><h5 title="{{$liaison->topo->label}}" class="loved-king-font truncate text-center">{{$liaison->topo->label}}</h5></a>
            </div>
        @endforeach
    </div>
</div>
<div class="col s12 m5">
    <div class="card-panel">
        <h2 class="loved-king-font">Topos web</h2>

        <div class="blue-border-zone">
            @foreach($crag->topoWebs as $topoWeb)
                <div class="blue-border-div">
                    <h6>{{$topoWeb->label}}</h6>
                    <a target="_blank" href="{{$topoWeb->url}}">{{$topoWeb->url}}</a>
                    <p class="info-user grey-text">
                        ajouté par {{$topoWeb->user->name}} le {{$topoWeb->created_at->format('d M Y')}}

                        @if(Auth::check())
                            <i {!! $Helpers::tooltip('Signaler un problème') !!} {!! $Helpers::modal(route('problemModal'), ["id"=>$topoWeb->id, "model"=>"TopoWeb"]) !!} class="material-icons tiny-btn right tooltipped btnModal">flag</i>
                            @if($topoWeb->user_id == Auth::id())
                                <i {!! $Helpers::tooltip('Modifier ce topo web') !!} {!! $Helpers::modal(route('topoWebModal'), ["topo_web_id"=>$topoWeb->id, "crag_id"=>$crag->id, "title"=>"Modifier le topo web", "method"=>"PUT"]) !!} class="material-icons tiny-btn right tooltipped btnModal">edit</i>
                                <i {!! $Helpers::tooltip('Supprimer ce topo web') !!} {!! $Helpers::modal(route('deleteModal'), ["route"=>"/topoWebs/" . $topoWeb->id ]) !!} class="material-icons tiny-btn right tooltipped btnModal">delete</i>
                            @endif
                        @endif
                    </p>
                </div>
            @endforeach

            @if(count($crag->topoWebs) == 0)
                <p class="grey-text">Aucun site internet présente le topo de cette falaise</p>
            @endif
        </div>

        <h2 class="loved-king-font">Topos PDF</h2>
        <p>
            liste des topo webs et PDF
        </p>
    </div>
</div>