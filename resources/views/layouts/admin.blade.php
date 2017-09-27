<!doctype html>
<html lang="fr">
    <head>
        @include('includes.head')
        <link href="/css/admin.css" rel="stylesheet">
    </head>
    <body>
    <header>
        @include('includes.nav')
    </header>

    <main class="corps-de-page">
        <div class="row full-height-row">

            {{--COLONNE DU MENU DE GAUCHE--}}
            <div class="col s2 grey darken-4" id="admin-nav">
                @include('pages.admin.partials.nav')
            </div>

            {{--COLONNE DU CONTENU DU PROFIL--}}
            <div id="content-admin-zone" class="col s10 grey lighten-4">

                @yield('content')

            </div>
        </div>

    </main>

    @include('pages.route.route')

    @include('pages.global-search.globalSearch')

    @include('includes.modal')

    @include('includes.scripts')

    <script src="/js/admin.js"></script>

    </body>
</html>