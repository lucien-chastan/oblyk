<!doctype html>
<html lang="{{ LaravelLocalization::getCurrentLocale() }}">
    <head>
        <title>
            {{ env('APP_ENV') == 'beta' ? 'Beta | ' :'' }} {{ $meta_title ?? 'Oblyk'}}
        </title>

        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1 maximum-scale=1.0, user-scalable=no">
        <meta charset="utf-8">
        <meta name="description" content="{{ $meta_description }}">
        <meta name="author" content="Lucien CHASTAN">
        <meta name="csrf-token" content="{{ csrf_token() }}"/>
        <link rel="icon" href="/img/fav_icon.png">

        <meta property="og:title" content="{{ $meta_title ?? 'Oblyk' }}"/>
        <meta property="og:description" content="{{ $meta_description ?? "Oblyk est un site communautaire d'escalade outdoor et indoor : on peut y noter ses croix, et voir l'activité des grimpeurs de la communauté" }}"/>
        <meta property="og:image" content="{{ $meta_img ?? '/img/oblyk-home-baume-rousse.jpg' }}" />
        <meta property="og:type" content="website"/>

        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        {{--css globale de l'application--}}
        <link href="/framework/leaflet/leaflet.css" rel="stylesheet">
        <link href="/css/materialize.css" rel="stylesheet">
        <link href="/css/cotation.css" rel="stylesheet">
        <link href="/font/oblyk/style.css" rel="stylesheet">
        <link href="/css/markdown.css" rel="stylesheet">
        <link href="/css/gallery.css" rel="stylesheet">

        @yield('css')
    </head>
    <body>
        <main>
            @yield('content')
        </main>

        <script src="/framework/leaflet/leaflet.js"></script>
        <script src="/js/mapVariable.js"></script>
        <script type="text/javascript" src="/js/jquery.min.js"></script>
        <script type="text/javascript" src="/js/materialize.min.js"></script>
        <script type="text/javascript" src="/js/gallery.js"></script>

        <script>
            $(".button-collapse").sideNav();
        </script>

    </body>
</html>