@inject('Helpers','App\Lib\HelpersTemplates')

<div class="row">
    <div class="col s12">

        <div class="card-panel">

            <table class="responsive-table striped">
                <thead>
                    <tr>
                        <th></th>
                        <th>Nom</th>
                        <th>Pays</th>
                        <th>Département</th>
                        <th>Ville</th>
                        <th>Rocher</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($topo->crags as $liaison)
                        <tr>
                            <td class="text-center"><img src="/img/point-{{$liaison->crag->type_voie . $liaison->crag->type_grande_voie . $liaison->crag->type_bloc . $liaison->crag->type_deep_water . $liaison->crag->type_via_ferrata }}.svg" height="15" alt=""></td>
                            <td><a href="{{route('cragPage',['crag_id' => $liaison->crag->id, 'crag_label' => str_slug($liaison->crag->label)])}}">{{$liaison->crag->label}}</a></td>
                            <td>{{$liaison->crag->code_country}}</td>
                            <td>{{$liaison->crag->region}}</td>
                            <td>{{$liaison->crag->city}}</td>
                            <td>{{ucfirst($liaison->crag->rock->label)}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>

<div class="row">
    <div class="col s12">

        <div class="card-panel">
            <div id="topo-map" class="topo-map">Map</div>
        </div>
    </div>
</div>