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
    @elseif($post->postable_type == 'App\\ForumTopic')
        @if($postable_type != 'ForumTopic')
            <img src="/img/forum-{{ $post->postable->category_id }}.svg" class="circle left" alt="">
        @else
            @if(file_exists(storage_path('app/public/users/50/user-' . $post->user->id . '.jpg')))
                <img src="/storage/users/50/user-{{$post->user->id}}.jpg" class="circle left" alt="">
            @else
                <img src="/img/icon-search-user.svg" class="circle left" alt="">
            @endif
        @endif
    @elseif($post->postable_type == 'App\\User')
        @if(file_exists(storage_path('app/public/users/50/user-' . $post->postable->id . '.jpg')))
            <img src="/storage/users/50/user-{{$post->postable->id}}.jpg" class="circle left" alt="">
        @else
            <img src="/img/icon-search-user.svg" class="circle left" alt="">
        @endif
    @elseif($post->postable_type == 'App\\Gym')
        <img src="/img/icon-search-gym.svg" class="circle left" alt="">
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
            <a class="lien-title-post" href="{{route('userPage',['user_id'=>$post->postable->id, 'user_label'=>str_slug($post->postable->name)])}}">{{$post->postable->name}}</a>
        @elseif($post->postable_type == 'App\\Gym')
            <a class="lien-title-post" href="{{route('gymPage',['gym_id'=>$post->postable->id, 'gym_label'=>str_slug($post->postable->label)])}}">{{$post->postable->label}}</a>
        @elseif($post->postable_type == 'App\\ForumTopic')
            @if($postable_type != 'ForumTopic')
                <a class="lien-title-post" href="{{route('topicPage',['topic_id'=>$post->postable->id, 'topic_label'=>str_slug($post->postable->label)])}}">{{$post->postable->label}}</a>
            @endif
        @endif
        <br>
        <span class="grey-text">
            @lang('pages/post/onePost.postBy',
                [
                    'name'=> ($post->user->id == Auth::id()) ? trans('pages/post/onePost.me') : $post->user->name,
                    'url' => route('userPage',['user_id'=>$post->user->id, 'user_label'=>$post->user->name])
                ]
            )
            @if($post->created_at->format('d M Y') == date('d M Y'))
                @lang('pages/post/onePost.today', ['hour'=>$post->created_at->format('H:i')])
            @else
                @lang('pages/post/onePost.date', ['date'=>$post->created_at->format('d M Y'),'hour'=>$post->created_at->format('H:i')])
            @endif
        </span>
    </p>
</div>

{{--CONTENU DU POST--}}
<div class="markdownZone">{!! $post->content !!}</div>


{{--LES COMMENTAIRES--}}
@if(count($post->comments) > 0)

    {{--PETIT TITRE COMME QUOI IL Y A DES COMMENTAIRES--}}
    <span class="span-nb-commentaire-post">{{ trans_choice('pages/post/onePost.titleNbCommentaire', count($post->comments)) }}</span>

    {{--ZONE DES COMMENTAIRES--}}
    <div class="commentaire-post-zone">
        @foreach($post->comments as $commentaire)

            <div class="commentaire-post-div">

                {{--CONTENU DU COMMENTAIRE--}}
                <div class="markdownZone">@markdown($commentaire->comment)</div>

                {{--INFORMATION SUR CELUI QUI À POSTÉ LE COMMENTAIRE--}}
                <p class="user-comment-info grey-text">

                    @if($commentaire->user->id == Auth::id())
                        <a href="{{route('userPage',['user_id'=>$commentaire->user->id, 'user_label'=>$commentaire->user->name])}}">@lang('pages/post/onePost.me')</a> @lang('pages/post/onePost.on') {{$commentaire->created_at->format('d M Y à H:i')}}
                    @else
                        <a href="{{route('userPage',['user_id'=>$commentaire->user->id, 'user_label'=>$commentaire->user->name])}}">{{$commentaire->user->name}}</a> @lang('pages/post/onePost.on') {{$commentaire->created_at->format('d M Y à H:i')}}
                    @endif

                    @if(count($commentaire->likes) > 0)
                        <cite {!! $Helpers::modal(route('likeModal'), ["likable_id"=>$commentaire->id, "likable_type"=>"Comment", "title"=>trans('pages/post/onePost.usersLikePost')]) !!} class="text-cursor btnModal">{{ trans_choice('pages/post/onePost.nbLike', count($commentaire->likes)) }}</cite>
                    @endif

                    @if(Auth::check())
                        @if($commentaire->user_id == Auth::id())
                            <i {!! $Helpers::tooltip(trans('modals/comment.editTooltip')) !!} {!! $Helpers::modal(route('commentModal'), ["commentable_id"=>$commentaire->id, "commentable_type"=>explode('\\',$post->postable_type)[1],"comment_id"=>$commentaire->id, "title"=>trans('modals/comment.modalEditeTitle'), "method"=>"PUT", "callback"=>"reloadPost"]) !!} class="material-icons tiny-btn right tooltipped btnModal">edit</i>
                            @if(count($commentaire->comments) == 0)
                                <i {!! $Helpers::tooltip(trans('modals/comment.deleteTooltip')) !!} {!! $Helpers::modal(route('deleteModal'), ["route"=>"/comments/" . $commentaire->id , "callback"=>"reloadPost"]) !!} class="material-icons tiny-btn right tooltipped btnModal">delete</i>
                            @endif
                        @else
                            <i {!! $Helpers::tooltip(trans('pages/post/onePost.reportAProblem')) !!} {!! $Helpers::modal(route('problemModal'), ["id"=>$commentaire->id, "model"=>"Comment"]) !!} class="material-icons tiny-btn right tooltipped btnModal">flag</i>
                        @endif
                        @if(count($commentaire->likes->whereIn('user_id',Auth::id())) >= 1)
                            <i title="@lang('pages/post/onePost.unLike')" onclick="like({{$commentaire->id}}, 'Comment', false, {{$post->id}}, 'Comment')" {!! $Helpers::tooltip(trans('pages/post/onePost.like')) !!} class="material-icons ic-repondre-commentaire tiny blue-text" style="opacity: 1">thumb_up</i>
                        @else
                            <i title="@lang('pages/post/onePost.addLike')" onclick="like({{$commentaire->id}}, 'Comment', true, {{$post->id}}, 'Comment')" {!! $Helpers::tooltip(trans('pages/post/onePost.like')) !!} class="material-icons ic-repondre-commentaire tiny">thumb_up</i>
                        @endif
                        <i {!! $Helpers::tooltip(trans('pages/post/onePost.answer')) !!} {!! $Helpers::modal(route('commentModal'), ["commentable_id"=>$commentaire->id, "commentable_type"=>"Comment", "comment_id"=>"", "title"=>trans('pages/post/onePost.answer'), "method"=>"POST", "callback"=>"reloadPost"]) !!} class="material-icons tooltipped btnModal ic-repondre-commentaire tiny">mode_comment</i>
                    @endif
                </p>
            </div>

            @if(count($commentaire->comments) > 0)
                <div class="sous-commentaire">
                    @foreach($commentaire->comments as $subCommentaire)

                        <div class="commentaire-post-div">

                            {{--CONTENU DU SOUS COMMENTAIRE--}}
                            <div class="markdownZone">@markdown($subCommentaire->comment)</div>

                            {{--INFORMATION SUR CELUI QUI À POSTÉ LE SOUS COMMENTAIRE--}}
                            <p class="user-comment-info grey-text">

                                @if($subCommentaire->user->id == Auth::id())
                                    <a href="{{route('userPage',['user_id'=>$subCommentaire->user->id, 'user_label'=>$subCommentaire->user->name])}}">moi</a> le {{$subCommentaire->created_at->format('d M Y à H:i')}}
                                @else
                                    <a href="{{route('userPage',['user_id'=>$subCommentaire->user->id, 'user_label'=>$subCommentaire->user->name])}}">{{$subCommentaire->user->name}}</a> le {{$subCommentaire->created_at->format('d M Y à H:i')}}
                                @endif

                                @if(count($subCommentaire->likes) > 0)
                                    <cite {!! $Helpers::modal(route('likeModal'), ["likable_id"=>$subCommentaire->id, "likable_type"=>"Comment", "title"=>trans('pages/post/onePost.usersLike')]) !!} class="text-cursor btnModal">{{count($subCommentaire->likes)}} j'aime(s)</cite>
                                @endif

                                @if(Auth::check())
                                    @if($subCommentaire->user_id == Auth::id())
                                        <i {!! $Helpers::tooltip(trans('modals/comment.editTooltip')) !!} {!! $Helpers::modal(route('commentModal'), ["commentable_id"=>$subCommentaire->id, "commentable_type"=>explode('\\',$post->postable_type)[1],"comment_id"=>$subCommentaire->id, "title"=>trans('modals/comment.modalEditeTitle'), "method"=>"PUT", "callback"=>"reloadPost"]) !!} class="material-icons tiny-btn right tooltipped btnModal">edit</i>
                                        <i {!! $Helpers::tooltip(trans('modals/comment.deleteTooltip')) !!} {!! $Helpers::modal(route('deleteModal'), ["route"=>"/comments/" . $subCommentaire->id , "callback"=>"reloadPost"]) !!} class="material-icons tiny-btn right tooltipped btnModal">delete</i>
                                    @else
                                        <i {!! $Helpers::tooltip(trans('pages/post/onePost.reportAProblem')) !!} {!! $Helpers::modal(route('problemModal'), ["id"=>$subCommentaire->id, "model"=>"Comment"]) !!} class="material-icons tiny-btn right tooltipped btnModal">flag</i>
                                    @endif
                                    @if(count($subCommentaire->likes->whereIn('user_id',Auth::id())) >= 1)
                                        <i title="@lang('pages/post/onePost.unLike')" onclick="like({{$subCommentaire->id}}, 'Comment', false, {{$post->id}}, 'SubComment')" {!! $Helpers::tooltip(trans('pages/post/onePost.like')) !!} class="material-icons ic-repondre-commentaire tiny blue-text" style="opacity: 1">thumb_up</i>
                                    @else
                                        <i title="@lang('pages/post/onePost.addLike')" onclick="like({{$subCommentaire->id}}, 'Comment', true, {{$post->id}}, 'SubComment')" {!! $Helpers::tooltip(trans('pages/post/onePost.like')) !!} class="material-icons ic-repondre-commentaire tiny">thumb_up</i>
                                    @endif
                                @endif
                            </p>

                        </div>

                    @endforeach

                    @if(Auth::check())
                        <p class="para-ajouter-reponse">
                            <a {!! $Helpers::tooltip(trans('pages/post/onePost.answer')) !!} {!! $Helpers::modal(route('commentModal'), ["commentable_id"=>$commentaire->id, "commentable_type"=>"Comment", "comment_id"=>"", "title"=>trans('pages/post/onePost.answer'), "method"=>"POST", "callback"=>"reloadPost"]) !!} class="tooltipped btnModal text-cursor"><i class="material-icons tiny">mode_comment</i>@lang('pages/post/onePost.addAnswer')</a>
                        </p>
                    @endif
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
                <span title="@lang('pages/post/onePost.unLike')" onclick="like({{$post->id}}, 'Post', false, {{$post->id}}, 'Post')" class="btn-commenter blue-text"><i class="material-icons tiny">thumb_up</i> @lang('pages/post/onePost.alreadyLike')</span>
            @else
                <span title="@lang('pages/post/onePost.addLike')" onclick="like({{$post->id}}, 'Post', true, {{$post->id}}, 'Post')" class="btn-commenter"><i class="material-icons tiny">thumb_up</i> @lang('pages/post/onePost.like')</span>
            @endif
            <span {!! $Helpers::tooltip(trans('pages/post/onePost.commentPost')) !!} {!! $Helpers::modal(route('commentModal'), ["commentable_id"=>$post->id, "commentable_type"=>"Post", "comment_id"=>"", "title"=>trans('pages/post/onePost.commentPost'), "method"=>"POST", "callback"=>"reloadPost"]) !!} class="btn-commenter tooltipped btnModal"><i class="material-icons tiny">mode_comment</i> @lang('pages/post/onePost.comment')</span>
        </span>
        @if($post->user_id == Auth::id())
            <span><i {!! $Helpers::tooltip(trans('modals/post.editTooltip')) !!} {!! $Helpers::modal(route('postModal'), ["postable_id"=>$post->postable_id, "postable_type"=>explode('\\',$post->postable_type)[1], "post_id"=>$post->id, "title"=>trans('modals/post.modalEditeTitle'), "method"=>"PUT", "callback"=>"reloadPost"]) !!} class="material-icons tiny-btn right tooltipped btnModal">edit</i></span>
            @if(count($post->comments) == 0)
                <span><i {!! $Helpers::tooltip(trans('modals/post.deleteTooltip')) !!} {!! $Helpers::modal(route('deleteModal'), ["route"=>"/posts/" . $post->id]) !!} class="material-icons tiny-btn right tooltipped btnModal">delete</i></span>
            @endif
        @else
            <span><i {!! $Helpers::tooltip(trans('pages/post/onePost.reportAProblemPost')) !!} {!! $Helpers::modal(route('problemModal'), ["id"=>$post->id, "model"=>"Post"]) !!} class="material-icons tiny-btn right tooltipped btnModal">flag</i></span>
        @endif
    @endif

    @if(count($post->likes) > 0)
        <cite {!! $Helpers::modal(route('likeModal'), ["likable_id"=>$post->id, "likable_type"=>"Post", "title"=>trans('pages/post/onePost.usersLikePost')]) !!} class="text-cursor btnModal">{{ trans_choice('pages/post/onePost.nbLike', count($post->likes)) }}</cite>
    @endif
</div>