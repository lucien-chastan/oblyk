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
    .sass('resources/assets/sass/crag/crag.scss', 'public/css');

//fichier Js
mix.copy('resources/assets/js/app.js', 'public/js')
    .copy('resources/assets/js/home.js', 'public/js')
    .copy('resources/assets/js/map.js', 'public/js');

//leaflet
mix.copy('resources/assets/framework/leaflet/markercluster.css', 'public/framework/leaflet')
    .copy('resources/assets/framework/leaflet/markercluster.js', 'public/framework/leaflet')
    .copy('resources/assets/framework/leaflet/leaflet.css', 'public/framework/leaflet')
    .copy('resources/assets/framework/leaflet/leaflet.js', 'public/framework/leaflet')
    .copy('resources/assets/framework/leaflet/images/', 'public/framework/leaflet/images');

//image
mix.copy('resources/assets/img/','public/img/');
