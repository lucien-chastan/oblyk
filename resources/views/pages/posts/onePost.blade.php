@inject('Helpers','App\Lib\HelpersTemplates')

{{--LE POST--}}
<div class="markdownZone">@markdown($post->content)</div>
<p class="info-user grey-text">
    posté par <a href="{{route('userPage',['user_id'=>$post->user->id, 'user_label'=>$post->user->name])}}">{{$post->user->name}}</a> le {{$post->created_at->format('d M Y à H:i')}}

    @if(Auth::check())
        @if($post->user_id == Auth::id())
            <i {!! $Helpers::tooltip('Modifier ce post') !!} {!! $Helpers::modal(route('postModal'), ["postable_id"=>$post->postable_id, "postable_type"=>explode('\\',$post->postable_type)[1], "post_id"=>$post->id, "title"=>"Modifier ce post", "method"=>"PUT", "callback"=>"reloadPost"]) !!} class="material-icons tiny-btn right tooltipped btnModal">edit</i>
            <i {!! $Helpers::tooltip('Supprimer ce post') !!} {!! $Helpers::modal(route('deleteModal'), ["route"=>"/posts/" . $post->id, "callback"=>"reloadPost" ]) !!} class="material-icons tiny-btn right tooltipped btnModal">delete</i>
        @else
            <i {!! $Helpers::tooltip('Signaler un problème') !!} {!! $Helpers::modal(route('problemModal'), ["id"=>$post->id, "model"=>"Post"]) !!} class="material-icons tiny-btn right tooltipped btnModal">flag</i>
        @endif
    @endif
</p>


{{--LES COMMENTAIRES--}}
<div class="commentaire-post-zone">
    @foreach($post->descriptions as $commentaire)
        <div class="commentaire-post-div">
            <div class="markdownZone">@markdown($commentaire->description)</div>
            <p class="info-user grey-text">
                <a href="{{route('userPage',['user_id'=>$commentaire->user->id, 'user_label'=>$commentaire->user->name])}}">{{$commentaire->user->name}}</a> le {{$commentaire->created_at->format('d M Y à H:i')}}

                @if(Auth::check())
                    @if($commentaire->user_id == Auth::id())
                        <i {!! $Helpers::tooltip('Modifier ce commentaire') !!} {!! $Helpers::modal(route('descriptionModal'), ["descriptive_id"=>$commentaire->id, "descriptive_type"=>explode('\\',$post->postable_type)[1],"description_id"=>$commentaire->id, "title"=>"Modifier ce commentaire", "method"=>"PUT", "callback"=>"reloadPost"]) !!} class="material-icons tiny-btn right tooltipped btnModal">edit</i>
                        <i {!! $Helpers::tooltip('Supprimer ce commentaire') !!} {!! $Helpers::modal(route('deleteModal'), ["route"=>"/descriptions/" . $commentaire->id , "callback"=>"reloadPost"]) !!} class="material-icons tiny-btn right tooltipped btnModal">delete</i>
                    @else
                        <i {!! $Helpers::tooltip('Signaler un problème sur ce problème') !!} {!! $Helpers::modal(route('problemModal'), ["id"=>$commentaire->id, "model"=>"Description"]) !!} class="material-icons tiny-btn right tooltipped btnModal">flag</i>
                    @endif
                @endif
            </p>
        </div>
    @endforeach

    <p class="comment-btn">
        <a {!! $Helpers::tooltip('Commenter ce post') !!} {!! $Helpers::modal(route('descriptionModal'), ["descriptive_id"=>$post->id, "descriptive_type"=>"Post", "description_id"=>"", "title"=>"Commenter ce post", "method"=>"POST", "callback"=>"reloadPost"]) !!} class="tooltipped btnModal text-cursor"><i class="material-icons tiny-btn left">reply</i> commenter</a>
    </p>

</div>