@inject('Helpers','App\Lib\HelpersTemplates')

<input type="hidden" value="{{$topo->id}}" id="id-topo-sites">

<div class="row">
    <div class="col s12">

        <div class="card-panel">

            <p>
                @lang('pages/guidebooks/tabs/buy.intro_1')
            </p>
            <p>
                @lang('pages/guidebooks/tabs/buy.intro_2')
            </p>

            <div class=" blue-border-zone">

                @foreach($topo->sales as $sale)
                    <div class="blue-border-div">
                        <h6>{{$sale->label}}</h6>
                        <a target="_blank" href="{{$sale->url}}">{{$sale->url}}</a>
                        <div class="markdownZone">{{ $sale->description }}</div>
                        <p class="info-user grey-text">
                            @lang('modals/buy.postByDate', ['name'=>$sale->user->name, 'date'=>$sale->created_at->format('d M Y') ,'url'=>route('userPage', ['user_id'=>$sale->user->id, 'user_label'=>str_slug($sale->user->name)])])
                            @if(Auth::check())
                                <i {!! $Helpers::tooltip(trans('modals/problem.tooltip')) !!} {!! $Helpers::modal(route('problemModal'), ["id"=>$sale->id, "model"=>"TopoSale"]) !!} class="material-icons tiny-btn right tooltipped btnModal">flag</i>
                                @if($sale->user_id == Auth::id())
                                    <i {!! $Helpers::tooltip(trans('modals/buy.editTooltip')) !!} {!! $Helpers::modal(route('topoSaleModal'), ["topo_id"=>$topo->id, "id"=>$sale->id, "title"=>trans('modals/buy.modalEditeTitle'), "method"=>"PUT"]) !!} class="material-icons tiny-btn right tooltipped btnModal">edit</i>
                                    <i {!! $Helpers::tooltip(trans('modals/buy.deleteTooltip')) !!} {!! $Helpers::modal(route('deleteModal'), ["route"=>"/topoSales/" . $sale->id ]) !!} class="material-icons tiny-btn right tooltipped btnModal">delete</i>
                                @endif
                            @endif
                        </p>
                    </div>
                @endforeach

                @if(count($topo->sales) == 0)
                    <p class="grey-text text-center">@lang('pages/guidebooks/tabs/buy.noPointOfSale')</p>
                @endif

                {{--BOUTON POUR AJOUTER UN LIEN--}}
                @if(Auth::check())
                    <div class="text-right">
                        <a {!! $Helpers::tooltip(trans('modals/buy.addTooltip')) !!} {!! $Helpers::modal(route('topoSaleModal'), ["topo_id"=>$topo->id, "id"=>"", "title"=>trans('modals/buy.modalAddTitle'), "method"=>"POST" ]) !!} id="description-btn-modal" class="btn-floating btn waves-effect waves-light tooltipped btnModal"><i class="material-icons">add</i></a>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>