@extends('layouts.app', [
    'meta_title'=> trans('meta/project.title_articles'),
    'meta_description'=> trans('meta/project.description_articles'),
    'meta_img'=>'/img/default-article-bandeau.jpg',
    ])

@inject('Helpers','App\Lib\HelpersTemplates')

@section('css')
    <link href="/css/article.css" rel="stylesheet">
    <link href="/css/article-markdown.css" rel="stylesheet">
@endsection

@section('content')

    {{--contenu de la page--}}
    <div class="container articles-container">
        <div class="row">

            @foreach($articles as $article)
                @if($loop->first)
                    <div class="col s12">
                        <a style="background-image: url('{{ $article->bandeau() }}')" href="{{ $article->url() }}" class="first-article">
                            <div class="article-footer">
                                <h1 class="loved-king-font">{{ $article->label }}</h1>
                                <p>
                                    @choice('pages/articles/article.articles_views', $article->views),
                                    @choice('pages/articles/article.nb_comments', $article->descriptions_count),
                                </p>
                            </div>
                        </a>
                    </div>
                @else
                    <div class="col s12 m6 col-next-article">
                        <a style="background-image: url('{{ $article->bandeau(200) }}')" href="{{ $article->url() }}" class="next-article">
                            <div class="article-footer">
                                <h2 class="loved-king-font truncate">{{ $article->label }}</h2>
                                <p>
                                    @choice('pages/articles/article.articles_views', $article->views),
                                    @choice('pages/articles/article.nb_comments', $article->descriptions_count)
                                </p>
                            </div>
                        </a>
                    </div>
                @endif
            @endforeach
        </div>

        {{ $articles->links('vendor.pagination.default') }}

    </div>
@endsection

@section('script')
    <script>
        //passage de la barre de navigation en noir
        var animationScroll = false;
        var nav_barre = document.getElementById('nav_barre');
        nav_barre.setAttribute('class', nav_barre.className.replace('nav-white','nav-black'));

    </script>
    <script src="/js/article.js"></script>
@endsection