@extends('layouts.app',[
    'meta_title'=> $topic->label,
    'meta_description'=>$topic->category->description,
    'meta_img'=>'/img/forum-escalade-oblyk.jpg',
    ])

@inject('Helpers','App\Lib\HelpersTemplates')


@section('css')
    <link href="/css/forum.css" rel="stylesheet">
    <link href="/css/post.css" rel="stylesheet">
@endsection

@section('content')

    {{--parallax--}}
    @include('includes.parallax', array('imgSrc' => '/img/forum-escalade-oblyk.jpg', 'imgAlt' => 'le forum escalade de oblyk'))


    {{--contenu de la page--}}
    <div class="container">

        @include('pages.forum.partials.nav',['active'=>'topic'])

        <div class="row">
            <div class="col s12">

                <div class="title-topic-bar">
                    <h1 class="loved-king-font text-center grey-text text-darken-3 titre-topic">{{$topic->label}}</h1>
                    <p class="text-center grey-text no-margin info-topic">
                        Proposé par <a href="{{ route('userPage',['user_id'=>$topic->user->id,'user_label'=>str_slug($topic->user->name)]) }}">{{$topic->user->name}}</a>
                        , {{$topic->nb_post}} posts
                        , vu {{$topic->views}} fois
                        @if(Auth::check())
                            <i {!! $Helpers::tooltip('Signaler un problème') !!} {!! $Helpers::modal(route('problemModal'), ["id" => $topic->id , "model"=> "ForumTopic"]) !!} class="material-icons tiny-btn tooltipped btnModal">flag</i>
                            @if(Auth::id() == $topic->user_id)
                                <i {!! $Helpers::tooltip('Modifier titre ou catégorie de ce topic') !!} {!! $Helpers::modal(route('topicModal'), ["topic_id"=>$topic->id, "title"=>"Modifier ce topic", "method" => "PUT"]) !!} class="material-icons tiny-btn tooltipped btnModal">edit</i>
                                @if(count($posts) == 0)
                                    <i {!! $Helpers::tooltip('Supprimer ce topic') !!} {!! $Helpers::modal(route('deleteModal'), ["route" => "/topics/".$topic->id]) !!} class="material-icons tiny-btn tooltipped btnModal">delete</i>
                                @endif
                            @endif
                        @endif
                    </p>

                    @if(Auth::check())
                        <div class="text-center">
                            <p onclick="followedElement(this, 'ForumTopic', {{$topic->id}})" class="follow-paragraphe no-margin following-topic" data-followed="{{$user_follow}}">
                                <span id="followed-element"><i class="material-icons amber-text">star</i> Ne plus suivre ce sujet</span>
                                <span id="not-followed-element"><i class="material-icons with-text">star_border</i> Suivre ce sujet</span>
                            </p>
                        </div>
                    @else
                        <p class="no-margin text-center">Connectez-vous pour suivre ce sujet</p>
                    @endif
                </div>

                <div id="insert-posts-zone">
                    @foreach($posts as $post)

                        <div class="col s12">
                            <div class="card-panel" id="zone-post-{{$post->id}}" >
                                @include('pages.posts.onePost')
                            </div>
                        </div>

                    @endforeach

                </div>


                @if(!$posts->hasMorePages() && Auth::check())
                    <div {!! $Helpers::modal(route('postModal'), ["postable_id"=>$topic->id, "postable_type"=>"ForumTopic", "post_id"=>"", "title"=>"Écrire le premier post", "method"=>"POST" ]) !!} class="btnModal btn-add-response waves-effect blue-text z-depth-1">
                        <p>
                            @if($topic->nb_post == 0)
                                Écrire le premier post
                            @else
                                Ajouter une réponse
                            @endif
                        </p>
                    </div>
                @endif

                {{ $posts->links('vendor.pagination.default') }}

            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="/js/forum.js"></script>
    <script src="/js/post.js"></script>
@endsection
