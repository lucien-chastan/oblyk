@extends('layouts.profile')

@section('css')
    <link href="/css/profile.css" rel="stylesheet">
@endsection

@section('content')

    <div class="row full-height-row">
        <div id="user-nav" class="col s2 grey darken-4">
            @include('pages.profile.partials.nav')
        </div>
        <div id="user-content" class="col s10 grey lighten-4">
            zone des boîtes
        </div>
    </div>

@endsection

@section('script')
    <script src="/js/profile.js"></script>
    <script>

        //passage de la barre de navigation en noir
        let nav_barre = document.getElementById('nav_barre');
        nav_barre.setAttribute('class', nav_barre.className.replace('nav-white','nav-black'));
    </script>
@endsection