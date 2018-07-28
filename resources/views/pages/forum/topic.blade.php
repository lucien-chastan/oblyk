@extends('layouts.app',[
    'meta_title'=> $topic->label,
    'meta_description'=>trans('elements/Categories.description_' . $topic->category->id),
    'meta_img'=>'https://oblyk.org/img/forum-escalade-oblyk.jpg',
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
                        @lang('pages/forums/topic.postBy') <a href="{{ $topic->user->url() }}">{{$topic->user->name}}</a>
                        , {{ trans_choice('pages/forums/topic.nbPost', $topic->nb_post) }}
                        , {{ trans_choice('pages/forums/topic.postView', $topic->views) }}
                        @if(Auth::check())
                            <i {!! $Helpers::tooltip(trans('modals/problem.tooltip')) !!} {!! $Helpers::modal(route('problemModal'), ["id" => $topic->id , "model"=> "ForumTopic"]) !!} class="material-icons tiny-btn tooltipped btnModal">flag</i>
                            @if(Auth::id() == $topic->user_id)
                                <i {!! $Helpers::tooltip(trans('pages/forums/topic.tooltipEdit')) !!} {!! $Helpers::modal(route('topicModal'), ["topic_id"=>$topic->id, "title"=>trans('pages/forums/topic.titleModalEdit'), "method" => "PUT"]) !!} class="material-icons tiny-btn tooltipped btnModal">edit</i>
                                @if(count($posts) == 0)
                                    <i {!! $Helpers::tooltip(trans('pages/forums/topic.tooltipDelete')) !!} {!! $Helpers::modal(route('deleteModal'), ["route" => "/topics/".$topic->id]) !!} class="material-icons tiny-btn tooltipped btnModal">delete</i>
                                @endif
                            @endif
                        @endif
                    </p>

                    @if(Auth::check())
                        <div class="text-center">
                            <p onclick="followedElement(this, 'ForumTopic', {{$topic->id}})" class="follow-paragraphe no-margin following-topic" data-followed="{{$user_follow}}">
                                <span id="followed-element"><i class="material-icons amber-text">star</i> @lang('pages/forums/topic.unfollowing')</span>
                                <span id="not-followed-element"><i class="material-icons with-text">star_border</i> @lang('pages/forums/topic.following')</span>
                            </p>
                        </div>
                    @else
                        <p class="no-margin text-center">@lang('pages/forums/topic.loginForFollow')</p>
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
                            {{ trans_choice('pages/forums/topic.addPost', $topic->nb_post) }}
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
