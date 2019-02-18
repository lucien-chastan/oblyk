@inject('Helpers','App\Lib\HelpersTemplates')

<div class="blue-border-zone">
    @foreach ($sector->descriptions as $description)
        <div class="blue-border-div">
            <div class="markdownZone">{{ $description->description }}</div>
            <p class="info-user grey-text">
                @lang('modals/description.postByDate', ['name'=>$description->user->name, 'url'=>$description->user->url(), 'date'=>$description->created_at->format('d M Y')])

                @if(Auth::check())
                    <i {!! $Helpers::tooltip(trans('modals/problem.tooltip')) !!} {!! $Helpers::modal(route('problemModal'), ["id" => $description->id , "model"=> "Description"]) !!} class="material-icons tiny-btn right tooltipped btnModal">flag</i>
                    @if($description->user_id == Auth::id())
                        <i {!! $Helpers::tooltip(trans('modals/description.editTooltip')) !!} {!! $Helpers::modal(route('descriptionModal'), ["descriptive_id"=>$sector->id, "descriptive_type"=>'Sector', "description_id"=>$description->id, "title"=>trans('modals/description.modalEditeTitle'), "method" => "PUT", "callback"=>"reloadDescriptionSector"]) !!} class="material-icons tiny-btn right tooltipped btnModal">edit</i>
                        <i {!! $Helpers::tooltip(trans('modals/description.deleteTooltip')) !!} {!! $Helpers::modal(route('deleteModal'), ["route" => "/descriptions/".$description->id, "callback"=>"reloadDescriptionSector"]) !!} class="material-icons tiny-btn right tooltipped btnModal">delete</i>
                    @endif
                @endif
            </p>
        </div>
    @endforeach

    @if(count($sector->descriptions) == 0)
        <p class="grey-text text-center">@lang('pages/crags/tabs/sectors/tabs/description.noDescription')</p>
    @endif

</div>

{{--BOUTON POUR AJOUTER UNE DESCRIPTION--}}
@if(Auth::check())
    <div class="text-right">
        <a {!! $Helpers::tooltip(trans('modals/description.addTooltip')) !!} {!! $Helpers::modal(route('descriptionModal'), ["descriptive_id"=>$sector->id, "descriptive_type"=>'Sector', "description_id"=>"", "title"=>trans('modals/description.modalAddTitle'), "method"=>"POST", "callback"=>"reloadDescriptionSector"]) !!} class="btn-floating btn waves-effect waves-light tooltipped btnModal"><i class="material-icons">mode_edit</i></a>
    </div>
@endif