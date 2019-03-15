{{--Materialize--}}
<script type="text/javascript" src="/js/jquery.min.js"></script>
<script type="text/javascript" src="/js/materialize.min.js"></script>

{{--Ficher Js commun à toutes les pages--}}
<script type="text/javascript" src="/js/app.js"></script>
<script type="text/javascript" src="/js/popup.js"></script>
<script type="text/javascript" src="/js/route.js"></script>
<script type="text/javascript" src="/js/router.js"></script>
<script type="text/javascript" src="/js/global-search.js"></script>
<script type="text/javascript" src="/framework/axios/axios.min.js"></script>
<script src="/js/photo.js"></script>
<script src="/framework/marked/marked.min.js"></script>
<script src="/framework/trumbowyg/trumbowyg.js"></script>
<script src="/framework/trumbowyg/plugins/trumbowyg.upload.js"></script>
<script type="text/javascript" src="/framework/trumbowyg/langs/fr.min.js"></script>
<script type="text/javascript" id="cookiebanner"
        src="/framework/cookiebanner/cookiebanner.min.js"
        data-height="32px" data-position="bottom"
        data-moreinfo="https://www.cnil.fr/fr/cookies-les-outils-pour-les-maitriser"
        data-linkmsg="en savoir plus"
        data-message='Oblyk utilise des cookies à des fins internes ou pour améliorer votre navigation, en continuant vous acceptez les <img rel="nofollow" alt="cookies" title="cookies" class="cookie-in-cookiebanner" src="/img/cookie.png">'>
</script>

<script type="text/javascript">
    {{--initialisation du paralax--}}
    $(document).ready(function(){

        $('.parallax').parallax();

        $(".button-open-global-search").sideNav({
            menuWidth: 500,
            edge: 'right',
            closeOnClick: false,
            draggable: false
        });
    });

    @if(Auth::check() && config('app.get_user_notifications'))
        //check s'il y a de nouveau message et notification
        getNewNotificationAndMessage();

        //check les messages et notification toutes les 30 secondes
        window.addEventListener('load', function () {
            setTimeout(function () {
                setInterval(function () {
                    getNewNotificationAndMessage();
                },30000);
            },30000);
        });
    @endif

</script>

@if(config('app.analytics_script'))
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
@endif


{{--inclusion de script particulier à une page--}}
@yield('script')
