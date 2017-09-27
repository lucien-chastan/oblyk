@extends('layouts.app',[
    'meta_title'=> trans('meta/forum.title_home'),
    'meta_description'=>trans('meta/forum.description_home'),
    'meta_img'=>'https://oblyk.org/img/forum-escalade-oblyk.jpg',
    ])

@section('css')
    <link href="/css/forum.css" rel="stylesheet">
    <link href="/css/post.css" rel="stylesheet">
@endsection

@section('content')

    {{--parallax--}}
    @include('includes.parallax', array('imgSrc' => '/img/forum-escalade-oblyk.jpg', 'imgAlt' => 'le forum escalade de oblyk'))


    {{--contenu de la page--}}
    <div class="container page-forum">

        @include('pages.forum.partials.nav',['active'=>'forum'])

        <div class="row">
            <div class="col s12">
                <h1 class="loved-king-font text-center grey-text text-darken-3">@lang('pages/forums/home.title')</h1>

                <h2 class="text-center loved-king-font">
                    @lang('pages/forums/home.slogan')
                </h2>

                <div class="row div-image-explication-forum">
                    <div class="col s12 m6">
                        <img src="/img/svg-forum.svg" class="responsive-img">
                    </div>
                    <div class="col s12 m6">
                        <p>
                            @lang('pages/forums/home.para')
                        </p>
                        <p>
                            <a href="{{route('forumTopics')}}"><i class="material-icons left tiny">forum</i> @lang('pages/forums/home.goToTopics')</a><br>
                        </p>
                        @if(Auth::check())
                            <p>
                                <a href="{{route('createTopics',['category_id'=>1])}}"><i class="material-icons left tiny">comment</i> @lang('pages/forums/home.goToCreate')</a><br>
                            </p>
                        @endif
                        <p>
                            <a href="{{route('forumRules')}}"><i class="material-icons left tiny">reorder</i> @lang('pages/forums/home.goToRules')</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="/js/forum.js"></script>
    <script src="/js/post.js"></script>
@endsection
