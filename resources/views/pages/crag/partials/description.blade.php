<div class="col s12">
    <div class="card-panel">
        <h2 class="loved-king-font">@lang('pages/crags/tabs/informations.titleDescription')</h2>

        <div class="blue-border-zone">
            @foreach ($crag->descriptions as $description)
                <div class="blue-border-div">
                    <div class="markdownZone">{{ $description->description }}</div>
                    <p class="info-user grey-text">
                        @lang('modals/description.postByDate', ['name'=>$description->user->name, 'url'=>$description->user->url(), 'date'=>$description->created_at->format('d M Y')])
                        @if(Auth::check())
                            <i {!! $Helpers::tooltip(trans('modals/problem.tooltip')) !!} {!! $Helpers::modal(route('problemModal'), ["id" => $description->id , "model"=> "Description"]) !!} class="material-icons tiny-btn right tooltipped btnModal">flag</i>
                            @if($description->user_id == Auth::id())
                                <i {!! $Helpers::tooltip(trans('modals/description.editTooltip')) !!} {!! $Helpers::modal(route('descriptionModal'), ["descriptive_id"=>$crag->id, "descriptive_type"=>"Crag", "description_id"=>$description->id, "title"=> trans('modals/description.modalEditeTitle'), "method" => "PUT"]) !!} class="material-icons tiny-btn right tooltipped btnModal">edit</i>
                                <i {!! $Helpers::tooltip(trans('modals/description.deleteTooltip')) !!} {!! $Helpers::modal(route('deleteModal'), ["route" => "/descriptions/".$description->id]) !!} class="material-icons tiny-btn right tooltipped btnModal">delete</i>
                            @endif
                        @endif
                    </p>
                </div>
            @endforeach

            @if(count($crag->descriptions) == 0)
                <p class="grey-text text-center">@lang('pages/crags/tabs/informations.paraNoDescription')</p>
            @endif

        </div>

        {{--BOUTON POUR AJOUTER UNE DESCRIPTION--}}
        @if(Auth::check())
            <div class="text-right">
                <a {!! $Helpers::tooltip(trans('modals/description.addTooltip')) !!} {!! $Helpers::modal(route('descriptionModal'), ["descriptive_id"=>$crag->id, "descriptive_type"=>"Crag", "description_id"=>"", "title"=>trans('modals/description.modalAddTitle'), "method"=>"POST"]) !!} id="description-btn-modal"  class="btn-floating btn waves-effect waves-light tooltipped btnModal"><i class="material-icons">mode_edit</i></a>
            </div>
        @endif
    </div>
</div>