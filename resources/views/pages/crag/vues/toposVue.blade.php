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
                <p class="text-center grey-text">Aucun site internet présente le topo de cette falaise</p>
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
                        <li><a {!! $Helpers::tooltip('Ajouter un topo web') !!} class="tooltipped btn-floating blue"><i class="material-icons">link</i></a></li>
                        <li><a {!! $Helpers::tooltip('Ajouter un topo papier') !!} {!! $Helpers::modal(route('topoCragModal'), ["crag_id"=>$crag->id, "lat"=>$crag->lat, "lng"=>$crag->lng, "rayon"=>50, "title"=>"Lié à un topo papier"]) !!} class="tooltipped btn-floating blue btnModal"><i class="material-icons">import_contacts</i></a></li>
                    </ul>
                </div>
            @endif
        </div>
    </div>
</div>