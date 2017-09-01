@extends('layouts.app',[
    'meta_title'=> trans('meta/forum.title_category'),
    'meta_description'=>trans('meta/forum.description_category'),
    'meta_img'=>'/img/forum-escalade-oblyk.jpg',
    ])

@section('css')
    <link href="/css/forum.css" rel="stylesheet">
    <link href="/css/post.css" rel="stylesheet">
@endsection

@section('content')

    {{--parallax--}}
    @include('includes.parallax', array('imgSrc' => '/img/forum-escalade-oblyk.jpg', 'imgAlt' => 'le forum escalade de oblyk'))


    {{--contenu de la page--}}
    <div class="container">

        @include('pages.forum.partials.nav',['active'=>'category'])

        <div class="row">
            <div class="col s12">
                <h1 class="loved-king-font text-center grey-text text-darken-3">@lang('pages/forums/category.title')</h1>

                <p>
                    @lang('pages/forums/category.intro_1')
                </p>

                <p>
                    @lang('pages/forums/category.intro_2')
                </p>

                <div class="row list-categories-zone">

                    @foreach($generalCategories as $generalCategory)

                        <h2 class="loved-king-font">@lang('elements/generalCategories.category_' . $generalCategory->id)</h2>

                        <div class="row">
                            @foreach($generalCategory->categories as $category)
                                <div class="col s12 m6 category-box">
                                    <div class="card">
                                        <div class="card-content">
                                            <div class="title-bar">
                                                <img src="/img/forum-{{$category->id}}.svg" alt="" class="left">
                                                <h3 class="loved-king-font truncate">@lang('elements/Categories.label_' . $category->id)</h3>
                                                <p class="no-margin grey-text">
                                                    {{ trans_choice('pages/forums/category.nbTopics', count($category->topics)) }}
                                                </p>
                                            </div>
                                            <p>@lang('elements/Categories.description_' . $category->id)</p>
                                        </div>
                                        <div class="card-action">
                                            @if(Auth::check())
                                                <a rel="nofollow" href="{{route('createTopics',['category_id'=>$category->id])}}">@lang('pages/forums/category.btnCreateTopics')</a>
                                            @endif
                                            <a rel="nofollow" href="{{route('forumTopics')}}?categorie={{$category->id}}">@lang('pages/forums/category.btnSeeTopics')</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    @endforeach
                </div>

            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="/js/forum.js"></script>
    <script src="/js/post.js"></script>
@endsection
