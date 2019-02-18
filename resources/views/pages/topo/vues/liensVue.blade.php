@inject('Helpers','App\Lib\HelpersTemplates')

<div class="row">
    <div class="col s12">

        <div class="card-panel blue-border-zone">

            @foreach($topo->links as $link)
                <div class="blue-border-div">
                    <h6>{{$link->label}}</h6>
                    <a target="_blank" href="{{$link->link}}">{{$link->link}}</a>
                    <div class="markdownZone">{{ $link->description }}</div>
                    <p class="info-user grey-text">
                        @lang('modals/link.postByDate', ['name'=>$link->user->name, 'date'=>$link->created_at->format('d M Y') ,'url'=>$link->user->url()])

                        @if(Auth::check())
                            <i {!! $Helpers::tooltip(trans('modals/problem.tooltip')) !!} {!! $Helpers::modal(route('problemModal'), ["id"=>$link->id, "model"=>"Link"]) !!} class="material-icons tiny-btn right tooltipped btnModal">flag</i>
                            @if($link->user_id == Auth::id())
                                <i {!! $Helpers::tooltip(trans('modals/link.editTooltip')) !!} {!! $Helpers::modal(route('linkModal'), ["linkable_id"=>$topo->id, "linkable_type"=>"Topo", "link_id"=>$link->id, "title"=>trans('modals/link.modalEditeTitle'), "method"=>"PUT"]) !!} class="material-icons tiny-btn right tooltipped btnModal">edit</i>
                                <i {!! $Helpers::tooltip(trans('modals/link.deleteTooltip')) !!} {!! $Helpers::modal(route('deleteModal'), ["route"=>"/links/" . $link->id ]) !!} class="material-icons tiny-btn right tooltipped btnModal">delete</i>
                            @endif
                        @endif
                    </p>
                </div>
            @endforeach

            @if(count($topo->links) == 0)
                <p class="grey-text text-center">@lang('pages/guidebooks/tabs/link.noLink')</p>
            @endif

            {{--BOUTON POUR AJOUTER UN LIEN--}}
            @if(Auth::check())
                <div class="text-right">
                    <a {!! $Helpers::tooltip(trans('modals/link.addTooltip')) !!} {!! $Helpers::modal(route('linkModal'), ["linkable_id"=>$topo->id, "linkable_type"=>"Topo", "link_id"=>"", "title"=>trans('modals/link.modalAddTitle'), "method"=>"POST" ]) !!} id="description-btn-modal" class="btn-floating btn waves-effect waves-light tooltipped btnModal"><i class="material-icons">add</i></a>
                </div>
            @endif
        </div>
    </div>
</div>