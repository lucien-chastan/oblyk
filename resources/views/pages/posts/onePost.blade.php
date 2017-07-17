@inject('Helpers','App\Lib\HelpersTemplates')

{{--LE POST--}}
<div class="post-title-barre">

    @if($postable_type == 'App\User' && $postable_id == Auth::id())
        @if($last_read < $post->created_at)
            <span class="badge new red"></span>
        @endif
    @endif

    {{--IMAGE DE L'ÉLEMENT--}}
    @if($post->postable_type == 'App\\Crag')
        @if(($post->postable->bandeau == "/img/default-crag-bandeau.jpg"))
            <img src="/img/icon-search-crag.svg" class="circle left" alt="">
        @else
            <img src="{{str_replace("1300", "50", $post->postable->bandeau)}}" class="circle left" alt="">
        @endif
    @elseif($post->postable_type == 'App\\Topo')
        @if(file_exists(storage_path('app/public/topos/50/topo-' . $post->postable->id . '.jpg')))
            <img src="/storage/topos/50/topo-{{$post->postable->id}}.jpg" class="couverture-topo left" alt="">
        @else
            <img src="/img/default-topo-couverture.svg" class="couverture-topo left" alt="">
        @endif
    @elseif($post->postable_type == 'App\\Massive')
        <img src="/img/icon-search-massive.svg" class="circle left" alt="">
    @elseif($post->postable_type == 'App\\User')
        @if(file_exists(storage_path('app/public/users/50/user-' . $post->postable->id . '.jpg')))
            <img src="/storage/users/50/user-{{$post->postable->id}}.jpg" class="circle left" alt="">
        @else
            <img src="/img/icon-search-user.svg" class="circle left" alt="">
        @endif
    @endif

    {{--INFORMATION SUR L'ÉLÉMENT--}}
    <p>
        @if($post->postable_type == 'App\\Crag')
            <a class="lien-title-post" href="{{route('cragPage',['crag_id'=>$post->postable->id, 'crag_label'=>str_slug($post->postable->label)])}}">{{$post->postable->label}}</a> <span class="grey-text">{{$post->postable->region}}, ({{$post->postable->code_country}})</span>
        @elseif($post->postable_type == 'App\\Topo')
            <a class="lien-title-post" href="{{route('topoPage',['topo_id'=>$post->postable->id, 'topo_label'=>str_slug($post->postable->label)])}}">{{$post->postable->label}}</a> <span class="grey-text">édité en {{$post->postable->editionYear}}</span>
        @elseif($post->postable_type == 'App\\Massive')
            <a class="lien-title-post" href="{{route('massivePage',['massive_id'=>$post->postable->id, 'massive_label'=>str_slug($post->postable->label)])}}">{{$post->postable->label}}</a> <span class="grey-text">regroupement de site</span>
        @elseif($post->postable_type == 'App\\User')
            <a class="lien-title-post" href="{{route('userPage',['userg_id'=>$post->postable->id, 'userg_label'=>str_slug($post->postable->name)])}}">{{$post->postable->name}}</a>
        @endif
        <br>
        <span class="grey-text">
            posté par <a href="{{route('userPage',['user_id'=>$post->user->id, 'user_label'=>$post->user->name])}}">{{$post->user->name}}</a>
            @if($post->created_at->format('d M Y') == date('d M Y'))
                aujourd'hui à {{$post->created_at->format('H:i')}}
            @else
                le {{$post->created_at->format('d M Y à H:i')}}
            @endif
        </span>
    </p>
</div>

{{--CONTENU DU POST--}}
<div class="markdownZone">{!! $post->content !!}</div>


{{--LES COMMENTAIRES--}}
@if(count($post->comments) > 0)

    {{--PETIT TITRE COMME QUOI IL Y A DES COMMENTAIRES--}}
    <span class="span-nb-commentaire-post">{{count($post->comments)}} COMMENTAIRES</span>

    {{--ZONE DES COMMENTAIRES--}}
    <div class="commentaire-post-zone">
        @foreach($post->comments as $commentaire)

            <div class="commentaire-post-div">

                {{--CONTENU DU COMMENTAIRE--}}
                <div class="markdownZone">@markdown($commentaire->comment)</div>

                {{--INFORMATION SUR CELUI QUI À POSTÉ LE COMMENTAIRE--}}
                <p class="user-comment-info grey-text">
                    <a href="{{route('userPage',['user_id'=>$commentaire->user->id, 'user_label'=>$commentaire->user->name])}}">{{$commentaire->user->name}}</a> le {{$commentaire->created_at->format('d M Y à H:i')}}

                    @if(Auth::check())
                        @if($commentaire->user_id == Auth::id())
                            <i {!! $Helpers::tooltip('Modifier ce commentaire') !!} {!! $Helpers::modal(route('commentModal'), ["commentable_id"=>$commentaire->id, "commentable_type"=>explode('\\',$post->postable_type)[1],"comment_id"=>$commentaire->id, "title"=>"Modifier ce commentaire", "method"=>"PUT", "callback"=>"reloadPost"]) !!} class="material-icons tiny-btn right tooltipped btnModal">edit</i>
                            @if(count($commentaire->comments) == 0)
                                <i {!! $Helpers::tooltip('Supprimer ce commentaire') !!} {!! $Helpers::modal(route('deleteModal'), ["route"=>"/comments/" . $commentaire->id , "callback"=>"reloadPost"]) !!} class="material-icons tiny-btn right tooltipped btnModal">delete</i>
                            @endif
                        @else
                            <i {!! $Helpers::tooltip('Signaler un problème sur ce commentaire') !!} {!! $Helpers::modal(route('problemModal'), ["id"=>$commentaire->id, "model"=>"Comment"]) !!} class="material-icons tiny-btn right tooltipped btnModal">flag</i>
                        @endif
                        @if(count($commentaire->likes->whereIn('user_id',Auth::id())) >= 1)
                            <i onclick="like({{$commentaire->id}}, 'Comment', false, {{$post->id}})" {!! $Helpers::tooltip('J\'aime') !!} class="material-icons ic-repondre-commentaire tiny blue-text" style="opacity: 1">thumb_up</i>
                        @else
                            <i onclick="like({{$commentaire->id}}, 'Comment', true, {{$post->id}})" {!! $Helpers::tooltip('J\'aime') !!} class="material-icons ic-repondre-commentaire tiny">thumb_up</i>
                        @endif
                        <i {!! $Helpers::tooltip('Répondre à ce commentaire') !!} {!! $Helpers::modal(route('commentModal'), ["commentable_id"=>$commentaire->id, "commentable_type"=>"Comment", "comment_id"=>"", "title"=>"Répondre à ce commentaire", "method"=>"POST", "callback"=>"reloadPost"]) !!} class="material-icons tooltipped btnModal ic-repondre-commentaire tiny">mode_comment</i>
                    @endif

                    @if(count($commentaire->likes) > 0)
                        <cite>{{count($commentaire->likes)}} j'aime(s)</cite>
                    @endif
                </p>
            </div>

            @if(count($commentaire->comments) > 0)
                <div class="sous-commentaire">
                    @foreach($commentaire->comments as $commentaire)

                        <div class="commentaire-post-div">

                            {{--CONTENU DU SOUS COMMENTAIRE--}}
                            <div class="markdownZone">@markdown($commentaire->comment)</div>

                            {{--INFORMATION SUR CELUI QUI À POSTÉ LE SOUS COMMENTAIRE--}}
                            <p class="user-comment-info grey-text">
                                <a href="{{route('userPage',['user_id'=>$commentaire->user->id, 'user_label'=>$commentaire->user->name])}}">{{$commentaire->user->name}}</a> le {{$commentaire->created_at->format('d M Y à H:i')}}

                                @if(Auth::check())
                                    @if($commentaire->user_id == Auth::id())
                                        <i {!! $Helpers::tooltip('Modifier ce commentaire') !!} {!! $Helpers::modal(route('commentModal'), ["commentable_id"=>$commentaire->id, "commentable_type"=>explode('\\',$post->postable_type)[1],"comment_id"=>$commentaire->id, "title"=>"Modifier ce commentaire", "method"=>"PUT", "callback"=>"reloadPost"]) !!} class="material-icons tiny-btn right tooltipped btnModal">edit</i>
                                        <i {!! $Helpers::tooltip('Supprimer ce commentaire') !!} {!! $Helpers::modal(route('deleteModal'), ["route"=>"/comments/" . $commentaire->id , "callback"=>"reloadPost"]) !!} class="material-icons tiny-btn right tooltipped btnModal">delete</i>
                                    @else
                                        <i {!! $Helpers::tooltip('Signaler un problème sur ce commentaire') !!} {!! $Helpers::modal(route('problemModal'), ["id"=>$commentaire->id, "model"=>"Comment"]) !!} class="material-icons tiny-btn right tooltipped btnModal">flag</i>
                                    @endif
                                    @if(count($commentaire->likes->whereIn('user_id',Auth::id())) >= 1)
                                        <i onclick="like({{$commentaire->id}}, 'Comment', false, {{$post->id}})" {!! $Helpers::tooltip('J\'aime') !!} class="material-icons ic-repondre-commentaire tiny blue-text" style="opacity: 1">thumb_up</i>
                                    @else
                                        <i onclick="like({{$commentaire->id}}, 'Comment', true, {{$post->id}})" {!! $Helpers::tooltip('J\'aime') !!} class="material-icons ic-repondre-commentaire tiny">thumb_up</i>
                                    @endif
                                @endif

                                @if(count($commentaire->likes) > 0)
                                    <cite>{{count($commentaire->likes)}} j'aime(s)</cite>
                                @endif

                            </p>

                        </div>

                    @endforeach
                </div>
            @endif

        @endforeach
    </div>
@endif


{{--BARRE D'ACTION DU POST--}}
<div class="action-post-barre">
    @if(Auth::check())
        <span class="btn-like-comment-repost">
            @if(count($post->likes->whereIn('user_id',Auth::id())) >= 1)
                <span onclick="like({{$post->id}}, 'Post', false, {{$post->id}})" class="btn-commenter blue-text"><i class="material-icons tiny">thumb_up</i> J'aime déjà</span>
            @else
                <span onclick="like({{$post->id}}, 'Post', true, {{$post->id}})" class="btn-commenter"><i class="material-icons tiny">thumb_up</i> j'aime</span>
            @endif
            <span {!! $Helpers::tooltip('Commenter ce post') !!} {!! $Helpers::modal(route('commentModal'), ["commentable_id"=>$post->id, "commentable_type"=>"Post", "comment_id"=>"", "title"=>"Commenter ce post", "method"=>"POST", "callback"=>"reloadPost"]) !!} class="btn-commenter tooltipped btnModal"><i class="material-icons tiny">mode_comment</i> commenter</span>
        </span>
        @if($post->user_id == Auth::id())
            <span><i {!! $Helpers::tooltip('Modifier ce post') !!} {!! $Helpers::modal(route('postModal'), ["postable_id"=>$post->postable_id, "postable_type"=>explode('\\',$post->postable_type)[1], "post_id"=>$post->id, "title"=>"Modifier ce post", "method"=>"PUT", "callback"=>"reloadPost"]) !!} class="material-icons tiny-btn right tooltipped btnModal">edit</i></span>
            @if(count($post->comments) == 0)
                <span><i {!! $Helpers::tooltip('Supprimer ce post') !!} {!! $Helpers::modal(route('deleteModal'), ["route"=>"/posts/" . $post->id]) !!} class="material-icons tiny-btn right tooltipped btnModal">delete</i></span>
            @endif
        @else
            <span><i {!! $Helpers::tooltip('Signaler un problème sur ce post') !!} {!! $Helpers::modal(route('problemModal'), ["id"=>$post->id, "model"=>"Post"]) !!} class="material-icons tiny-btn right tooltipped btnModal">flag</i></span>
        @endif
    @endif

    @if(count($post->likes) > 0)
        <cite>{{count($post->likes)}} j'aime(s)</cite>
    @endif
</div>