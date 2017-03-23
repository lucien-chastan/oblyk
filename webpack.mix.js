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
    .sass('resources/assets/sass/home/home.scss', 'public/css');

//fichier Js
mix.copy('resources/assets/js/app.js', 'public/js');

//image
mix.copy('resources/assets/img/','public/img/');
