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

//layout assets
mix.sass('resources/assets/sass/frontend.scss', 'public/css');
mix.js('resources/assets/js/app.js', 'public/js').sass('resources/assets/sass/app.scss', 'public/css');

//page specific resources
mix.sass('resources/assets/sass/home.scss', 'public/css');
mix.sass('resources/assets/sass/hamburger.scss', 'public/css').sass('resources/assets/sass/blog.scss', 'public/css');
mix.sass('resources/assets/sass/about.scss', 'public/css');
mix.sass('resources/assets/sass/spirit.scss', 'public/css').js('resources/assets/js/spirit.js', 'public/js');
