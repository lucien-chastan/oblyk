const { mix } = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

//fichier Sass
mix.sass('resources/assets/sass/app.scss', 'public/css')
    .sass('resources/assets/sass/materialize/materialize.scss', 'public/css')
    .sass('resources/assets/sass/home/home.scss', 'public/css')
    .sass('resources/assets/sass/map/map.scss', 'public/css')
    .sass('resources/assets/sass/map/popupMapStyle.scss', 'public/css')
    .sass('resources/assets/sass/project/project.scss', 'public/css')
    .sass('resources/assets/sass/crag/crag.scss', 'public/css')
    .sass('resources/assets/sass/topo/topo.scss', 'public/css')
    .sass('resources/assets/sass/article/article.scss', 'public/css')
    .sass('resources/assets/sass/massive/massive.scss', 'public/css')
    .sass('resources/assets/sass/profile/profile.scss', 'public/css')
    .sass('resources/assets/sass/gym/gym.scss', 'public/css')
    .sass('resources/assets/sass/partner/partner-how.scss', 'public/css')
    .sass('resources/assets/sass/partner/partner-map.scss', 'public/css')
    .sass('resources/assets/sass/post/post.scss', 'public/css')
    .sass('resources/assets/sass/profile/messagerie.scss', 'public/css')
    .sass('resources/assets/sass/crag/cotation.scss', 'public/css')
    .sass('resources/assets/sass/crag/route.scss', 'public/css')
    .sass('resources/assets/sass/lexique/lexique.scss', 'public/css')
    .sass('resources/assets/sass/forum/forum.scss', 'public/css')
    .sass('resources/assets/sass/globalSearch/global-search.scss', 'public/css')
    .sass('resources/assets/sass/markdown.scss', 'public/css')
    .sass('resources/assets/sass/article-markdown.scss', 'public/css')
    .sass('resources/assets/sass/tools/tools.scss', 'public/css')
    .sass('resources/assets/sass/crag/line.scss', 'public/css')
    .sass('resources/assets/sass/iframe/crag-iframe.scss', 'public/css/iframe')
    .sass('resources/assets/sass/iframe/iframe.scss', 'public/css/iframe')
    .sass('resources/assets/sass/admin/admin.scss', 'public/css');

//fichier Js
mix.copy('resources/assets/js/app.js', 'public/js')
    .copy('resources/assets/js/home.js', 'public/js')
    .copy('resources/assets/js/map.js', 'public/js')
    .copy('resources/assets/js/popup.js', 'public/js')
    .copy('resources/assets/js/router.js', 'public/js')
    .copy('resources/assets/js/crag.js', 'public/js')
    .copy('resources/assets/js/topo.js', 'public/js')
    .copy('resources/assets/js/massive.js', 'public/js')
    .copy('resources/assets/js/gym.js', 'public/js')
    .copy('resources/assets/js/partner.js', 'public/js')
    .copy('resources/assets/js/route.js', 'public/js')
    .copy('resources/assets/js/forum.js', 'public/js')
    .copy('resources/assets/js/profile-chart.js', 'public/js')
    .copy('resources/assets/js/article.js', 'public/js')
    .copy('resources/assets/js/notification.js', 'public/js')
    .copy('resources/assets/js/post.js', 'public/js')
    .copy('resources/assets/js/profile.js', 'public/js')
    .copy('resources/assets/js/messagerie.js', 'public/js')
    .copy('resources/assets/js/profile-router.js', 'public/js')
    .copy('resources/assets/js/photo.js', 'public/js')
    .copy('resources/assets/js/project.js', 'public/js')
    .copy('resources/assets/js/global-search.js', 'public/js')
    .copy('resources/assets/js/mapVariable.js', 'public/js')
    .copy('resources/assets/js/iframe/crag-iframe.js', 'public/js/iframe')
    .copy('resources/assets/js/jquery.min.js', 'public/js')
    .copy('resources/assets/js/materialize.min.js', 'public/js')
    .copy('resources/assets/js/admin.js', 'public/js');

//leaflet
mix.copy('resources/assets/framework/leaflet/markercluster.css', 'public/framework/leaflet')
    .copy('resources/assets/framework/leaflet/markercluster.js', 'public/framework/leaflet')
    .copy('resources/assets/framework/leaflet/easy-button.js', 'public/framework/leaflet')
    .copy('resources/assets/framework/leaflet/easy-button.css', 'public/framework/leaflet')
    .copy('resources/assets/framework/leaflet/Control.Geocoder.js', 'public/framework/leaflet')
    .copy('resources/assets/framework/leaflet/Control.Geocoder.css', 'public/framework/leaflet')
    .copy('resources/assets/framework/leaflet/leaflet.plotter.min.js', 'public/framework/leaflet')
    .copy('resources/assets/framework/leaflet/leaflet.css', 'public/framework/leaflet')
    .copy('resources/assets/framework/leaflet/leaflet.js', 'public/framework/leaflet')
    .copy('resources/assets/framework/leaflet/leaflet.draw.js', 'public/framework/leaflet')
    .copy('resources/assets/framework/leaflet/leaflet.draw.css', 'public/framework/leaflet')
    .copy('resources/assets/framework/leaflet/leaflet.measure.js', 'public/framework/leaflet')
    .copy('resources/assets/framework/leaflet/images/', 'public/framework/leaflet/images');

//axios
mix.copy('resources/assets/framework/axios/axios.min.js', 'public/framework/axios');

//chartJs
mix.copy('resources/assets/framework/chartJs/Chart.min.js', 'public/framework/chartJs');

//trumbowyg
mix.copy('resources/assets/framework/trumbowyg/trumbowyg.js', 'public/framework/trumbowyg/')
    .copy('resources/assets/framework/trumbowyg/langs/', 'public/framework/trumbowyg/langs/')
    .copy('resources/assets/framework/trumbowyg/ui/', 'public/framework/trumbowyg/ui/')
    .copy('resources/assets/framework/trumbowyg/plugins/upload/trumbowyg.upload.js', 'public/framework/trumbowyg/plugins/trumbowyg.upload.js');

//Phototheque
mix.copy('resources/assets/framework/phototheque/phototheque.js', 'public/framework/phototheque')
    .copy('resources/assets/framework/phototheque/phototheque.css', 'public/framework/phototheque');

//Cookiebanner
mix.copy('resources/assets/framework/cookiebanner/cookiebanner.min.js', 'public/framework/cookiebanner');

//marked
mix.copy('resources/assets/framework/marked/marked.min.js', 'public/framework/marked');

//image
mix.copy('resources/assets/img/','public/img/');

//font oblyk
mix.sass('resources/assets/font/oblyk/style.scss', 'public/font/oblyk');
mix.copy('resources/assets/font/oblyk/fonts/oblyk.eot','public/font/oblyk/fonts')
    .copy('resources/assets/font/oblyk/fonts/oblyk.svg','public/font/oblyk/fonts')
    .copy('resources/assets/font/oblyk/fonts/oblyk.ttf','public/font/oblyk/fonts')
    .copy('resources/assets/font/oblyk/fonts/oblyk.woff','public/font/oblyk/fonts');
