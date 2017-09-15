<div class="row">
    <div class="col s12">
        <ul class="tabs tabs-fixed-width topo-menu">
            <li class="tab col s2"><a class="router-link active" href="#index"><i class="material-icons">info</i><span>@lang('pages/guidebooks/global.informationTab')</span></a></li>
            <li class="tab col s2"><a data-route="{{route('vueFilActuTopo',$topo->id)}}" data-callback="getTopoPosts" class="router-link" href="#fil-actu"><i class="material-icons">shuffle</i><span>@lang('pages/guidebooks/global.newsFeedTab')</span></a><span class="count-tab-ettiquette">{{$topo->posts_count}}</span></li>
            <li class="tab col s2"><a data-route="{{route('vueAcheterTopo',$topo->id)}}" class="router-link" href="#acheter"><i class="material-icons">euro_symbol</i><span>@lang('pages/guidebooks/global.buyTab')</span></a><span class="count-tab-ettiquette">{{$topo->sales_count}}</span></li>
            <li class="tab col s2"><a data-route="{{route('vueLiensTopo',$topo->id)}}" class="router-link" href="#liens"><i class="material-icons">link</i><span>@lang('pages/guidebooks/global.linksTab')</span></a><span class="count-tab-ettiquette">{{$topo->links_count}}</span></li>
            <li class="tab col s2"><a data-route="{{route('vueSitesTopo',$topo->id)}}" class="router-link" href="#sites"><i class="material-icons">terrain</i><span>@lang('pages/guidebooks/global.cragsTab')</span></a><span class="count-tab-ettiquette">{{$topo->crags_count}}</span></li>
            <li class="tab col s2"><a data-route="{{route('vueMapTopo',$topo->id)}}" data-callback="initTopoMap" class="router-link" href="#map"><i class="material-icons">@lang('pages/guidebooks/global.mapTab')</i><span>Map</span></a><span class="count-tab-ettiquette">{{$topo->crags_count + $topo->sales_count}}</span></li>
        </ul>
    </div>
</div>