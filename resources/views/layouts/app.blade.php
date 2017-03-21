
<!doctype html>
<html lang="fr">
    <head>
        @include('includes.head')
    </head>
    <body>
        <header>
            @include('includes.nav')
        </header>

        <main class="corps-de-page">
            @yield('content')
        </main>

        <footer>
            @include('includes.footer')
        </footer>

        @include('includes.scripts')

    </body>
</html>