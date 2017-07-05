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
    .sass('resources/assets/sass/crag/cotation.scss', 'public/css')
    .sass('resources/assets/sass/crag/route.scss', 'public/css')
    .sass('resources/assets/sass/markdown.scss', 'public/css');

//fichier Js
mix.copy('resources/assets/js/app.js', 'public/js')
    .copy('resources/assets/js/home.js', 'public/js')
    .copy('resources/assets/js/map.js', 'public/js')
    .copy('resources/assets/js/popup.js', 'public/js')
    .copy('resources/assets/js/router.js', 'public/js')
    .copy('resources/assets/js/crag.js', 'public/js')
    .copy('resources/assets/js/route.js', 'public/js')
    .copy('resources/assets/js/photo.js', 'public/js')
    .copy('resources/assets/js/mapVariable.js', 'public/js');

//leaflet
mix.copy('resources/assets/framework/leaflet/markercluster.css', 'public/framework/leaflet')
    .copy('resources/assets/framework/leaflet/markercluster.js', 'public/framework/leaflet')
    .copy('resources/assets/framework/leaflet/leaflet.css', 'public/framework/leaflet')
    .copy('resources/assets/framework/leaflet/leaflet.js', 'public/framework/leaflet')
    .copy('resources/assets/framework/leaflet/images/', 'public/framework/leaflet/images');

//axios
mix.copy('resources/assets/framework/axios/axios.min.js', 'public/framework/axios');

//chartJs
mix.copy('resources/assets/framework/chartJs/Chart.min.js', 'public/framework/chartJs');

//Phototheque
mix.copy('resources/assets/framework/phototheque/phototheque.js', 'public/framework/phototheque')
    .copy('resources/assets/framework/phototheque/phototheque.css', 'public/framework/phototheque');


//marked
mix.copy('resources/assets/framework/marked/marked.min.js', 'public/framework/marked');

//Simple Markdown Editor
mix.copy('resources/assets/framework/simplemde/simplemde.min.js', 'public/framework/simplemde')
    .copy('resources/assets/framework/simplemde/simplemde.min.css', 'public/framework/simplemde')
    .copy('resources/assets/framework/simplemde/French.aff', 'public/framework/simplemde')
    .copy('resources/assets/framework/simplemde/French.dic', 'public/framework/simplemde');

//image
mix.copy('resources/assets/img/','public/img/');

//font oblyk
mix.sass('resources/assets/font/oblyk/style.scss', 'public/font/oblyk');
mix.copy('resources/assets/font/oblyk/fonts/oblyk.eot','public/font/oblyk/fonts')
    .copy('resources/assets/font/oblyk/fonts/oblyk.svg','public/font/oblyk/fonts')
    .copy('resources/assets/font/oblyk/fonts/oblyk.ttf','public/font/oblyk/fonts')
    .copy('resources/assets/font/oblyk/fonts/oblyk.woff','public/font/oblyk/fonts');
