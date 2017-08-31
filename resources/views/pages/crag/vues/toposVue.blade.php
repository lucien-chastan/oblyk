@inject('Helpers','App\Lib\HelpersTemplates')

<div class="row">
    <div class="col s12">
        <div class="card-panel">



            {{--TOPO PAPIER--}}
            <div class="row">

                <h2 class="loved-king-font text-center">@lang('pages/crags/tabs/guidebook.paperGuideBookTitle')</h2>

                @foreach($crag->topos as $liaison)
                    <div class="col s6 m4 l3 topo-panel text-center">
                        @if(file_exists(storage_path('app/public/topos/200/topo-' . $liaison->topo->id.'.jpg')))
                            <img class="responsive-img z-depth-3" alt="couverture du topo {{$liaison->topo->label}}" src="/storage/topos/200/topo-{{$liaison->topo->id}}.jpg">
                        @else
                            <img class="responsive-img z-depth-3" alt="" src="/img/default-topo-couverture.svg">
                        @endif
                        <a href="{{route('topoPage',['topo_id'=>$liaison->topo->id,'topo_label'=>str_slug($liaison->topo->label)])}}"><h5 title="{{$liaison->topo->label}}" class="loved-king-font truncate text-center">{{$liaison->topo->label}}</h5></a>
                    </div>
                @endforeach

                @if(count($crag->topos) == 0)
                    <p class="text-center grey-text">@lang('pages/crags/tabs/guidebook.noPaperGuideBook')</p>
                @endif
            </div>





            {{--TOPO WEB--}}
            <div class="row">
                <h2 class="loved-king-font text-center">@lang('pages/crags/tabs/guidebook.webGuideBookTitle')</h2>

                <div class="blue-border-zone">

                    @foreach($crag->topoWebs as $topoWeb)
                        <div class="blue-border-div">
                            <h6>{{$topoWeb->label}}</h6>
                            <a target="_blank" href="{{$topoWeb->url}}">{{$topoWeb->url}}</a>
                            <p class="info-user grey-text">
                                @lang('modals/webGuideBook.postByDate', ['url'=>route('userPage', ['user_id'=>$topoWeb->user->id, 'user_label'=>str_slug($topoWeb->user->name)]), 'name'=>$topoWeb->user->name, 'date'=>$topoWeb->created_at->format('d M Y')])
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
                        <p class="grey-text text-center">@lang('pages/crags/tabs/guidebook.noWebGuideBook')</p>
                    @endif
                </div>
            </div>




            {{--TOPO PDF--}}
            <div class="row">
                <h2 class="loved-king-font text-center">@lang('pages/crags/tabs/guidebook.pdfGuideBookTitle')</h2>
                <div class="blue-border-zone">

                    @foreach($crag->topoPdfs as $topoPdf)
                        <div class="blue-border-div">
                            <h6 class="text-bold">{{$topoPdf->label}}</h6>
                            <div class="markdownZone">{{$topoPdf->description}}</div>
                            @lang('pages/crags/tabs/guidebook.file') <a target="_blank" href="/storage/topos/PDF/{{$topoPdf->slug_label}}">{{$topoPdf->slug_label}}</a>
                            <p class="info-user grey-text">
                                @lang('modals/pdfGuideBook.postByDate', ['url'=>route('userPage', ['user_id'=>$topoPdf->user->id, 'user_label'=>str_slug($topoPdf->user->name)]), 'name'=>$topoPdf->user->name, 'date'=>$topoPdf->created_at->format('d M Y')])
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
                        <p class="grey-text text-center">@lang('pages/crags/tabs/guidebook.noPdfGuideBook')</p>
                    @endif
                </div>
            </div>




            {{--BOUTON D'AJOUT--}}
            @if(Auth::check())
                <div class="fixed-action-btn horizontal">
                    <a class="btn-floating btn-large red">
                        <i class="large material-icons">add</i>
                    </a>
                    <ul>
                        <li><a {!! $Helpers::tooltip(trans('modals/pdfGuideBook.addTooltip')) !!} {!! $Helpers::modal(route('topoPdfModal'), ["topo_pdf_id"=>'', "crag_id"=>$crag->id, "title"=>trans('modals/pdfGuideBook.modalAddTitle'), "method"=>"POST"]) !!} class="tooltipped btn-floating blue btnModal"><i class="material-icons">picture_as_pdf</i></a></li>
                        <li><a {!! $Helpers::tooltip(trans('modals/webGuideBook.addTooltip')) !!} {!! $Helpers::modal(route('topoWebModal'), ["topo_web_id"=>'', "crag_id"=>$crag->id, "title"=>trans('modals/webGuideBook.modalAddTitle'), "method"=>"POST"]) !!} class="tooltipped btn-floating blue btnModal"><i class="material-icons">link</i></a></li>
                        <li><a {!! $Helpers::tooltip(trans('modals/paperGuideBook.addTooltip')) !!} {!! $Helpers::modal(route('topoCragModal'), ["crag_id"=>$crag->id, "lat"=>$crag->lat, "lng"=>$crag->lng, "rayon"=>50, "title"=>trans('modals/paperGuideBook.modalAddTitle')]) !!} class="tooltipped btn-floating blue btnModal"><i class="material-icons">import_contacts</i></a></li>
                    </ul>
                </div>
            @endif
        </div>
    </div>
</div>