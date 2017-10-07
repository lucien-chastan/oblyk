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

        <!-- Piwik -->
        <script type="text/javascript">
            var _paq = _paq || [];
            /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
            _paq.push(['trackPageView']);
            _paq.push(['enableLinkTracking']);
            (function() {
                var u="//analytics.oblyk.org/";
                _paq.push(['setTrackerUrl', u+'piwik.php']);
                _paq.push(['setSiteId', '1']);
                var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
                g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
            })();
        </script>
        <!-- End Piwik Code -->
    </body>
</html>