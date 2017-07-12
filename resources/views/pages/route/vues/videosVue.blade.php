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
                    posté par {{$video->user->name}}<br>
                    @if(Auth::check())
                        <i {!! $Helpers::tooltip('Signaler un problème') !!} {!! $Helpers::modal(route('problemModal'), ["id"=>$video->id, "model"=>"Video"]) !!} class="material-icons tiny-btn tooltipped btnModal" onclick="$('#modal').modal('open');">flag</i>
                        @if(Auth::id() == $video->user_id)
                            <i {!! $Helpers::tooltip('Modifier la vidéo') !!} {!! $Helpers::modal(route('videoModal'), ["viewable_id"=>$route->id, "viewable_type"=>"Crag", "video_id"=>$video->id, "title"=>"Modifier une vidéo", "method"=>"PUT", "callback"=>"reloadRouteVideoTab"]) !!} class="material-icons tiny-btn tooltipped btnModal" onclick="$('#modal').modal('open');">edit</i>
                            <i {!! $Helpers::tooltip('Supprimer la vidéo') !!} {!! $Helpers::modal(route('deleteModal'), ["route"=>"/videos/" . $video->id, "callback"=>"reloadRouteVideoTab"]) !!} class="material-icons tiny-btn tooltipped btnModal" onclick="$('#modal').modal('open');">delete</i>
                        @endif
                    @endif
                </p>
            </div>
        @endforeach
    @else
        <p class="text-center grey-text">Il n'y a pas de vidéo postée sur cette ligne pour l'instant</p>
    @endif
</div>

{{--BOUTON POUR AJOUTER UNE VIDÉO--}}
@if(Auth::check())
    <div class="text-right btn-route-add">
        <a {!! $Helpers::tooltip('Ajouter une vidéo') !!} {!! $Helpers::modal(route('videoModal'), ["viewable_id"=>$route->id, "viewable_type"=>"Route", "video_id"=>'', "title"=>"Ajouter une vidéo", "method"=>"POST", "callback"=>"reloadRouteVideoTab"]) !!} class="btn-floating btn waves-effect waves-light tooltipped btnModal" onclick="$('#modal').modal('open');"><i class="material-icons">add</i></a>
    </div>
@endif