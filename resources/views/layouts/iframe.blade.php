<!doctype html>

<html lang="fr">
    <head>
        <title>{{$meta_title}}</title>

        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">
        <meta name="description" content="{{$meta_description}}">
        <meta name="author" content="Lucien CHASTAN">
        <link rel="icon" href="/img/fav_icon.png">
        <meta name="robots" content="none" />

        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <link href="/css/iframe/iframe.css" rel="stylesheet">

        @yield('css')

    </head>
    <body>
        <main>
            @yield('content')
        </main>

        @yield('script')

    </body>
</html>