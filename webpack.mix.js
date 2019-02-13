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

    // front end
mix .js( 'resources/assets/js/front/app.js', 'public/js/front' )
    .js( 'resources/assets/js/front/forum.js', 'public/js/front' )
    .js( 'node_modules/trumbowyg/plugins/upload/trumbowyg.upload.js', 'public/js/front/trumbowyg-plugins.js' )
    .sass( 'resources/assets/sass/front/app.scss', 'public/css/front' )
    .sass( 'resources/assets/sass/front/forum.scss', 'public/css/front' )
    .copyDirectory( 'resources/assets/images', 'public/images', false )

    // Move document files
    .copyDirectory( 'resources/documents', 'public/documents' )

    .version();