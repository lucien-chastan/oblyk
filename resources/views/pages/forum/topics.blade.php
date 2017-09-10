@extends('layouts.app',[
    'meta_title'=> trans('meta/forum.title_topics'),
    'meta_description'=>trans('meta/forum.description_topics'),
    'meta_img'=>'/img/forum-escalade-oblyk.jpg',
    ])

@inject('Helpers','App\Lib\HelpersTemplates')
@inject('Inputs','App\Lib\InputTemplates')

@section('css')
    <link href="/css/forum.css" rel="stylesheet">
    <link href="/css/post.css" rel="stylesheet">
@endsection

@section('content')

    {{--parallax--}}
    @include('includes.parallax', array('imgSrc' => '/img/forum-escalade-oblyk.jpg', 'imgAlt' => 'le forum escalade de oblyk'))


    {{--contenu de la page--}}
    <div class="container">

        @include('pages.forum.partials.nav',['active'=>'topics'])

        <div class="row">
            <div class="col s12">

                @if($filter == 'no-filtre')

                    <h1 class="loved-king-font text-center grey-text text-darken-3">@lang('pages/forums/topics.title')</h1>

                    <p>
                        @lang('pages/forums/topics.intro')
                    </p>

                @else

                    <h1 class="loved-king-font text-center grey-text text-darken-3">@lang('elements/Categories.label_' . $filter_categorie->id)</h1>

                    <p class="text-center">
                        @lang('elements/Categories.description_' . $filter_categorie->id)
                    </p>

                @endif

                @if(count($topics) != 0)
                    <table>
                        <thead>
                        <tr>
                            <th>@lang('pages/forums/topics.columnTitle')</th>
                            <th class="text-center">@lang('pages/forums/topics.columnCategory')</th>
                            <th class="text-center">@lang('pages/forums/topics.columnViews')</th>
                            <th class="text-center">@lang('pages/forums/topics.columnPosts')</th>
                            <th class="text-center">@lang('pages/forums/topics.columnDate')</th>
                            <th class="text-center"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($topics as $topic)
                            <tr>
                                <td>
                                    <a class="text-bold" href="{{ route('topicPage',['topic_id'=>$topic->id,'topic_label'=>str_slug($topic->label)]) }}">{{$topic->label}}</a><br>
                                    <span class="grey-text">@lang('pages/forums/topics.addedBy') <a href="{{route('userPage',['user_id'=>$topic->user->id,'user_label'=>str_slug($topic->user->name)])}}">{{$topic->user->name}}</a></span>
                                </td>
                                <td {!! $Helpers::tooltip(trans('elements/Categories.label_' . $topic->category->id)) !!} class="text-center tooltipped"><img class="img-topics" src="/img/forum-{{$topic->category_id}}.svg"></td>
                                <td class="text-center">{{$topic->views}}</td>
                                <td class="text-center">{{$topic->nb_post}}</td>
                                <td class="grey-text text-center">{{$topic->last_post->format('d M Y à H:i')}}</td>
                                <td>
                                    <a {!! $Helpers::tooltip(trans('pages/forums/topics.goToLastPage')) !!} class="tooltipped" rel="nofollow" href="{{ route('topicPage',['topic_id'=>$topic->id,'topic_label'=>str_slug($topic->label)]) }}?page={{ ceil($topic->nb_post / 10) }}">
                                        <i class="material-icons right">last_page</i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="grey-text text-center">
                        @lang('pages/forums/topics.noTopics')<br>
                        <a href="{{route('forumTopics')}}">@lang('pages/forums/topics.actionNoTopics')</a>
                    </p>
                @endif

                {{ $topics->links('vendor.pagination.default') }}

            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="/js/forum.js"></script>
    <script src="/js/post.js"></script>
    <script>
        $('select').material_select();
    </script>
@endsection
