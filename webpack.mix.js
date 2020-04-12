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
    .js('resources/js/orders/create.js', 'public/js/orders/')
    .js('resources/js/orders/list.js', 'public/js/orders/')
    .js('resources/js/detail_product/lightslider.js', 'public/js/slider')
    .js('resources/js/detail_product/detail_product.js', 'public/js/detail_product')
    .js('resources/js/product_cart/product_cart.js', 'public/js/product_cart')
    .js('resources/js/list_cart/list_cart.js', 'public/js/list_cart')
    .sass('resources/sass/auth.scss', 'public/css')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/bootstraps.scss', 'public/css')
    .copyDirectory('resources/bower_components', 'public/bower_components')
    .copyDirectory('resources/vendor/template/', 'public/template');
