<div class="row">
    <div class="col s12">
        <ul class="tabs tabs-fixed-width topo-menu">
            <li class="tab col s2"><a class="router-link active" href="#index"><i class="material-icons">info</i><span>Informations</span></a></li>
            <li class="tab col s2"><a data-route="{{route('vueFilActuTopo',$topo->id)}}" class="router-link" href="#fil-actu"><i class="material-icons">shuffle</i><span>Fil d'actu</span></a><span class="count-tab-ettiquette">0</span></li>
            <li class="tab col s2"><a data-route="{{route('vueAcheterTopo',$topo->id)}}" class="router-link" href="#acheter"><i class="material-icons">euro_symbol</i><span>Acheter</span></a><span class="count-tab-ettiquette">0</span></li>
            <li class="tab col s2"><a data-route="{{route('vueLiensTopo',$topo->id)}}" class="router-link" href="#liens"><i class="material-icons">link</i><span>Liens</span></a><span class="count-tab-ettiquette">{{$topo->links_count}}</span></li>
            <li class="tab col s2"><a data-route="{{route('vueSitesTopo',$topo->id)}}" class="router-link" href="#sites"><i class="material-icons">terrain</i><span>Sites</span></a><span class="count-tab-ettiquette">{{$topo->crags_count}}</span></li>
        </ul>
    </div>
</div>