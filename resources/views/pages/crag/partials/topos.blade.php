<div class="col s12 m7">
    <div class="card-panel">
        <h2 class="loved-king-font">@lang('pages/crags/tabs/informations.paperGuideBookTitle')</h2>

        @foreach($crag->topos as $liaison)
            <div class="col s12 m6 l4 topo-panel text-center">
                @if(file_exists(storage_path('app/public/topos/200/topo-' . $liaison->topo->id.'.jpg')))
                    <img class="responsive-img z-depth-3" alt="couverture du topo {{ $liaison->topo->label }}" src="/storage/topos/200/topo-{{ $liaison->topo->id }}.jpg">
                @else
                    <img class="responsive-img z-depth-3" alt="" src="/img/default-topo-couverture.svg">
                @endif
                <a href="{{ $liaison->topo->url() }}"><h5 title="{{ $liaison->topo->label }}" class="loved-king-font truncate text-center">{{ $liaison->topo->label }}</h5></a>
            </div>
        @endforeach

        @if(count($crag->topos) == 0)
            <p class="grey-text text-center">@lang('pages/crags/tabs/informations.paraNoPaperGuideBook')</p>
        @endif
    </div>
</div>
<div class="col s12 m5">
    <div class="card-panel">
        <h2 class="loved-king-font">@lang('pages/crags/tabs/informations.webGuideBookTitle')</h2>

        <div class="blue-border-zone">
            @foreach($crag->topoWebs as $topoWeb)
                <div class="blue-border-div">
                    <h6>{{$topoWeb->label}}</h6>
                    <a class="truncate" target="_blank" href="{{$topoWeb->url}}">{{$topoWeb->url}}</a>
                    <p class="info-user grey-text">
                        @lang('modals/webGuideBook.postByDate', ['name'=>$topoWeb->user->name, 'url'=> $topoWeb->user->url(), 'date'=>$topoWeb->created_at->format('d M Y')])
                        @if(Auth::check())
                            <i {!! $Helpers::tooltip(trans('modals/problem.tooltip')) !!} {!! $Helpers::modal(route('problemModal'), ["id"=>$topoWeb->id, "model"=>"TopoWeb"]) !!} class="material-icons tiny-btn right tooltipped btnModal">flag</i>
                            @if($topoWeb->user_id == Auth::id())
                                <i {!! $Helpers::tooltip(trans('modals/webGuideBook.editTooltip')) !!} {!! $Helpers::modal(route('topoWebModal'), ["topo_web_id"=>$topoWeb->id, "crag_id"=>$crag->id, "title"=>trans('modals/webGuideBook.modalEditeTitle'), "method"=>"PUT"]) !!} class="material-icons tiny-btn right tooltipped btnModal">edit</i>
                                <i {!! $Helpers::tooltip(trans('modals/webGuideBook.deleteTooltip')) !!} {!! $Helpers::modal(route('deleteModal'), ["route"=>"/topoWebs/" . $topoWeb->id ]) !!} class="material-icons tiny-btn right tooltipped btnModal">delete</i>
                            @endif
                        @endif
                    </p>
                </div>
            @endforeach

            @if(count($crag->topoWebs) == 0)
                <p class="grey-text">@lang('pages/crags/tabs/informations.paraNoWebGuideBook')</p>
            @endif
        </div>

        <h2 class="loved-king-font">@lang('pages/crags/tabs/informations.pdfGuideBookTitle')</h2>
        <div class="blue-border-zone">

            @foreach($crag->topoPdfs as $topoPdf)
                <div class="blue-border-div">
                    <h6 class="text-bold">{{$topoPdf->label}}</h6>
                    Fichier : <a target="_blank" href="/storage/topos/PDF/{{$topoPdf->slug_label}}">{{$topoPdf->slug_label}}</a>
                    <p class="info-user grey-text">
                        ajouté par {{$topoPdf->user->name}} le {{$topoPdf->created_at->format('d M Y')}}

                        @if(Auth::check())
                            <i {!! $Helpers::tooltip(trans('modals/problem.tooltip')) !!} {!! $Helpers::modal(route('problemModal'), ["id"=>$topoPdf->id, "model"=>"TopoPdf"]) !!} class="material-icons tiny-btn right tooltipped btnModal">flag</i>
                            @if($topoPdf->user_id == Auth::id())
                                <i {!! $Helpers::tooltip(trans('modals/pdfGuideBook.editTooltip')) !!} {!! $Helpers::modal(route('topoPdfModal'), ["topo_pdf_id"=>$topoPdf->id, "crag_id"=>$crag->id, "title"=>trans('modals/pdfGuideBook.modalEditeTitle'), "method"=>"PUT"]) !!} class="material-icons tiny-btn right tooltipped btnModal">edit</i>
                                <i {!! $Helpers::tooltip(trans('modals/pdfGuideBook.deleteTooltip')) !!} {!! $Helpers::modal(route('deleteModal'), ["route"=>"/topoPdfs/" . $topoPdf->id ]) !!} class="material-icons tiny-btn right tooltipped btnModal">delete</i>
                            @endif
                        @endif
                    </p>
                </div>
            @endforeach

            @if(count($crag->topoPdfs) == 0)
                <p class="grey-text text-center">@lang('pages/crags/tabs/informations.paraNoPdfGuideBook')</p>
            @endif
        </div>
    </div>
</div>