<!doctype html>
<html lang="{{ LaravelLocalization::getCurrentLocale() }}">
    <head>
        @include('includes.head')
    </head>
    <body>
    <header>
        @include('includes.nav-gym-scheme')
    </header>

    <main class="corps-de-page">
        @yield('content')
    </main>

    @include('pages.route.route')

    @include('pages.global-search.globalSearch')

    @include('includes.modal')

    @include('includes.scripts')

    </body>
</html>