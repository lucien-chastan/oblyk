@extends('layouts.app')

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

                    <h1 class="loved-king-font text-center grey-text text-darken-3">Les sujets postés</h1>

                    <p>
                        Dans cette section, vous trouverez les dernières <strong>discussions</strong> lancées par des grimpeurs, sur des sujets divers et variés, comme :
                        <strong>recherche de partenaires</strong>, conseils pour faire des jolies <strong>photos d'escalade</strong>, avis sur du <strong>matériel d'escalade</strong>, etc.<br>
                        N'hésitez surtout pas à poster un message dans une discussion qui vous interpelle sur le <strong>forum d'escalade</strong> :
                        il est toujours bon d'enrichir les débats ! ;)
                    </p>

                @else

                    <h1 class="loved-king-font text-center grey-text text-darken-3">{{$filter_categorie->label}}</h1>

                    <p class="text-center">
                        {{$filter_categorie->description}}
                    </p>

                @endif

                @if(count($topics) != 0)
                    <table>
                        <thead>
                        <tr>
                            <th>Titre</th>
                            <th class="text-center">Catégorie</th>
                            <th class="text-center">vus</th>
                            <th class="text-center">posts</th>
                            <th class="text-center">Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($topics as $topic)
                            <tr>
                                <td>
                                    <a class="text-bold" href="{{ route('topicPage',['topic_id'=>$topic->id,'topic_label'=>str_slug($topic->label)]) }}">{{$topic->label}}</a><br>
                                    <span class="grey-text">proposé par <a href="{{route('userPage',['user_id'=>$topic->user->id,'user_label'=>str_slug($topic->user->name)])}}">{{$topic->user->name}}</a></span>
                                </td>
                                <td {!! $Helpers::tooltip($topic->category->label) !!} class="text-center tooltipped"><img class="img-topics" src="/img/forum-{{$topic->category_id}}.svg"></td>
                                <td class="text-center">{{$topic->views}}</td>
                                <td class="text-center">{{$topic->nb_post}}</td>
                                <td class="grey-text text-center">{{$topic->last_post->format('d M Y à H:i')}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="grey-text text-center">
                        Il n'y a pas encore de sujet dans cette catégorie<br>
                        <a href="{{route('forumTopics')}}">voir tous les sujets</a>
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
