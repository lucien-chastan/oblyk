@inject('Helpers','App\Lib\HelpersTemplates')

<div class="row">

    @if(count($route->videos) > 0)
        @foreach($route->videos as $video)
            <div class="col s12">
                <div class="video-container">
                    <iframe width="853" height="480" src="{{$video->iframe}}" allowfullscreen frameborder="0"></iframe>
                </div>
                <p class="i-cursor">
                    {{$video->description}}<br>
                    @lang('modals/video.postByDate', ['name'=>$video->user->name, 'date' => $video->created_at->format('d-M-Y H:i'), 'url'=>route('userPage', ['user_id'=>$video->user->id, 'user_label'=>str_slug($video->user->name)])])
                    <br>
                    @if(Auth::check())
                        <i {!! $Helpers::tooltip(trans('modals/problem.tooltip')) !!} {!! $Helpers::modal(route('problemModal'), ["id"=>$video->id, "model"=>"Video"]) !!} class="material-icons tiny-btn tooltipped btnModal" onclick="$('#modal').modal('open');">flag</i>
                        @if(Auth::id() == $video->user_id)
                            <i {!! $Helpers::tooltip(trans('modals/video.editTooltip')) !!} {!! $Helpers::modal(route('videoModal'), ["viewable_id"=>$route->id, "viewable_type"=>"Crag", "video_id"=>$video->id, "title"=>trans('modals/video.modalEditeTitle'), "method"=>"PUT", "callback"=>"reloadRouteVideoTab"]) !!} class="material-icons tiny-btn tooltipped btnModal" onclick="$('#modal').modal('open');">edit</i>
                            <i {!! $Helpers::tooltip(trans('modals/video.deleteTooltip')) !!} {!! $Helpers::modal(route('deleteModal'), ["route"=>"/videos/" . $video->id, "callback"=>"reloadRouteVideoTab"]) !!} class="material-icons tiny-btn tooltipped btnModal" onclick="$('#modal').modal('open');">delete</i>
                        @endif
                    @endif
                </p>
            </div>
        @endforeach
    @else
        <p class="text-center grey-text">@lang('pages/routes/tabs/video.noVideo')</p>
    @endif
</div>

{{--BOUTON POUR AJOUTER UNE VIDÉO--}}
@if(Auth::check())
    <div class="text-right btn-route-add">
        <a {!! $Helpers::tooltip(trans('modals/video.addTooltip')) !!} {!! $Helpers::modal(route('videoModal'), ["viewable_id"=>$route->id, "viewable_type"=>"Route", "video_id"=>'', "title"=>trans('modals/video.modalAddTitle'), "method"=>"POST", "callback"=>"reloadRouteVideoTab"]) !!} class="btn-floating btn waves-effect waves-light tooltipped btnModal" onclick="$('#modal').modal('open');"><i class="material-icons">add</i></a>
    </div>
@endif