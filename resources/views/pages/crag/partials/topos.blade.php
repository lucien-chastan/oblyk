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
        <h2 class="loved-king-font">Topos web / PDF</h2>
        <p>
            liste des topo webs et PDF
        </p>
    </div>
</div>