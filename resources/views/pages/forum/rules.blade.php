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

        @include('pages.forum.partials.nav',['active'=>'rules'])

        <div class="row">
            <div class="col s12">
                <h1 class="loved-king-font text-center grey-text text-darken-3">Les régles du forum</h1>

                <p class="text-center">
                    Pour que tout se passe bien, merci de respecter ces quelques régles simples (qui relèvent souvent du bon sens).
                </p>

                <div class="nine-commandements-list">

                    <div class="row">
                        <i class="material-icons left">comment</i>
                        <p>
                            <strong>Être poli</strong><br>
                            Bonjour, au-revoir, merci, etc. La base.
                        </p>
                    </div>

                    <div class="row">
                        <i class="material-icons left">timer</i>
                        <p>
                            <strong>Être patient</strong><br>
                            Personne n'est obligé de vous répondre.
                        </p>
                    </div>

                    <div class="row">
                        <i class="material-icons left">spellcheck</i>
                        <p>
                            <strong>Faire attention à votre orthographe</strong><br>
                            On ne vous demande pas d'avoir fait Hypocagne mais évitez ça "Salu, tu fé koa ojour8 ?"
                        </p>
                    </div>

                    <div class="row">
                        <i class="material-icons left">lock</i>
                        <p>
                            <strong>Respecter la vie privée des autres</strong><br>
                            Un forum est un lieu public : certains sujets doivent rester dans le domaine privé.
                        </p>
                    </div>

                    <div class="row">
                        <i class="material-icons left">search</i>
                        <p>
                            <strong>Chercher avant de poster</strong><br>
                            Avant de poster un sujet, chercher s'il n'y a pas déjà un sujet en cours.
                        </p>
                    </div>

                    <div class="row">
                        <i class="material-icons left">flag</i>
                        <p>
                            <strong>Signaler les problèmes</strong><br>
                            Des posts peuvent nous échapper, n'hésitez pas à nous remonter les posts qui vous semblent incorrects.
                        </p>
                    </div>

                    <div class="row">
                        <i class="material-icons left">title</i>
                        <p>
                            <strong>Donner un titre clair</strong><br>
                            Éviter les titres comme "URGENT ! besoin d'aide"
                        </p>
                    </div>

                    <div class="row">
                        <i class="material-icons left">looks_one</i>
                        <p>
                            <strong>Poster dans une seule catégorie</strong><br>
                            Poster votre sujet dans différentes catégories réduira d'autant vos chances de réponse.
                        </p>
                    </div>

                    <div class="row">
                        <i class="material-icons left">flash_on</i>
                        <p>
                            <strong>Modération</strong><br>
                            Nous nous gardons le droit de supprimer ou modifier un post si celui-ci ne convient pas sans avoir à donner de raisons particulières.
                        </p>
                    </div>

                </div>

                <p class="text-center">Merci d'avoir lu ces quelques règles simples, en espérant que vous les comprendrez et que vous en tiendrez compte pour vos prochains posts ! </p>

            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="/js/forum.js"></script>
    <script src="/js/post.js"></script>
@endsection
