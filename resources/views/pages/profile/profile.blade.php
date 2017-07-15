@extends('layouts.profile')

@section('css')
    <link href="/css/profile.css" rel="stylesheet">
    <link href="/css/messagerie.css" rel="stylesheet">
@endsection

@section('content')

    <div class="row full-height-row">

        {{--COLONNE DU MENU DE GAUCHE--}}
        <div id="user-nav" class="col s2 grey darken-4">
            @include('pages.profile.partials.nav')
        </div>

        {{--COLONNE DU CONTENU DU PROFIL--}}
        <div id="content-user-zone" class="col s10 grey lighten-4">

            {{--ZONE D'INSERTION DES BOITES--}}
            <div id="user-content"></div>

            {{--LOADER DES BOITES--}}
            <div id="loade-user-content" class="text-center">
                <div class="preloader-wrapper big active">
                    <div class="spinner-layer spinner-blue-only">
                        <div class="circle-clipper left"><div class="circle"></div></div>
                        <div class="gap-patch"><div class="circle"></div></div>
                        <div class="circle-clipper right"><div class="circle"></div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="/js/profile.js"></script>
    <script src="/js/messagerie.js"></script>
    <script src="/js/notification.js"></script>
    <script src="/js/profile-router.js"></script>
    <script>

        //passage de la barre de navigation en noir
        let nav_barre = document.getElementById('nav_barre');
        nav_barre.setAttribute('class', nav_barre.className.replace('nav-white','nav-black'));
    </script>
@endsection