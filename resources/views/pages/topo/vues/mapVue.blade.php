@inject('Helpers','App\Lib\HelpersTemplates')

<input type="hidden" value="{{$topo->id}}" id="id-topo-sites">

<div class="row">
    <div class="col s12">
        <div class="card-panel">
            <div id="topo-map" class="topo-map">Map</div>
        </div>
    </div>
</div>