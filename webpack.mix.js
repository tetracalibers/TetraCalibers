const mix = require("laravel-mix");

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

mix.sass("resources/sass/app.scss", "public/css")
    .options({
        processCssUrls: false,
    })
    .sourceMaps()
    .vue()
    .js("resources/js/validateBlockEditor.js", "public/js/webpack")
    .js("resources/js/imageSelector.js", "public/js/webpack")
    .js("resources/js/linkPreview.js", "public/js/webpack");

if (mix.inProduction()) {
    mix.version();
}
