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

mix.webpackConfig({

});

    // front end
mix .js( 'resources/assets/js/app.js', 'public/js' )
    .sass( 'resources/assets/sass/app.scss', 'public/css' )
    .copy( 'resources/assets/images', 'public/images', false )

    // Admin
    .js( 'resources/assets/js/admin/admin.js', 'public/js/admin' )
    .sass( 'resources/assets/sass/admin/admin.scss', 'public/css/admin' )

    .version()
    .browserSync('local.teamfemr.org');