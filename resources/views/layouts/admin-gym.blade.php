<!doctype html>
<html lang="fr">
    <head>
        @include('includes.head')
        <link href="/css/admin-gym.css" rel="stylesheet">
    </head>
    <body>
    <header>
        @include('includes.nav')
    </header>

    <main class="corps-de-page">
        <div class="row full-height-row">

            {{--COLONNE DU MENU DE GAUCHE--}}
            <div class="col s2 grey darken-4" id="admin-nav">
                @include('pages.gym-admin.include.nav')
            </div>

            {{--COLONNE DU CONTENU DU PROFIL--}}
            <div id="content-admin-zone" class="col s10 grey lighten-4">

                {{--ZONE D'INSERTION DES BOITES--}}
                <div id="content-admin"></div>

                {{--LOADER DES BOITES--}}
                <div id="load-admin-content" class="text-center">
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

    </main>

    @include('pages.route.route')

    @include('pages.global-search.globalSearch')

    @include('includes.modal')

    @include('includes.scripts')

    <script src="/js/admin-gym.js"></script>
    <script src="/js/admin-gym-router.js"></script>

    </body>
</html>