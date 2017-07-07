@inject('Helpers','App\Lib\HelpersTemplates')

<div class="row">
    <div class="col s12">
        <div class="card-panel">

            <div class="row">

                <h2 class="loved-king-font text-center">Topos Papiers</h2>

                @foreach($crag->topos as $liaison)
                    <div class="col s6 m4 l3 topo-panel text-center">
                        @if(file_exists(storage_path('app/public/topos/200/topo-' . $liaison->topo->id.'.jpg')))
                            <img class="responsive-img z-depth-3" alt="couverture du topo {{$liaison->topo->label}}" src="/storage/topos/200/topo-{{$liaison->topo->id}}.jpg">
                        @else
                            <img class="responsive-img z-depth-3" alt="" src="/img/default-topo-couverture.svg">
                        @endif
                        <a href="{{route('topoPage',['topo_id'=>$liaison->topo->id,'topo_label'=>str_slug($liaison->topo->label)])}}"><h5 title="{{$liaison->topo->label}}" class="loved-king-font truncate text-center">{{$liaison->topo->label}}</h5></a>
                    </div>
                @endforeach

                @if(count($crag->topos) == 0)
                    <p class="text-center grey-text">Ce topo n'est pas présent dans un topo papier</p>
                @endif
            </div>

            <div class="row">
                <h2 class="loved-king-font text-center">Topos web</h2>

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
                        <p class="grey-text text-center">Aucun site internet présente le topo de cette falaise</p>
                    @endif
                </div>
            </div>

            <div class="row">
                <h2 class="loved-king-font text-center">Topos PDF</h2>
                <p class="text-center grey-text">Aucun topo PDF n'a été uploadé sur Oblyk</p>
            </div>

            {{--bouton d'ajout--}}
            @if(Auth::check())
                <div class="fixed-action-btn horizontal">
                    <a class="btn-floating btn-large red">
                        <i class="large material-icons">add</i>
                    </a>
                    <ul>
                        <li><a {!! $Helpers::tooltip('Ajouter un topo PDF') !!} class="tooltipped btn-floating blue"><i class="material-icons">picture_as_pdf</i></a></li>
                        <li><a {!! $Helpers::tooltip('Ajouter un topo web') !!} {!! $Helpers::modal(route('topoWebModal'), ["topo_web_id"=>'', "crag_id"=>$crag->id, "title"=>"Ajouter un topo Web", "method"=>"POST"]) !!} class="tooltipped btn-floating blue btnModal"><i class="material-icons">link</i></a></li>
                        <li><a {!! $Helpers::tooltip('Ajouter un topo papier') !!} {!! $Helpers::modal(route('topoCragModal'), ["crag_id"=>$crag->id, "lat"=>$crag->lat, "lng"=>$crag->lng, "rayon"=>50, "title"=>"Lié à un topo papier"]) !!} class="tooltipped btn-floating blue btnModal"><i class="material-icons">import_contacts</i></a></li>
                    </ul>
                </div>
            @endif
        </div>
    </div>
</div>