@if(count($topos) > 0)
    <table class="bordered">
        <thead>
            <tr>
                <th></th>
                <th>Titre</th>
                <th>Année</th>
                <th>Lien</th>
            </tr>
        </thead>
        <tbody>
            @foreach($topos as $topo)
            <tr>
                <td class="couverture-zone-liste-topo text-center">
                    @if(file_exists(storage_path('app/public/topos/200/topo-' . $topo->id . '.jpg')))
                        <img class="responsive-img z-depth-2" alt="couverture du topo {{$topo->label}}" src="/storage/topos/200/topo-{{$topo->id}}.jpg">
                    @else
                        <img class="responsive-img z-depth-2" alt="" src="/img/default-topo-couverture.svg">
                    @endif
                </td>
                <td onclick="selectTopo({{$topo->id}})"><a class="btn-flat waves-effect">{{$topo->label}}</a></td>
                <td>{{$topo->editionYear}}</td>
                <td><a target="_blank" href="{{route('topoPage',['topo_id'=>$topo->id,'topo_label'=>str_slug($topo->label)])}}">voir le topo</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p class="text-center grey-text">
        il n'y a pas de topo dans les {{$rayon}} Km autour de ce site<br>
        Tu peux élargire la zone de recherche ou créer un nouveau topo
    </p>
@endif

<p class="text-right">
    <a class="btn waves-effect" onclick="getTopoArround()">Élargir la recherche à {{$rayon + 50}} Km</a>
</p>
