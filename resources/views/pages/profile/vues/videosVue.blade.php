@inject('Helpers','App\Lib\HelpersTemplates')

<div class="row">
    <div class="col s12">
        <div class="card-panel blue-card-panel">

            @if(Auth::id() == $user->id)
                <h2 class="loved-king-font titre-profile-boite-vue">@lang('pages/profile/video.titleVideoMe')</h2>
            @else
                <h2 class="loved-king-font titre-profile-boite-vue">@lang('pages/profile/video.titleVideoOther', ['name'=>$user->name])</h2>
            @endif

            <div class="row">
                @if(count($user->videos) > 0)
                    @foreach($user->videos as $video)
                        <div class="col s12 m6 l4">
                            <div class="video-container">
                                <iframe width="853" height="480" src="{{$video->iframe}}" allowfullscreen frameborder="0"></iframe>
                            </div>
                            <p class="i-cursor no-margin">
                                {{$video->description}}<br>
                                @if($video->viewable_type == 'App\Crag')
                                    @lang('pages/profile/video.addOn') <a href="{{ \App\Crag::webUrl($video->viewable_id, $video->viewable->label) }}">{{$video->viewable->label}}</a> <br>
                                @endif
                                @if($video->viewable_type == 'App\Route')
                                    @lang('pages/profile/video.addOn') <a class="button-open-route" onclick="loadRoute({{$video->viewable_id}})">{{$video->viewable->label}}</a> <br>
                                @endif
                            </p>
                            <p class="mo-margin grey-text">
                                @if(Auth::check())
                                    <i {!! $Helpers::tooltip(trans('modals/problem.tooltip')) !!} {!! $Helpers::modal(route('problemModal'), ["id"=>$video->id, "model"=>"Video"]) !!} class="material-icons tiny-btn tooltipped btnModal">flag</i>
                                    @if(Auth::id() == $video->user_id)
                                        <i {!! $Helpers::tooltip(trans('modals/video.editTooltip')) !!} {!! $Helpers::modal(route('videoModal'), ["viewable_id"=>$user->id, "viewable_type"=>explode('\\',$video->viewable_type)[1], "video_id"=>$video->id, "title"=>trans('modals/video.modalEditeTitle'), "method"=>"PUT"]) !!} class="material-icons tiny-btn tooltipped btnModal">edit</i>
                                        <i {!! $Helpers::tooltip(trans('modals/video.deleteTooltip')) !!} {!! $Helpers::modal(route('deleteModal'), ["route"=>"/videos/" . $video->id]) !!} class="material-icons tiny-btn tooltipped btnModal">delete</i>
                                    @endif
                                @endif
                            </p>
                        </div>
                    @endforeach
                @else
                    @if(Auth::id() == $user->id)
                        <p class="text-center grey-text">@lang('pages/profile/video.noVideoMe')</p>
                    @else
                        <p class="text-center grey-text">@lang('pages/profile/video.noVideoOther', ['name'=>$user->name])</p>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>