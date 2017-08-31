@inject('Helpers','App\Lib\HelpersTemplates')

<div class="row">
    <div class="col s12">
        <div class="card-panel">

            <div id="zone-crag-gallerie">

                <h2 class="loved-king-font text-center">@lang('pages/crags/tabs/media.titlePhotoCrag')</h2>

                <div class="row row-crag-gallerie">
                    <div id="cragPhototheque" class="phototheque">
                        @foreach($crag->photos as $photo)
                            <img data-full="/storage/photos/crags/1300/{{$photo->slug_label}}" data-legende="{{$photo->description}}<br>posté sur : <a href='/site-escalade/{{$crag->id}}/{{str_slug($crag->label)}}'>{{$crag->label}}</a> par <a>{{$photo->user_id}}</a>" alt="{{$crag->label}} - {{$photo->description}}" src="/storage/photos/crags/200/{{$photo->slug_label}}">
                        @endforeach
                    </div>
                </div>
            </div>

            @if(Auth::check())

                <div class="row" id="bt-show-crag-gallerie-editor">
                    <div class="info-user grey-text i-cursor">
                        <i {!! $Helpers::tooltip(trans('pages/crags/tabs/media.tooltipEditDeleteReport')) !!} onclick="showPhotoEditor(true)" class="material-icons tiny-btn right tooltipped">edit</i>
                    </div>
                </div>

                <div class="row zone-photo-editor" id="zone-photo-editor">

                    <h2 class="loved-king-font text-center">@lang('pages/crags/tabs/media.titleActionPhoto')</h2>

                    <div class="row">
                        @foreach($crag->photos as $photo)
                            <div class="col s6 m4 l3 text-center">
                                <div class="card">
                                    <div class="card-image">
                                        <img alt="{{$crag->label}} - {{$photo->description}}" style="height: 100px; object-fit: cover" src="/storage/photos/crags/200/{{$photo->slug_label}}">
                                    </div>
                                    <div class="card-content i-cursor">
                                        <p>
                                            <i {!! $Helpers::tooltip(trans('modals/photo.headbandTooltip')) !!} {!! $Helpers::modal(route('bandeauModal'), ["photo_id"=>$photo->id, "crag_id"=>$crag->id]) !!} class="material-icons tiny-btn tooltipped btnModal">wallpaper</i>
                                            <i {!! $Helpers::tooltip(trans('modals/problem.tooltip')) !!} {!! $Helpers::modal(route('problemModal'), ["id"=>$photo->id, "model"=>"Photo"]) !!} class="material-icons tiny-btn tooltipped btnModal">flag</i>
                                            @if(Auth::id() == $photo->user_id)
                                                <i {!! $Helpers::tooltip(trans('modals/photo.editTooltip')) !!} {!! $Helpers::modal(route('photoModal'), ["illustrable_id"=>$crag->id, "illustrable_type"=>"Crag", "photo_id"=>$photo->id, "title"=>trans('modals/photo.modalEditeTitle'), "method"=>"PUT"]) !!} class="material-icons tiny-btn tooltipped btnModal">edit</i>
                                                <i {!! $Helpers::tooltip(trans('modals/photo.deleteTooltip')) !!} {!! $Helpers::modal(route('deleteModal'), ["route"=>"/photos/" . $photo->id]) !!} class="material-icons tiny-btn tooltipped btnModal">delete</i>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="row">
                        <div class="info-user grey-text i-cursor col s12">
                            <i {!! $Helpers::tooltip(trans('pages/crags/tabs/media.tooltipCloseEdit')) !!} onclick="showPhotoEditor(false)" class="material-icons tiny-btn right tooltipped">clear</i>
                        </div>
                    </div>
                </div>
            @endif

            <h2 class="loved-king-font text-center">@lang('pages/crags/tabs/media.titleVideosCrag')</h2>

            <div class="row">

                @if(count($crag->videos) > 0)
                    @foreach($crag->videos as $video)
                        <div class="col s12 m6 l6">
                            <div class="video-container">
                                <iframe width="853" height="480" src="{{$video->iframe}}" allowfullscreen frameborder="0"></iframe>
                            </div>
                            <p class="i-cursor">
                                {{$video->description}}<br>
                                @lang('modals/video.postByDate', ['url'=>route('userPage',['user_id'=>$video->user->id, 'user_label'=>str_slug($video->user->name)]), 'name'=>$video->user->name, 'date'=>$video->created_at->format('D M Y')])
                                @if(Auth::check())
                                    <i {!! $Helpers::tooltip(trans('modals/problem.tooltip')) !!} {!! $Helpers::modal(route('problemModal'), ["id"=>$video->id, "model"=>"Video"]) !!} class="material-icons tiny-btn tooltipped btnModal">flag</i>
                                    @if(Auth::id() == $video->user_id)
                                        <i {!! $Helpers::tooltip(trans('modals/video.editTooltip')) !!} {!! $Helpers::modal(route('videoModal'), ["viewable_id"=>$crag->id, "viewable_type"=>"Crag", "video_id"=>$video->id, "title"=>trans('modals/video.modalEditeTitle'), "method"=>"PUT"]) !!} class="material-icons tiny-btn tooltipped btnModal">edit</i>
                                        <i {!! $Helpers::tooltip(trans('modals/video.deleteTooltip')) !!} {!! $Helpers::modal(route('deleteModal'), ["route"=>"/videos/" . $video->id]) !!} class="material-icons tiny-btn tooltipped btnModal">delete</i>
                                    @endif
                                @endif
                            </p>
                        </div>
                    @endforeach
                @else
                    <p class="text-center grey-text">@lang('pages/crags/tabs/media.paraNoVideo')</p>
                @endif
            </div>

            {{--bouton d'ajout--}}
            @if(Auth::check())
                <div class="fixed-action-btn horizontal">
                    <a class="btn-floating btn-large red">
                        <i class="large material-icons">add</i>
                    </a>
                    <ul>
                        <li><a {!! $Helpers::tooltip(trans('modals/photo.addTooltip')) !!} {!! $Helpers::modal(route('photoModal'), ["illustrable_id"=>$crag->id, "illustrable_type"=>"Crag", "photo_id"=>'', "title"=>trans('modals/photo.modalAddTitle'), "method"=>"POST"]) !!} class="tooltipped btn-floating blue btnModal"><i class="material-icons">photo_camera</i></a></li>
                        <li><a {!! $Helpers::tooltip(trans('modals/video.addTooltip')) !!} {!! $Helpers::modal(route('videoModal'), ["viewable_id"=>$crag->id, "viewable_type"=>"Crag", "video_id"=>'', "title"=>trans('modals/video.modalAddTitle'), "method"=>"POST"]) !!} class="tooltipped btn-floating blue btnModal"><i class="material-icons">videocam</i></a></li>
                    </ul>
                </div>
            @endif
        </div>
    </div>
</div>