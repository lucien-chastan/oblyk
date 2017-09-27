@extends('layouts.app',[
    'meta_title'=> trans('meta/forum.title_rules'),
    'meta_description'=>trans('meta/forum.description_rules'),
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
    <div class="container">

        @include('pages.forum.partials.nav',['active'=>'rules'])

        <div class="row">
            <div class="col s12">
                <h1 class="loved-king-font text-center grey-text text-darken-3">@lang('pages/forums/rules.title')</h1>

                <p class="text-center">
                    @lang('pages/forums/rules.intro')
                </p>

                <div class="nine-commandements-list">

                    <div class="row">
                        <i class="material-icons left">comment</i>
                        <p>
                            <strong>@lang('pages/forums/rules.rules_label_1')</strong><br>
                            @lang('pages/forums/rules.rules_description_1')
                        </p>
                    </div>

                    <div class="row">
                        <i class="material-icons left">timer</i>
                        <p>
                            <strong>@lang('pages/forums/rules.rules_label_2')</strong><br>
                            @lang('pages/forums/rules.rules_description_2')
                        </p>
                    </div>

                    <div class="row">
                        <i class="material-icons left">spellcheck</i>
                        <p>
                            <strong>@lang('pages/forums/rules.rules_label_3')</strong><br>
                            @lang('pages/forums/rules.rules_description_3')
                        </p>
                    </div>

                    <div class="row">
                        <i class="material-icons left">lock</i>
                        <p>
                            <strong>@lang('pages/forums/rules.rules_label_4')</strong><br>
                            @lang('pages/forums/rules.rules_description_4')
                        </p>
                    </div>

                    <div class="row">
                        <i class="material-icons left">search</i>
                        <p>
                            <strong>@lang('pages/forums/rules.rules_label_5')</strong><br>
                            @lang('pages/forums/rules.rules_description_5')
                        </p>
                    </div>

                    <div class="row">
                        <i class="material-icons left">flag</i>
                        <p>
                            <strong>@lang('pages/forums/rules.rules_label_6')</strong><br>
                            @lang('pages/forums/rules.rules_description_6')
                        </p>
                    </div>

                    <div class="row">
                        <i class="material-icons left">title</i>
                        <p>
                            <strong>@lang('pages/forums/rules.rules_label_7')</strong><br>
                            @lang('pages/forums/rules.rules_description_7')
                        </p>
                    </div>

                    <div class="row">
                        <i class="material-icons left">looks_one</i>
                        <p>
                            <strong>@lang('pages/forums/rules.rules_label_8')</strong><br>
                            @lang('pages/forums/rules.rules_description_8')
                        </p>
                    </div>

                    <div class="row">
                        <i class="material-icons left">flash_on</i>
                        <p>
                            <strong>@lang('pages/forums/rules.rules_label_9')</strong><br>
                            @lang('pages/forums/rules.rules_description_9')
                        </p>
                    </div>

                </div>

                <p class="text-center">@lang('pages/forums/rules.conclusion')</p>

            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="/js/forum.js"></script>
    <script src="/js/post.js"></script>
@endsection
