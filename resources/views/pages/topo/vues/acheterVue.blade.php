@inject('Helpers','App\Lib\HelpersTemplates')

<input type="hidden" value="{{$topo->id}}" id="id-topo-sites">

<div class="row">
    <div class="col s12">

        <div class="card-panel">


            <p>
                Liste des points de vente existants qui ont été ajoutés pour ce topo. Si tu en connais d'autres qui ne figurent pas dans cette liste, tu peux en saisir un ou des nouveau(x).
            </p>
            <p>
                On encourage vivement l'achat directement chez l'éditeur, où dans les points de vente proches des sites qui y figurent.
            </p>

            <div class=" blue-border-zone">

                @foreach($topo->sales as $sale)
                    <div class="blue-border-div">
                        <h6>{{$sale->label}}</h6>
                        <a target="_blank" href="{{$sale->url}}">{{$sale->url}}</a>
                        <div class="markdownZone">{{ $sale->description }}</div>
                        <p class="info-user grey-text">
                            ajouté par {{$sale->user->name}} le {{$sale->created_at->format('d M Y')}}

                            @if(Auth::check())
                                <i {!! $Helpers::tooltip('Signaler un problème') !!} {!! $Helpers::modal(route('problemModal'), ["id"=>$sale->id, "model"=>"TopoSale"]) !!} class="material-icons tiny-btn right tooltipped btnModal">flag</i>
                                @if($sale->user_id == Auth::id())
                                    <i {!! $Helpers::tooltip('Modifier ce point de vente') !!} {!! $Helpers::modal(route('topoSaleModal'), ["topo_id"=>$topo->id, "id"=>$sale->id, "title"=>"Modifier le point de vente", "method"=>"PUT"]) !!} class="material-icons tiny-btn right tooltipped btnModal">edit</i>
                                    <i {!! $Helpers::tooltip('Supprimer ce point de vente') !!} {!! $Helpers::modal(route('deleteModal'), ["route"=>"/topoSales/" . $sale->id ]) !!} class="material-icons tiny-btn right tooltipped btnModal">delete</i>
                                @endif
                            @endif
                        </p>
                    </div>
                @endforeach

                @if(count($topo->sales) == 0)
                    <p class="grey-text text-center">Il n'y a pas encore de point de vente posté sur ce topo</p>
                @endif

                {{--BOUTON POUR AJOUTER UN LIEN--}}
                @if(Auth::check())
                    <div class="text-right">
                        <a {!! $Helpers::tooltip('Ajouter un lien') !!} {!! $Helpers::modal(route('topoSaleModal'), ["topo_id"=>$topo->id, "id"=>"", "title"=>"Ajouter un point de vente", "method"=>"POST" ]) !!} id="description-btn-modal" class="btn-floating btn waves-effect waves-light tooltipped btnModal"><i class="material-icons">add</i></a>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>