const mix = require('laravel-mix');

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

mix.js('resources/js/auth.js', 'public/js')
    .js('resources/js/auth/register.js', 'public/js/auth')
    .js('resources/js/auth/login.js', 'public/js/auth')
    .js('resources/js/app.js', 'public/js/')
    .js('resources/js/detail_product/lightslider.js', 'public/js/')
    .sass('resources/sass/auth.scss', 'public/css')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/bootstraps.scss', 'public/css')
    .copyDirectory('resources/bower_components', 'public/bower_components')
    .copyDirectory('resources/vendor/template/', 'public/template');
