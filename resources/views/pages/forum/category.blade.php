@extends('layouts.app')

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
                <h1 class="loved-king-font text-center grey-text text-darken-3">Les catégories</h1>

                <p>
                    Dans cette section, vous trouverez toutes les catégories de discussions qui existent sur le forum d'escalade d'Oblyk: résumés de voyages de grimpe, questions relatives à une voie ou un site d'escalade, etc.
                </p>

                <p>
                    Si vous ne trouvez la catégorie parfaite pour votre sujet, utiliser la "zone d'expression libre", elle est faite pour ça.
                </p>

                <div class="row list-categories-zone">

                    @foreach($generalCategories as $generalCategory)

                        <h2 class="loved-king-font">{{$generalCategory->label}}</h2>

                        <div class="row">
                            @foreach($generalCategory->categories as $category)
                                <div class="col s12 m6 category-box">
                                    <div class="card">
                                        <div class="card-content">
                                            <div class="title-bar">
                                                <img src="/img/forum-{{$category->id}}.svg" alt="" class="left">
                                                <h3 class="loved-king-font truncate"> {{$category->label}}</h3>
                                                @if(count($category->topics) > 0)
                                                    <p class="no-margin grey-text">{{count($category->topics)}} sujets postés</p>
                                                @else
                                                    <p class="no-margin grey-text">pas encore de sujet posté</p>
                                                @endif
                                            </div>
                                            <p>{{$category->description}}</p>
                                        </div>
                                        <div class="card-action">
                                            @if(Auth::check())
                                                <a rel="nofollow" href="{{route('createTopics',['category_id'=>$category->id])}}">Créer un sujet</a>
                                            @endif
                                            <a rel="nofollow" href="{{route('forumTopics')}}?categorie={{$category->id}}">voir les sujets</a>
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
