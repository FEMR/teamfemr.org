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

mix.disableNotifications();

mix.webpackConfig({

});

    // front end
mix .js( 'resources/assets/js/front/app.js', 'public/js/front' )
    .sass( 'resources/assets/sass/front/app.scss', 'public/css/front' )
    .copyDirectory( 'resources/assets/images', 'public/images', false )

    // Admin
    .js( 'resources/assets/js/admin/admin.js', 'public/js/admin' )
    .sass( 'resources/assets/sass/admin/admin.scss', 'public/css/admin' )

    // Move document files
    .copyDirectory( 'resources/documents', 'public/documents' )

    .version();
    // .browserSync({
    //
    //     reloadDelay: 2000,
    //     notify: false,
    //     proxy: 'local.teamfemr.org'
    // });