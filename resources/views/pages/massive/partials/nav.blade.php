<div class="row">
    <div class="col s12">
        <ul class="tabs tabs-fixed-width massive-menu">
            <li class="tab col s2"><a class="router-link active" href="#index"><i class="material-icons">info</i><span>Informations</span></a></li>
            <li class="tab col s2"><a data-route="{{route('vueFilActuMassive',$massive->id)}}" class="router-link" href="#fil-actu" data-callback="getMassivePosts"><i class="material-icons">shuffle</i><span>Fil d'actu</span></a><span class="count-tab-ettiquette">{{$massive->posts_count}}</span></li>
            <li class="tab col s2"><a data-route="{{route('vueLiensMassive',$massive->id)}}" class="router-link" href="#liens"><i class="material-icons">link</i><span>Liens</span></a><span class="count-tab-ettiquette">{{$massive->links_count}}</span></li>
            <li class="tab col s2"><a data-route="{{route('vueSitesMassive',$massive->id)}}" class="router-link" href="#sites"><i class="material-icons">terrain</i><span>Sites</span></a><span class="count-tab-ettiquette">{{$massive->crags_count}}</span></li>
        </ul>
    </div>
</div>